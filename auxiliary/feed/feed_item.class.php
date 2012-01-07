<?php

/**
 * A class that represents an item in a Feed (generally an article). Provides
 * accessors for item attributes as well as a method to build a request URL
 * for a given item.
 *
 * @author ebollens
 * @version 20110727
 */

require_once(dirname(__FILE__).'/feed_database.class.php');
require_once(dirname(__FILE__).'/cScrape.php');

class Feed_Item
{
    /**
     * The item title
     * 
     * @var string 
     */
    private $_title;
    
    /**
     * The item link
     * 
     * @var string 
     */
    private $_link;
    
    /**
     * The item description
     * 
     * @var string 
     */
    private $_description;
    
    /**
     * The feed the item belongs to
     * 
     * @var Feed 
     */
    private $_feed;
    
    /**
     * The date of the item
     * 
     * @var string
     */
    private $_date;
    
    /**
     * The author of the item
     * 
     * @var string 
     */
    private $_author;

    private $_scrape;
    private $_time;
    private $_location;

    /**
     * The constructor stores feed item attributes as properties.
     * 
     * @param type $feed the feed the new item belongs to
     * @param SimplePie_Item $item SimplePie_Item that contains information
     * about the item
     */
    public function __construct($feed, $item)
    {
        $this->_feed = $feed;
        $this->_title = $item->get_title();
        $this->_link = $item->get_permalink();
        $this->_description = $item->get_content();
        $this->_date = $item->get_date('U');
        $author = $item->get_author();  
        $author_name = $author ? $author->get_name() : NULL;
        $this->_author = $author && empty($author_name) ? $author->get_email() : $author_name;
    }

    /**
     * Accessor method to get the Feed the item belongs to
     * 
     * @return Feed feed the item belongs to
     */
    public function get_feed()
    {
        return $this->_feed;
    }

    /**
     * Accessor method for the feed item name (alias for title)
     * 
     * @return string 
     */
    public function get_name()
    {
        return $this->_title;
    }

    /**
     * Accessor method for the feed item title
     * 
     * @return string 
     */
    public function get_title()
    {
        return $this->_title;
    }

    /**
     * Accessor method for the feed item link
     * 
     * @return string 
     */
    public function get_link()
    {
        return $this->_link;
    }

    /**
     * Accessor method for the feed item date
     * 
     * @return string 
     */
    public function get_date($format='F j, Y')
    {
        return date($format, $this->_date);
    }

    /**
     * Accessor method for the feed item author
     * 
     * @return string 
     */
    public function get_author()
    {
        return $this->_author;
    }

    /**
     * Accessor method for the feed item description
     * 
     * @return string 
     */
    public function get_description()
    {
        return $this->_description;
    }

    public function set_description($desc)
    {
        $this->_description = $desc;
    }

    public function getTime()
    {
        if (isset($this->_time) && !empty($this->_time)) {
            return $this->_time;
        } else {
            $db = new Feed_Database();
            $db_feed = $db->find_news_feed($this->_title);
            return $db_feed->date;
        }
    }

    public function getLocation()
    {
        if (isset($this->_location) && !empty($this->_location)) {
            return $this->_location;
        } else {
            $db = new Feed_Database();
            $db_feed = $db->find_news_feed($this->_title);
            return $db_feed->location;
        }
    }

    /**
     * Accessor method to get a short description, which is simply the item
     * description truncated to $n characters.
     * 
     * @param $n number of characters to truncate description to
     * @return string|false the truncated description or false if not available
     */
    public function get_short_description($n = 100)
    {
        if(!$this->_description)
            $short_desc = false;
        else
        {
            $desc = strip_tags($this->_description);
            if( ($desc_len = strlen($desc)) < $n)
                $short_desc = $desc;
            else
            {
                $pos = strrpos($desc, ' ', (-1)*($desc_len-$n));
                if($pos > 0)
                    $short_desc = substr($desc, 0, $pos).'...';
                else
                    $short_desc = false;
            }
        }

        return $short_desc;
    }

    /**
     * Produces a URL for viewing a feed item. If a salt is provided, creates
     * a signature and appends it to the URL.
     * 
     * @param string $salt a salt for verifying the page
     * @return string the desired URL
     */
    public function get_page($page=null, $salt = null)
    {
        $path = $page.'?name='.urlencode($this->get_feed()->get_name()).'&path='.urlencode($this->get_feed()->get_path()).'&article='.urlencode($this->get_title());
        return $salt ? $path.'&signature='.md5($salt.$this->get_feed()->get_name().$this->get_feed()->get_path().$this->get_title()) : $path;
    }

    /**
     * Verifies a signature based on the given salt.
     * 
     * @param type $signature signature to verify
     * @param type $salt salt to use when verifying
     * @return bool
     */
    public function verify_page($signature, $salt)
    {
        return $signature == md5($salt.$this->get_feed()->get_name().$this->get_feed()->get_path().$this->get_title());
    }

    /*
     * Get the article when the artcle is not available in the RSS
     *
     * */
    public function get_page_by_url($div)
    {
        //Check if there is saved in the database.
        $db = new Feed_Database();
        $db_feed = $db->find_news_feed($this->_title);
        if ($db_feed) {
            return $db_feed->description;
        } else {
            list($desc, $date, $location) = $this->scrape_content($this->_link, $div);
            $this->_time = $date;
            $this->_location = $location;
            $db->save_news_feed($this, $desc, $date, $location);
            return $desc;
        }
    }

    public function scrape_content($url, $div)
    {
        $this->_scrape = new Scrape();
        $this->_scrape->fetch($url);
        $data = $this->_scrape->removeNewlines($this->_scrape->result);

        list($date, $location) = $this->scrape_date_location($data);

        $data = $this->_scrape->fetchBetween($div, '</div>', $data, true);
        //replace </p> to <br>
        $description = str_replace('</p>', '<br><br>', $data);
        //strip tags
        $description = strip_tags($description, '<br><iframe><strong>');
        return array($description, $date, $location);
    }

    public function scrape_date_location($data)
    {
        $rows = $this->_scrape->fetchAllBetween('<td>', '</td>', $data, true);
        $date = strip_tags(str_replace('</span>', ' ', $rows[1]));
        $location = strip_tags($this->_scrape->fetchBetween('<td class="location">', '</td>', $data, true));
        return array($date, $location);
    }

}

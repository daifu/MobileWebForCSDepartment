<?php

/**
 * A class that save the feed description to the database
 **/

require_once(dirname(__FILE__).'/PHP-on-Couch/lib/couch.php');
require_once(dirname(__FILE__).'/PHP-on-Couch/lib/couchClient.php');
require_once(dirname(__FILE__).'/PHP-on-Couch/lib/couchDocument.php');


class Feed_Database
{
    private $client;

    function __construct()
    {
        //connect to the database
        $this->client = new couchClient('https://daifu:123456@daifu.cloudant.com:443/', 'ucla_cs_news_feed');
    }

    public function save_news_feed($news_feed, $desc)
    {
        try {
            //look for the news_feed whether is existed or not
            $doc = $this->client->getDoc($news_feed->get_title());
            // update the document on CouchDB server
            $response = $this->client->storeDoc($doc);
        } catch (Exception $e) {
            // echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
        }
        $newDoc = new stdClass();
        $newDoc->description = urlencode($desc);
        $newDoc->_id = str_replace('\'', '', $news_feed->get_title());
        try {
            $response = $this->client->storeDoc($newDoc);
        } catch (Exception $e) {
            echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
        }
    }

    public function find_news_feed($id)
    {
        try {
            $doc = $this->client->getDoc(str_replace('\'', '', $id));
            return $doc;
        } catch (Exception $e) {
            // echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
            return false;
        }
    }
}


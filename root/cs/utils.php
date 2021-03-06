<?php

/**
 * a utility class
 **/
class Utils
{
   public static function htmlallentities($str)
   {
      $res = '';
      $strlen = strlen($str);
      for($i=0; $i<$strlen; $i++)
      {
         $byte = ord($str[$i]);
         if($byte < 128) // 1-byte char
            $res .= $str[$i];
         elseif($byte < 192); // invalid utf8
         elseif($byte < 224) // 2-byte char
            $res .= '&#'.((63&$byte)*64 + (63&ord($str[++$i]))).';';
         elseif($byte < 240) // 3-byte char
            $res .= '&#'.((15&$byte)*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
         elseif($byte < 248) // 4-byte char
            $res .= '&#'.((15&$byte)*262144 + (63&ord($str[++$i]))*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
      }
      return $res;
   }
}

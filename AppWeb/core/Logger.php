<?php
// find on https://openclassrooms.com/forum/sujet/comment-creer-un-fichier-log by Locky13
// just modified a little
class Logger
{
    public static function addLogEvent($event){
      $time = "[".date("D, d M Y H:i:s")."]";
      $event = $time." : ".$event. "\n"; //=> \n is necessary: if he's not here, put the content following each others
      file_put_contents("log.txt", $event, FILE_APPEND);
    }
}

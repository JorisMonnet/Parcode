<?php

class Logger
{
    public static function addLogEvent($event){
      	$time = "[".date("D, d M Y H:i:s")."]";
      	$event = $time." : ".$event. "\n";
      	file_put_contents("log.txt", $event, FILE_APPEND);
    }
    /**
     * We search if the last log event is a failed log
     * First, we verify that it is a failed one,
     * if so, we calculate the time difference between now and this log
     * if it is less than 15 seconds, it's true, it means we tried to connect but failed recently
     * it avoids to say "userName/password not found" if the user reconnect 6 month after his failed log
     */
    public static function lastLogEventisFalseLog(){
      	if(file_get_contents("log.txt",false,null,-7,6)==='failed'){            
        	$dateLog = new DateTime(file_get_contents("log.txt",FALSE,NULL,-51,20));
        	$dateNow = new DateTime(date("d M Y H:i:s"));
        	$interval = $dateNow->getTimestamp() - $dateLog->getTimeStamp();
			if ($interval<15)
				return true;
      	}
      	return false;
    }
}
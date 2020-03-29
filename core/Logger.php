<?php
class Logger
{
    public static function addLogEvent($event){
      $time = "[".date("D, d M Y H:i:s")."]";
      $event = $time." : ".$event. "\n";
      file_put_contents("log.txt", $event, FILE_APPEND);
    }
    /**
     * On cherche si le dernier log event est un failed
     * en premier on verifie si il est failed
     * si oui on calcule la différence de temps entre le failed log et maintenant,
     * ce qui permet de verifier si la derniere fois que l'on s'est log remonte à moins de 15 secondes
     * de ce fait, si on se deconnecte du site et qu'on se reconnecte plus tard, apres avoir failed un log,
     * ça n'affichera pas le message d'erreur
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
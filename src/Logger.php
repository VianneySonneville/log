<?php
namespace Log;
use Log\Entry;

class Logger {
  private static String $INFO = "info";
  private static String $WARNING = "warning";
  private static String $SUCCES = "succes";
  private static String $ERROR = "error";
  private static String $file = __DIR__."/log.log";
  private static Array $logs = [];

  public static Array $log_info = ["info", "warning", "succes", "error"];

  /**
   * @description add log message succes to log file
   * @param string $message
   */
   public static function succes(String $message): void { self::addEntry($message, self::$SUCCES); }

   /**
    * @description add log message error to log file
    * @param string $message
    */
   public static function error(String $message): void { self::addEntry($message, self::$ERROR); }

   /**
    * @description add log message info to log file
    * @param string $message
    */
   public static function info(String $message): void { self::addEntry($message, self::$INFO); }

   /**
    * @description add warning message to log file
    * @param string $message
    */
    public static function warning(String $message): void { self::addEntry($message, self::$WARNING); }


    /**
     * @description add message to log file
     * @param string $message
     * @param string $type
     * @return void
     */

     private static function addEntry(String $message,String $type): void {
      if(!in_array($type, self::$log_info)) return;

      $entry = new Entry($type, $message);
      
      self::$logs[] = $entry;

      self::writeLog($entry);
      self::stdOut($entry);
     }

    private static function writeLog(Entry $entry): void {
      touch(self::$file);
      error_log($entry, 3, self::$file);
    }

    /**
     * @description print log to std out
     * @param Entry $entry
     * @return void
     */
    private static function stdOut(Entry $entry): void {
      error_log(\str_replace("\n", "", $entry), 4);
    }
}
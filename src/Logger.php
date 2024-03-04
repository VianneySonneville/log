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
      self::autoPurge();
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
      error_log(\str_replace("\n", "", $entry) . ", log file: " . self::FileSizeConvert(filesize(self::$file)), 4);
    }

    /**
     * @description remove old line in file if file size is bigger than 100MB 2129400 lines approximate 100Mo
     * return void
     */
    private static function autoPurge(): void {
      if(count(file(self::$file)) > 2129400) {
        $file = array_splice($file,-2129400);
        file_put_contents($filename,$file); 
      }
    }

    /** 
* @description Converts bytes into human readable file size. 
* @param string $bytes 
* @return string human readable file size (2,87 Мб)
* @author Mogilev Arseny 
*/ 
private static function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
}
<?php
namespace Log;

class Entry {
  private String $type;
  private String $message;
  private int $timestamp;

  /**
   * @description: Constructor
   * @param String $type
   * @param String $message
   * @return void
   */
  public function __construct(String $type, String $message) {
    $this->type = $type;
    $this->message = $message;
    $this->timestamp = time();
  }

  /**
   * @description: fomat class to string to log file
   * @return String
   */
  public function __toString() {
    return date('d/m/Y H:i:s', $this->timestamp) . " [" . $this->type . "] " . $this->message . "\n";
  }
}
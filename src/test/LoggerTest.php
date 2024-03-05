<?php
require __DIR__. '/../Entry.php';
require __DIR__. '/../Logger.php';
use Log\Logger;

// for($i = 1; $i < 99999999; $i++){
  Logger::error('bis This is a test error');
  Logger::info('bisThis is a test info');
  Logger::warning('This is a test warning');
// }

// $filename = __DIR__."/../log.log";

// $file = file($filename);
// $count = count($file);
// echo $count;
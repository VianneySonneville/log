<?php
require __DIR__. '/../Entry.php';
require __DIR__. '/../Logger.php';
use Log\Logger;

Logger::succes('This is a test succes');
Logger::error('This is a test error');
Logger::info('This is a test info');
Logger::warning('This is a test warning');
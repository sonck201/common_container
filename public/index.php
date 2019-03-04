<?php

define('__START__', microtime(true));
define('ROOT', dirname(__FILE__) . '/../');

ini_set('xdebug.var_display_max_depth', '10');

require dirname(__FILE__) . '/../vendor/autoload.php';

var_dump('Time execute::' . round(microtime(true) - __START__, 4));

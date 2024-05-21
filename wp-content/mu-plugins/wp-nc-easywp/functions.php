<?php

if (!defined("ABSPATH")) {
  exit();
}

/*
|--------------------------------------------------------------------------
| Global functions
|--------------------------------------------------------------------------
|
| Here you can insert your global function loaded by composer settings.
|
*/

include __DIR__ . "/plugin/hooks/blogname.php";
include __DIR__ . "/plugin/hooks/mail.php";
include __DIR__ . "/plugin/hooks/wpforms.php";
include __DIR__ . "/plugin/hooks/wpversion.php";
include __DIR__ . "/plugin/hooks/hack-guardian.php";

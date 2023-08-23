<?php
include_once('classes/database.php');
include_once('classes/login.php');
include_once('classes/functions.php');

use jesuzweq\JesuLogin;
use jesuzweq\System;
use jesuzweq\Functions;

$site_bilgi = System::table('settings')->where('id',1)->first();

$title = $site_bilgi->title;
$site_url = $site_bilgi->url;
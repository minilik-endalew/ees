<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 15-8-2017
 * Time: 2:10 PM
 */
$url="http://10.90.10.12";
ob_start();
header('Location: '.$url);
ob_end_flush();
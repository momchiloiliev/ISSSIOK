<?php

include 'Page.php';

$page = new Page('LAB3');
$page->description('Lab 3 - ISSSIOK');
$page->keywords('keyword1, keyword2, keyword3');
$page->robots(true);
$page->body('style="background-color: #f1f1f1;"');

echo $page->display('<h1>Lab 3</h1>');
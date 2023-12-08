<?php

$prva = fopen("prva.txt", "r");
$rezultat = fopen("rezultat.txt", "w");
$vtora = fopen("vtora.txt", "r");

$prva_content = fread($prva, filesize("prva.txt"));
$prva_content = str_replace("-", " ", $prva_content);
$vtora_content = fread($vtora, filesize("vtora.txt"));

fwrite($rezultat, $prva_content);
fwrite($rezultat, $vtora_content);

fclose($prva);
fclose($rezultat);
fclose($vtora);
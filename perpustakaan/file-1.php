<?php
$myFile = fopen("webdictionary.txt", "r") or die("Unable to open file");
echo fread($myFile, filesize("webdictionary.txt"));
fclose($myFile);
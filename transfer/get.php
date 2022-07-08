<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $f=fopen("data.txt","r");
$s=fread($f,filesize("data.txt"));
fclose($f);
echo $s;
}
?>
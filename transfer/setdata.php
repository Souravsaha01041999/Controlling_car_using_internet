<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$v=$_POST['id_in'];
$cmd=$_POST['cm'];
$f=fopen("id.txt","r");
$s=fread($f,filesize("id.txt"));
fclose($f);
if($v==$s)
{
    $f=fopen("data.txt","w");
    fwrite($f,$cmd);
    fclose($f);
    echo "1";
}
else
{
    echo "0";
}
}
?>

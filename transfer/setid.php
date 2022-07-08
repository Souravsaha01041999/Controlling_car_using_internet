<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $s=$_POST['val'];
    $f=fopen("id.txt","w");
    fwrite($f,$s);
fclose($f);
}
?>
<html>
    <head>
        <title>
            CHANGE ID
        </title>
    </head>
    <body>
        <center>
            <form action="setid.php" method="post">
            <input type="test" name="val"><br><br>
            <input type="submit">
            </form>
        </center>
    </body>
</html>
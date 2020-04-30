<?php
$myObj->title = "ID = " . $id;
$myObj->artist = "one";
$myObj->date = "Jan 1, 2000";

$myJSON = json_encode($myObj);

echo $myJSON;
?>
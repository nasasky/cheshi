<?php
$con = mysql_connect("localhost", "root", "xiao1234");
if (!$con) {die('Could not connect:' . mysql_error());
}
mysql_select_db("zero", $con);
?>

<?php
//Connection with the database.DB_Connection.php
$con = mysqli_connect('localhost','root','','invoice_system');
if (!$con)
{
	echo "Your Connection Failed";
}

?>


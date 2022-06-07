<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "pametni_obrazci";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}


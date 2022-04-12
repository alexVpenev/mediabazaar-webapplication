<?php
global $dbcon;
// db no longer exists
$dbhost = '';
$dbname = '';
$dbuser = '';
$dbpass = '';

try{
    $dbcon = new PDO("mysql:host=".$dbhost.";dbname=".$dbname,$dbuser,$dbpass);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die($e->getMessage());
}
include '..\classes\Login.php';

$login = new Login($dbcon);
?>
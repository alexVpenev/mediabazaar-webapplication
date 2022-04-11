<?php
global $dbcon;
$dbhost = 'studmysql01.fhict.local';
$dbname = 'dbi412462';
$dbuser = 'dbi412462';
$dbpass = 'g4rocks';

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
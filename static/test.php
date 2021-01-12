<?php 

include 'bd.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';

$db = new bd($dbhost, $dbuser, $dbpass, $dbname);

$insert = $db->query('INSERT INTO utilisateur (nom,prenom,mail,tel) VALUES (?,?,?,?)', 'test', 'test', 'test@gmail.com', '0130506070');
echo $insert->affectedRows();

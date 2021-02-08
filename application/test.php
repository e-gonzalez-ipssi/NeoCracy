<?php

use Neocracy\Entity\bd;

include "entity/bd.php";
include "Constant.php";

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'neocracy';

$db = new bd($dbhost, $dbuser, $dbpass, $dbname);

// $insert = $db->query('INSERT INTO utilisateur (nom,prenom,mail,tel) VALUES (?,?,?,?)', 'test', 'test', 'test@gmail.com', '0130506070');
// echo $insert->affectedRows();
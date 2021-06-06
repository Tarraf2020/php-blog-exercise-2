<?php

try {
    $dbc = new PDO("mysql:host=localhost;dbname=phpblog", "root", "");
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
}
include_once 'class.crud.php';
$crud = new crud($dbc);
?>

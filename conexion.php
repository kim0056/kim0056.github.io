<?php
$servername = 'localhost';
$username = 'root';
$password = 'elida123';
$database = 'reservar';

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn)
    echo 'Error al conectar a MySQL: '.mysqli_connect_error();
?>
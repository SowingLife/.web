<?php
$servidor = "localhost";
$usuario = "root";
$pass = "";
$bdatos = "empresa2";

$enlace = new mysqli($servidor, $usuario, $pass, $bdatos);

if ($enlace->connect_errno) {
  die("La conexión falló: " . $enlace->connect_errno);
}


<?php
//Protector de inicio de sesion
session_start();


if (!isset($_SESSION['usuario'])){
echo'
<script>
alert("Porfavor inicie la sesión para acceder");
window.location="login.php";
</script>
'; 
session_destroy();
die();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="assets/CSS/perfil.css">
</head>

<body>

<div class="menu container">
  <a href="#" class="logo">Sowing Life</a>

  <nav class="navbar">
    <ul>
      <li><a href="Principal.html"> Inicio</a></li>
      <li><a href="quiensoy.html"> Quienes somos</a></li>
      <li><a href="Productos.html"> Productos</a></li>
      <li><a href="servicios.html"> Servicios</a></li>
      <li><a href="Login.html"> Mi cuenta</a></li>
    </ul>
  </nav>
</div>

<form id="create-account-form">

    <h2>Mi Cuenta</h2>

    <!-- Información Personal -->
    <h3>Información Personal</h3>
    <label for="full-name">Usuario</label>
    <input type="text" id="usuario" name="usuario"><br><br>
    <label for="full-name">Nombre Completo:</label>
    <input type="text" id="full-name" name="full-name"><br><br>
    <label for="Correo">Correo:</label>
    <input type="correo" id="Correo" name="Correo"><br><br>
    <label for="birth-date">Fecha de Nacimiento:</label>
    <input type="date" id="birth-date" name="birth-date"><br><br>
    <label for="number">Número:</label>
    <input type="text" id="number" name="number"><br><br>
    <label for="gender">Género:</label>
    <select id="gender" name="gender">
      <option value="male">Masculino</option>
      <option value="female">Femenino</option>
      <option value="other">Otro</option>
    </select><br><br>
  
    <!-- Dirección -->
    <h3>Dirección</h3>
    <label for="street">Calle:</label>
    <input type="text" id="street" name="street"><br><br>
    <label for="city">Ciudad:</label>
    <input type="text" id="city" name="city"><br><br>
    <label for="state">Provincia/Estado:</label>
    <input type="text" id="state" name="state"><br><br>
    <label for="zip-code">Código Postal:</label>
    <input type="text" id="zip-code" name="zip-code"><br><br>

    <!-- Botones -->
    <input type="submit" value="Guardar">
    <input type="button" value="Cerrar sesión" onclick="location.href='php/cerrar_sesion.php'">
    
  </form>
</body>
</html>
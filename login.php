
<?php

session_start();
if (isset($_SESSION['usuario'])){
    header("location: Perfil.php");
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>

<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/CSS/estilos.css">
</head>
<body>
    
    <main>
        <div class="contenedor__todo">
        <div class="caja__trasera">

            <div class="caja__trasera-login">
        <h3>¿Ya tienes una cuelta?</h3>
        <p>Inicia Sesión</p>
        <button id="btn__iniciarsesion">Iniciar Sesión</button>
        </div>

        <div class="caja__trasera-register">
            <h3>¿Aun no tienes una cuelta?</h3>
            <p>Registrate para Iniciar Sesión</p>
            <button id="btn__registrarse">Registrarse</button>
        </div>

        </div>
        <div class="contenedor__login-register">
            <form action="php/login_usuario_be.php" method="POST" class="formulario__login">

                <h2>Iniciar Sesión</h2>
                <input type="email" placeholder="Correo Electronico" name="correo" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button>Entrar</button>
            </form>
            <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                <h2>Registrarse</h2>
                <input type="text" placeholder="Nombre Completo" name="nombre" required>
                <input type="email" placeholder="Correo Electronico" name="correo" required>
                <input type="text" placeholder="Usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button>Registrarse</button>
            </form>

        </div>
        </div>
    </main>
<script src="assets/JS/script.js"></script>
</body>
</html>
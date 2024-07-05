<?php


$servidor = "localhost";
$usuario = "root";
$pass = "";
$bdatos = "empresa2";

// Establecer conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $pass, $bdatos);

// Verificar si la conexión fue exitosa
if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conectado";
}


$correo=$_POST['tes1'];
$contrasena= $_POST['tes2'];
$contrasena= hash('sha512', $contrasena);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $correo = $conexion->real_escape_string($_POST['tes1']);
    $contrasena = $conexion->real_escape_string($_POST['tes2']);
    $contrasena_hash = hash('sha512', $contrasena); // Aplicar hash SHA-512 a la contraseña

    // Validar el formato del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Formato de correo electrónico no válido.");
    }

    // Consultar la base de datos para verificar el correo y contraseña
    $query = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        // El correo existe en la base de datos, verificar la contraseña
        $fila = $resultado->fetch_assoc();
        $contrasena_bd = $fila['contrasena']; // Contraseña almacenada en la base de datos

        // Comparar la contraseña ingresada con la almacenada en la base de datos
        if ($contrasena_hash == $contrasena_bd) {
            // Inicio de sesión exitoso, redirigir al usuario a Principal.html
            header("Location: Principal.html");
            exit; // Asegurarse de terminar la ejecución del script después de redirigir
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo electrónico no registrado.";
    }
}

// Cerrar conexión
$conexion->close();
?>
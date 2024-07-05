<?php

include 'conexion_be.php';

$nombre=$_POST['nombre'];
$correo=$_POST['correo'];
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];
$contrasena = hash('sha512',$contrasena);

$query = "INSERT INTO usuarios(nombre,correo,usuario,contrasena) 
            VALUES('$nombre','$correo','$usuario','$contrasena')";

  //verificar que el correo no se repita
$verificar_correo = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$correo'");

if(mysqli_num_rows($verificar_correo)> 0){
    echo'
    <script>
    alert("Este correo ya esta registrado, intenta con otro diferente");
    window.location="../login.php";
    </script>
    ';
    exit();
}

  //verificar que el nombre de usuario no se repita
  $verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario='$usuario'");

  if(mysqli_num_rows($verificar_usuario)> 0){
      echo'
      <script>
      alert("Este usuario ya esta registrado, intenta con otro diferente");
      window.location="../login.php";
      </script>
      ';
      exit();
  }

$ejecutar=mysqli_query($conexion, $query);

if($ejecutar){
echo'
<script>
alert("Registrado Exitosamente");
window.location="../login.php";
</script>
';
}else{
    echo '
    <script>
    alert("Ops...Intentalo De Nuevo");
    window.location="../login.php";
    </script>
    ';
}

mysqli_close($conexion);

?>
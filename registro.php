<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
Carrera : ISC
Semestre: 6
Grupo   : C
-->

<?php

require('conexion.php');


$username = $_POST['usuario'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$pass = $_POST['pass'];


$registro = "INSERT INTO usuario(usuario, nombres, apellidos, contraseña, email, tipoUsuario) 
values('$username','$nombres','$apellidos',SHA1('$pass'),'$email',2)";

if($username!=null && $pass!=null){
    $resultado = mysqli_query($con, $registro);
    if($resultado){
        echo "<br> Registro exitoso";
        header("location: index.php");
    }else{
        echo "No se registro correctamente";
    }

}else{
    echo "¿Cómo pues vas a registrar campos vacíos? -_- ";
}



?>
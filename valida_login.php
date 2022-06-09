<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
Carrera : ISC
Semestre: 6
Grupo   : C
-->

<?php
   require('conexion.php');

   if(!empty($_POST)){

      if(empty($_POST['username']) || empty($_POST['password'])){
         echo "
         <script>
           alert('Ingresa usuario y contraseña');
           window.location = 'index.php';
         </script>";
         //header("location: index.php");
         }else{
         
           $user = $_POST['username'];
           $pass = $_POST['password'];
           $pass_sha1 = sha1($pass);

           //colocar la condicion si se encuentra en la bd
           $consulta = "SELECT * FROM usuario WHERE usuario = '$user'
           AND contraseña ='$pass_sha1' ";
   
           //hacer query en sql, con es la conexion
           $resultado = mysqli_query($con, $consulta);
   
           $filas = mysqli_num_rows($resultado);
           
          if($filas>0){
              //Si se encuentra un registro con los datos ingresados, se hace esto
              session_start();
              $_SESSION['username'] = $user;
              $_SESSION['password'] = $pass_sha1;

              print_r($_SESSION);
              //accesar a registro de empleados
              header("location: principal.php");
            }else{
              //Si no se encuentra ningun registro con los datos ingresados, se hace esto
              echo "<script>
                 alert('No tienes permiso de acceder');
                 window.location = 'index.php';
               </script>";
            }
         }   
   }

     echo $user;
     //cerrar conexion con la bd
     mysqli_close($con);

?>
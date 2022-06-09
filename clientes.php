<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
Carrera : ISC
Semestre: 6
Grupo   : C
-->

<?php
include("conexion.php");

session_start();
if(!isset($_SESSION['username'])){
	echo "<script>
	   alert('No puedes ingresar');
	   window.location = 'index.php';
	</script>";
	session_destroy();
	die();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clientes</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="icon" href="img/mozartIcon.png" type="image/x-icon">
    </head>
    <body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <div class="container">
                <div class="row">
                <div class="col">
                 <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 col-sm" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
                 </div>
                 <div class="col">
                 <a class="navbar-brand col-sm" href="principal.php">
                  <img src="img/icono_mozart.png"  width="70px" alt="profile">
                  Conservatorio Mozart
                 </a>
                 </div>
                 <div class=" col-sm">
                    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="editUser.php">Editar datos</a></li>
                                <li><a class="dropdown-item" href="cerrar.php">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Principal</div>
                            <a class="nav-link" href="principal.php">
                                <div class="sb-nav-link-icon"></div>
                                Principal
                            </a>
                            <a class="nav-link" href="addCliente.php">
                                <div class="sb-nav-link-icon"></div>
                                Agregar Cliente
                            </a>
                            <div class="sb-sidenav-menu-heading">Operaciones</div>
                            <a class="nav-link" href="comprar.php">
                                <div class="sb-nav-link-icon"></div>
                                Comprar instrumento
                            </a>
                            <a class="nav-link" href="clientes.php">
                                <div class="sb-nav-link-icon"></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="productos.php">
                                <div class="sb-nav-link-icon"></div>
                                Productos
                            </a>
                            <a class="nav-link" href="compras.php">
                                <div class="sb-nav-link-icon"></div>
                                Mostrar compras
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Ingresado como:</div>
                        <?php echo '<p>'.$_SESSION['username'].'</p>';?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Clientes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="principal.php">Principal</a></li>
                            <li class="breadcrumb-item active">Clientes</li>
                        </ol>
            

            <?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM cliente WHERE idCliente='$nik'");

                //echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> NIK = '$nik' .</div>';


				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
                    //Se busca no haya ningun pedido por el cliente
                    $pedidos = mysqli_query($con, "SELECT * FROM pedido WHERE idCliente='$nik'");

                    //Si no lo hay, solo elimina el cliente
                    if(mysqli_num_rows($pedidos)==0){
                        $delete = mysqli_query($con, "DELETE FROM cliente WHERE idCliente = '$nik'");
                    }
                    
                    //Si lo hay, elimina de las dos tablas
                    else{
                        $delete = mysqli_query($con, "DELETE a.*, b.* 
                        FROM pedido a 
                        LEFT JOIN cliente b 
                        ON b.idCliente = a.idCliente 
                        WHERE a.idCliente = '$nik';");
                    }
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>E mail</th>
                        <th>Domicilio</th>
                        <th>RFC</th>
                    </tr>
                    <?php

                    $sql = mysqli_query($con, "SELECT * FROM cliente ");
                    
                    if(mysqli_num_rows($sql) == 0){
                        echo '<tr><td colspan="8">No hay datos.</td></tr>';
                    }else{
                        $no = 1;
                        while($row = mysqli_fetch_assoc($sql)){
                            echo '
                            <tr>
                                <td>'.$row['idCliente'].'</td>
                                <td>'.$row['Nombre'].'</td>
                                <td>'.$row['Apellidos'].'</td>
                                <td>'.$row['telefono'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['Domicilio'].'</td>
                                <td>'.$row['RFC'].'</td>
                                <td>';
                            echo '
                                </td>
                                <td>
                                    <a href="edit.php?nik='.$row['idCliente'].'" title="Editar datos" class="btn btn-primary btn-sm">Editar<span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                    <a href="clientes.php?aksi=delete&nik='.$row['idCliente'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['Nombre'].' '.$row['Apellidos'].'?\')" class="btn btn-danger btn-sm">Eliminar<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                            ';
                            $no++;
                        }
                    }
                    ?>
                </table>
            </div>
            </main>

                <footer class="py-4 bg-light mt-auto">
                <br><br><br><br><br>
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

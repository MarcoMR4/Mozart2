<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
Carrera : ISC
Semestre: 5.to
Grupo   : B
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
        <title>Comprar instrumento</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="principal.php">Tienda de instrumentos</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
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
                            <div class="sb-sidenav-menu-heading">Operaciones</div>
                            <a class="nav-link" href="comprar.php">
                                <div class="sb-nav-link-icon"></div>
                                Comprar instrumento
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
                        <h1 class="mt-4">Comprar un instrumento</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="principal.html">Principal</a></li>
                            <li class="breadcrumb-item active">Comprar instrumento</li>
                        </ol>

                        <?php
                        if(isset($_POST['add'])){
                
                            $idProducto		     = mysqli_real_escape_string($con,(strip_tags($_POST["idProducto"],ENT_QUOTES)));//Escanpando caracteres 
                            $idCliente	         = mysqli_real_escape_string($con,(strip_tags($_POST["idCliente"],ENT_QUOTES)));//Escanpando caracteres  
                            $cantidad	         = mysqli_real_escape_string($con,(strip_tags($_POST["cantidad"],ENT_QUOTES)));//Escanpando caracteres 
                           
                            $query2 = mysqli_query($con, "SELECT precio FROM producto WHERE idProducto='$idProducto'");

                            if(mysqli_num_rows($query2) != 0){
                                $row = mysqli_fetch_assoc($query2);
                                $precio = $row['precio'];

                            }

                            $total= floatval($cantidad)*$precio;

                            /*echo "idcliente es ".$idCliente. " <br>";
                            echo "idProd es ".$idProducto. " <br>";
                            echo "cantidad es ".$cantidad. " <br>";
                            echo "El total es ".$total. " <br>";*/


                            //actualiza la cantidad de existencia del producto 
                            $query3 = mysqli_query($con, "SELECT existencia FROM producto WHERE idProducto='$idProducto'");
                            if(mysqli_num_rows($query3) != 0){
                                $row = mysqli_fetch_assoc($query3);
                                $cantidadOriginal = $row['existencia'];
                                $nueva = $cantidadOriginal-$cantidad;
                                $update = mysqli_query($con, "UPDATE producto SET existencia = '$nueva'") or die(mysqli_error());

                            }


                            //registrar compra 
                            $insert = mysqli_query($con, "INSERT INTO pedido(idCliente,idProducto,cantidad,total)
                                                VALUES ('$idCliente','$idProducto','$cantidad','$total')") or die(mysqli_error());
                            if($insert){
                                        echo '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
                                        
                                    }else{
                                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
                                    }
                            
                        }
                        ?>

                        <form class="form-horizontal" action="" method="post">
                            
                            <div class="form-group">
                                    <label class="col-sm-3 control-label">Nombre del producto</label>
                                    <div class="col-sm-4">
                                        <?php 
                                        $result = mysqli_query($con, "SELECT idProducto, nombre FROM producto");
                                        ?>
                                        <select name="idProducto" id="producto" class="form-control">
                                            <?php foreach($result as $r): ?>
                                                <option value="<?php echo $r['idProducto']; ?>"><?php echo ''.$r['idProducto'].'.- '.$r['nombre'].'';?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                            </div>

                            <div class="form-group col-sm-3 control-label">
                                    <label class="col-sm-3 control-label">Clientes</label>
                                    <!--<select name="filter" class="form-control" onchange="form.submit()">-->
                                    <div class="col-sm-4">
                                        <?php 
                                        $result = mysqli_query($con, "SELECT idCliente, Nombre FROM cliente");
                                        ?>
                                        <select name="idCliente" id="clientes" class="form-control">
                                            <?php foreach($result as $r): ?>
                                                <option value="<?php echo $r['idCliente']; ?>"><?php echo ''.$r['idCliente'].'.- '.$r['Nombre'].'';?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                            </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Cantidad</label>
                                    <div class="col-sm-4">
                                        <input type="number" id="tentacles" name="cantidad" min="1" max="10" name="cantidad"  class="form-control" placeholder="Cantidad" required>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">&nbsp;</label>
                                    <div class="col-sm-6">
                                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Comprar articulo">
                                        <a href="productos.php" class="btn btn-sm btn-danger">Cancelar</a>
                                    </div>
                                </div>
			            </form> 
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
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
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

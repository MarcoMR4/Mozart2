<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
Carrera : ISC
Semestre: 5.to
Grupo   : B
-->

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ingreso de usuario</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Ingreso</h3></div>
                                    <div class="card-body">
                                        <form action='valida_login.php' action='editUser.php' method="post" id="loginform" class="form-horizontal" role="form">
                                    
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Nombre de Usuario">                                        
                                                    </div>
                                                
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="contraseña">
                                                    </div>

                                                <div style="margin-top:10px" class="form-group">
                                                    <!-- Button -->
                
                                                    <div class="col-sm-12 controls">
                                                              <input type="submit" value="Entrar" class="btn btn-success">
                
                                                    </div>
                                                </div>
                
                
                                        </form>    
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Necesitas una cuenta? ¡Registrate!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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

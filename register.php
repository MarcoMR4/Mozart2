<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registro de usuario</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crear una cuenta</h3></div>
                                    <div class="card-body">
                                        <form action='registro.php' method="post" id="signupform" class="form-horizontal" role="form">
                                
                                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                                <p>Error:</p>
                                                <span></span>
                                            </div>
                                                
                                            
                                              
                                            <div class="form-group">
                                                <label for="user" class="col-md-3 control-label">Usuario</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="usuario" placeholder="nombre de Usuario">
                                                </div>
                                            </div>
                                                
                                            <div class="form-group">
                                                <label for="nombres" class="col-md-3 control-label">Nombres</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="nombres" placeholder="nombres">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="apellidos" class="col-md-3 control-label">Apellidos</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="apellidos" placeholder="apellidos">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-md-3 control-label">Email</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="email" placeholder="Direccion de correo electronico">
                                                </div>
                                            </div>
            
                                            <div class="form-group">
                                                <label for="pass" class="col-md-3 control-label">Contraseña</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="pass" placeholder="Contraseña">
                                                </div>
                                            </div>
                                            
                                        
            
                                            <div class="form-group">
                                                <!-- Button -->          
                                                                            
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input type="submit" value="Registrarse" class="btn btn-success">  
                                                    
                                                    
                                                </div>
                                            </div>
                                            
                                            
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">¿Tienes una cuenta? Ir al ingreso</a></div>
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

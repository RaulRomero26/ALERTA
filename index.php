<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Busqueda y Alerta | Login</title>
    <link rel="stylesheet" href="./libs/bootstrap.min.css"> 
    <link rel="stylesheet" href="./css/style.css"> 
    <link rel="stylesheet" href="./css/root.css"> 
</head>

<body>
    <nav class="navbar" id="nav_login"></nav>
    <div class="container">
        <div class="abs-center">
            <div class="row form">
                <div class=" col-lg-12 mt-n3">
                    <div class="text-center">
                        
                        <h5 class="card-title mb-5 mt-3 col-12">Sistema de Alerta Detenidos de Importancia</h5>
                        <form action="model/login.php" method="POST" class="needs-validation " novalidate autocomplete="off">
                            <div class="form-row  mb-5 text-center">
                                <div class="col-md-12 col-lg-12 mb-lg-3 mb-md-1 mt-lg-1 ">
                                    <label for="usuario">Usuario:</label>
                                </div>

                                <div class="mx-auto col-md-12 col-lg-7 mt-lg-1 text-center">
                                    <input name="User_Name" type="text" class="form-control" id="usuario" placeholder="Ingrese su usuario" required>
                                    <div class="invalid-feedback">Este campo es obligatorio</div>
                                </div>

                                <div class="col-md-12 col-lg-12 mb-lg-3 mb-md-1 mt-lg-4">
                                    <label for="contrasena">Contraseña:</label>
                                </div>

                                <div class="mx-auto col-md-12 col-lg-7 mt-lg-4">
                                    <input name="Password" type="password" class="form-control" id="contrasena" placeholder="Ingrese su contraseña" required>
                                    <div class="invalid-feedback">Este campo es obligatorio</div>
                                </div>
                            </div>
                           
                            <div class=" mb-5" >
                                <span style="color: red;"><?php echo (isset($data['ErrorMessage']))?$data['ErrorMessage']:"";?></span>
                            </div>
                            

                            <div class=" mx-auto form-check mt-n5 col-lg-5">
                                <input class="form-check-input" type="checkbox" value="" id="check_pass">
                                <label class="form-check-label" for="check_pass">
                                    Mostrar contraseña
                                </label>
                            </div>
                            <button class="btn btn-ssc mt-4" type="submit" name="enviarLogin">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <footer>
        <div class="footer-text text-center text-muted">© 2022 Copyright:
            ©2022 Todos los derechos reservados. SSCMP
        </div>
    </footer>

    <script src="./libs/bootstrap.bundle.min.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>
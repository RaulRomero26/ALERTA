<?php
    session_start();
    if(!isset($_SESSION['Usuario'])) {
    header("Location: ./index.php");
    exit();
}?>

<html>
  <head>
    <title>Busqueda lista Negra Remisiones</title>
    <link rel="stylesheet" href="./css/root.css"> 
    <link rel="stylesheet" href="./libs/bootstrap.min.css"> 
  </head>
  <body>
    <nav class="navbar bg-nav ">
           <span class=" blanco">
             <div class="col-md-12"> Bienvenido <?php  echo $_SESSION['Usuario'] ?></div>
           </span>

            <a type="button" class="btn btn-primary ssc-button" href="./model/logout.php">Cerrar Sesión</a>
    </nav>
    <div class="container mt-4">


        <div class="row mt-4 d-flex justify-content-center">
            <div class="alert alert-info col-md-10" role="alert">
                <h5 class="alert-heading"> Instrucciones</h5>
                *Para realizar una busqueda, es necesario ingresar los campos obligatorios.
                <br/>
                Se pueden realizar consultas solo ingresando el campo de Banda.
            </div>

        </div>

        <div class="row mt-3">
            <h4 class="text-center grande">Sistema de Búsqueda y Alertas</h4> 
        </div>
        <div class="row mt-3">
            <div class="col-md-6 linea">
                <div class="row">
                    <h3 class="text-center mb-5">Busqueda Personas</h3>
                </div>
                <div class="row">
                    <h6>Campos Obligatorios: </h6>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="Nombre">Nombre:</label> <span class="obligatorio">*</span>
                        <input class="form-control" type="text" name="Nombre" id="Nombre">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ApPaterno">Apellido paterno:</label> <span class="obligatorio">*</span>
                        <input class="form-control" type="text" name="ApPaterno" id="ApPaterno">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ApMaterno">Apellido Materno:</label> <span class="obligatorio">*</span>
                        <input class="form-control" type="text" name="ApMaterno" id="ApMaterno">
                    </div>
                </div>
                <div class="row mt-3">
                    <h6>Campos Opcionales: </h6>
                </div>
                <div class="row">
                    <!-- <div class="form-group col-md-4">
                        <label for="Alias">Alias:</label>
                        <input class="form-control" type="text" name="Alias" id="Alias">
                    </div> -->
                    <div class="form-group col-md-4">
                        <label for="Banda">Banda:</label>
                        <input class="form-control" type="text" name="Banda" id="Banda">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12  d-flex justify-content-center">
                        <button type="button" class="btn btn-primary mb-2 ssc-button" id="boton_persona" onclick="getCoincidencias()">Buscar Persona</button>
                    </div>
                </div>
                <div class="row mt-4 d-flex justify-content-center">
                    <div class="alert alert-warning  col-md-10" role="alert" id="observaciones" style="display:none;">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <h3 class="text-center mb-5">Busqueda Vehiculo</h3>
                </div>
                <div class="row mb-2 mt-4">
                    <div class="form-group col-md-4">
                        <label for="Placa">Placa: </label>
                        <input class="form-control" type="text" name="Placa" id="Placa">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Niv">Niv:</label>
                        <input class="form-control" type="text" name="Niv" id="Niv">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Banda">Banda:</label>
                        <input class="form-control" type="text" name="Banda_Vehiculo" id="Banda_Vehiculo">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12  d-flex justify-content-center">
                        <button type="button" class="btn btn-primary mb-2 mt-5 ssc-button" id="boton_vehiculo" onclick="getCoincidenciasVeh()">Buscar Vehiculo</button>
                    </div>
                </div>
                <div class="row mt-4 d-flex justify-content-center">
                    <div class="alert alert-warning col-md-10" role="alert" id="observaciones_vehiculo" style="display:none;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./libs/bootstrap.bundle.min.js"></script>
    <script src="./js/peticion.js"></script>
</body>
</html>
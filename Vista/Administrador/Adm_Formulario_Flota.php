
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ | Registro de Vehículos</title>
    
    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_Flota.css">

</head>
<body>    
    <?php

        // Incluir el archivo de conexión a la base de datos
        require_once '../../Controlador/Utilidades/Conexion_BD.php';

        // Crear una instancia de la clase Database
        $connMySQL = new Conexion_BD();

        // Consultar los tipos de vehículos
        $sqlTipoVehiculos = "SELECT * FROM tipovehiculo ORDER BY id";
        $dataTipoVehiculosSelect = $connMySQL->executeQuery($sqlTipoVehiculos);

        // Consultar los tipos de combustibles
        $sqlTipoCombustible = "SELECT * FROM tipocombustible ORDER BY id";
        $dataTipoCombustibleSelect = $connMySQL->executeQuery($sqlTipoCombustible);

        ?>

    <form action="../../Controlador/Ctrl_Administrador/MySQL_Registro_Flota.php" id="Registrar_Flota"  method="post" novalidate>
      
        <h2><hr>Registrar Nuevo Veh&iacute;culo<hr></h2>
        
        <diV class="colums">
          
          <div data-div="1">
            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" onkeyup="convertirAMayusculas(this)">
          </div>
          
          <div data-div="1">
            <label for="ano_fabricacion">Año de fabricación:</label>
            <input type="number" id="año" name="ano_fabricacion" onkeyup="convertirAMayusculas(this)">
          </div>
        
        </div>

        <diV class="colums">

          <div data-div="2">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" onkeyup="convertirAMayusculas(this)">
          </div>        
          
          <div data-div="2">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" onkeyup="convertirAMayusculas(this)">
          </div>

        </div>   
        
        <diV class="colums">

          <div data-div="3">
            <label for="tipo_vehiculo" class="text-right">Tipo de vehiculos</label>
            <select name="tipo_vehiculo_id" class="form-control form-control-sm">
            <option value="">Seleccionar</option>

            <?php
              while ($dataSelect = mysqli_fetch_array($dataTipoVehiculosSelect)) { ?>
                <option value="<?php echo $dataSelect["id"]; ?>">
                  <?php echo utf8_encode($dataSelect["vehiculotipo"]); ?>
                </option>
            <?php } ?>
            </select><br>
          </div>
          
          <div data-div="3">
            <label for="tipocombustible" class="text-right">Tipo de combustible</label>
            <select name="tipo_combustible_id" class="form-control form-control-sm">
              <option value="">Seleccionar</option>
              
              <?php
                while ($dataSelect = mysqli_fetch_array($dataTipoCombustibleSelect)) { ?>
                  <option value="<?php echo $dataSelect["id"]; ?>">
                    <?php echo utf8_encode($dataSelect["combustibletipo"]); ?>
                  </option>
              <?php } ?>

            </select>
          </div>

        </div>     
        
        <!-- Button de envio de registro -->
        <input type="submit" value="Agregar">

    </form>

    <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>
    
</body>
</html>

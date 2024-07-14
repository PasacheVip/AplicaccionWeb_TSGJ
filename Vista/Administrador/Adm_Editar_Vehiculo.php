<?php
    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Verificar si se proporcionó un ID de usuario válido en la URL
    if (isset($_GET['IV']) && !empty($_GET['IV'])) {

        // Obtener el ID de usuario de la URL
        $id_vehiculo = $_GET['IV'];

        // Crear una instancia de la clase Database
        $connMySQL = new Conexion_BD();

        // Obtener los datos del usuario de la base de datos
        $sql = "SELECT * FROM vehiculos WHERE id=?";

        // Consultar los tipos de vehículos
        $sqlTipoVehiculos = "SELECT * FROM tipovehiculo ORDER BY id";
        $dataTipoVehiculosSelect = $connMySQL->executeQuery($sqlTipoVehiculos);

        // Consultar los tipos de combustibles
        $sqlTipoCombustible = "SELECT * FROM tipocombustible ORDER BY id";
        $dataTipoCombustibleSelect = $connMySQL->executeQuery($sqlTipoCombustible);

        // Preparar la consulta
        $stmt = $connMySQL->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $id_vehiculo);
        $stmt->execute();

        $result = $stmt->get_result(); // Obtener el resultado de la consulta
        $vehiculo = $result->fetch_assoc(); // Obtener los datos del usuario como un array asociativo

        // Cerrar la conexión a la base de datos
        $connMySQL->closeConnection();

    } else {

        // Incluir el archivo de conexión a la base de datos
        //require_once '../../Controlador/Utilidades/Sesion_Destroy.php';
        //exit();

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Editar Usuario</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/EditarVehiculo.css">
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_Flota.css">

</head>
<body>
    
    <button class="button" onclick="location.href='Adm_Gestion_Vehicular.php'">
        <div class="button-box">
          <span class="button-elem">
            <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
            </svg>
          </span>
          <span class="button-elem">
            <svg viewBox="0 0 46 40">
              <path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
            </svg>
          </span>
        </div>
    </button>
      
    
    <form action="../../Controlador/Ctrl_Administrador/MySQL_Editar_Vehiculo.php" id="Registrar_Flota"  method="post" novalidate>
      
        <h2><hr>Modificar Veh&iacute;culo<hr></h2>
        
        <diV class="colums">
          
          <div data-div="1">
          <input type="hidden" name="id_vehiculo" id="id_vehiculo" value="<?php echo $vehiculo['id']; ?>">
            <label for="placa">Placa:</label>
            <input type="text" id="placa" value="<?php echo $vehiculo['placa']; ?>" name="placa" onkeyup="convertirAMayusculas(this)">
          </div>
          
          <div data-div="1">
            <label for="ano_fabricacion">Año de fabricación:</label>
            <input type="number" id="año" value="<?php echo $vehiculo['ano_fabricacion']; ?>"  name="ano_fabricacion" onkeyup="convertirAMayusculas(this)">
          </div>
        
        </div>

        <diV class="colums">

          <div data-div="2">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" value="<?php echo $vehiculo['marca']; ?>"  name="marca" onkeyup="convertirAMayusculas(this)">
          </div>        
          
          <div data-div="2">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" value="<?php echo $vehiculo['modelo']; ?>"  name="modelo" onkeyup="convertirAMayusculas(this)">
          </div>

        </div>   
        
        <diV class="colums">

          <div data-div="3">
            <label for="tipo_vehiculo" class="text-right">Tipo de vehiculos</label>
            <select name="tipo_vehiculo_id" class="form-control form-control-sm">
            <option value="<?php echo $vehiculo['tipo_vehiculo_id']; ?>"><?php echo $vehiculo['tipo_vehiculo_id']; ?></option>

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
              <option value="<?php echo $vehiculo['tipo_combustible_id']; ?>"><?php echo $vehiculo['tipo_combustible_id']; ?></option>
              
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
    
    <!--===== ARCHIVO JS - VALIDACION DE FORMULARIO FLOTA =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Agregar_Vehiculo.js"></script>

    <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

</body>
</html>

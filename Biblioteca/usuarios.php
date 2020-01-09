<!DOCTYPE html>
<html>
    <head>
        <title>Biblioteca</title>
        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1" />      
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="estilos/estilos2.css">       

        
    </head>

    <body>
        <header><br><h1 style="text-align:center;"> LISTA DE USUARIOS REGISTRADOS </h1>
             <br><br>
        </header>
        <div class = "container-fluid text-center" id="contenedor">
        <div class="row">
            <div class="col-lg-4">
                <div class="vertical-menu">     
                    <a href="#" class="nombre"> Administrador </a>             
                    <a href="menu_admin.php" > <i class="glyphicon glyphicon-user"></i> Menu Administrador</a>                               
                    <a href="index.php"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                    <a href="usuarios.php" class="active"> <i class="glyphicon glyphicon-user"></i> Listado usuarios</a>
                    <a href="libros.php"><i class="glyphicon glyphicon-book"></i>Listado libros</a>
                    <a href="registro.php"><i class="glyphicon glyphicon-plus"></i> Registro de libros</a>
                    <a href="disponibilidad.php"><i class="glyphicon glyphicon-book"></i> Disponibilidad</a>
                </div>
            </div>
            <div  class="col-lg-7 well">
                <?php
                    include("conexion.php");
                    

                    $consulta="SELECT * FROM usuarios WHERE nombre <> 'admin'";
                    $paquete=mysqli_query($conexion,$consulta);

                    echo "<table style='border:1px solid;'><thead>
                    <th>Id_usuario</th><th>Nombre usuario</th><th>Clave</th></thead>";   
                    
                    while($fila=mysqli_fetch_array($paquete)){
                        echo '<tr><form action="usuarios.php" method="post">
                        <td>'.$fila['id_usuario'].'</td>
                        <td>'.$fila['nombre'].'</td>   
                        <td>'.$fila['clave'].'</td>                     
                        <td style="display:none;"><input type="hidden" name="id" value="'.$fila['id_usuario'].'"></td> </form></tr>';
                    }
                    echo '</table>';                 

                ?>


            </div>
    </body>

</html>
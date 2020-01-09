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
    <header><br><h1 style="text-align:center;">DISPONIBILIDAD DE LIBROS</h1>
        <br><br>
    </header>
    <div class = "container-fluid text-center" id="contenedor">
    <div class="row">
        <div class="col-lg-3">
            <div class="vertical-menu">
                <a href="#" class="nombre"> Administrador </a>             
                <a href="menu_admin.php" > <i class="glyphicon glyphicon-user"></i> Menu Administrador</a>                               
                <a href="index.php"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                <a href="usuarios.php" > <i class="glyphicon glyphicon-user"></i> Listado usuarios</a>
                <a href="libros.php" ><i class="glyphicon glyphicon-book"></i>Listado libros</a>
                <a href="registro.php"><i class="glyphicon glyphicon-plus"></i> Registro de libros</a>
                <a href="disponibilidad.php" class="active"><i class="glyphicon glyphicon-book"></i> Disponibilidad</a>
            </div>
        </div>

        <div class="col-lg-8 well">
            <?php
                include("conexion.php");

                $consulta="SELECT * FROM libros";
                $paquete=mysqli_query($conexion,$consulta);

                echo '<h4>Libros disponibles</h4>';
                
                echo "<table style='border:1px solid;'><thead>
                <th>Titulo</th><th>Imagen</th><th>Autor</th><th>Cantidad disponible</th></thead>";  
                
                while ($fila=mysqli_fetch_array($paquete)){
                    $consultap="SELECT COUNT(id_usuario) AS qpres FROM prestamos WHERE id_libro='$fila[id_libro]' AND fecha_devolucion IS NULL";
                    $paquetep=mysqli_query($conexion,$consultap);
                    $filap=mysqli_fetch_array($paquetep);

                    if ($fila['cantidad']>$filap['qpres']){
                        echo '<tr><form action="disponibilidad.php" method="post">
                        <td>'.$fila['titulo'].'</td>
                        <td><a href="'.$fila['imagen'].'" target="_blank"><img  width=40px height=60px src="'.$fila['imagen'].'"></a></td>
                        <td>'.$fila['autor'].'</td>  
                        <td>'.($fila['cantidad']-$filap['qpres']).'</td>                                                 
                        <td style="display:none;"><input type="hidden" name="id" value="'.$fila['id_libro'].'"></td> </form></tr>';
                    }      
                }
                echo "</table>";

                $consulta="SELECT * FROM prestamos WHERE fecha_devolucion IS NULL";
                $paquete=mysqli_query($conexion,$consulta);
                
                echo '<h4>Libros en préstamo</h4>';

                echo "<table style='border:1px solid;'><thead>
                <th>Titulo</th><th>Imagen</th><th>Autor</th><th>Fecha préstamo</th><th>Usuario</th></thead>";  

                while ($fila=mysqli_fetch_array($paquete)){
                    $consulta="SELECT * FROM libros WHERE id_libro='$fila[id_libro]'";
                    $paquete2=mysqli_query($conexion,$consulta);
                    $fila2=mysqli_fetch_array($paquete2);

                    $consulta="SELECT * FROM usuarios WHERE id_usuario='$fila[id_usuario]'";
                    $paquete2=mysqli_query($conexion,$consulta);
                    $fila3=mysqli_fetch_array($paquete2);

                    echo '<tr><form action="disponibilidad.php" method="post">
                    <td>'.$fila2['titulo'].'</td>
                    <td><a href="'.$fila2['imagen'].'" target="_blank"><img  width=40px height=60px src="'.$fila2['imagen'].'"></a></td>
                    <td>'.$fila2['autor'].'</td>
                    <td>'.$fila['fecha_prestamo'].'</td>
                    <td>'.$fila3['nombre'].'</td>                 
                    <td style="display:none;"><input type="hidden" name="id" value="'.$fila['id_libro'].'"></td> </form></tr>';

                }
            ?>

        </div>

    </div>
    </div>
    
</body>

</html>
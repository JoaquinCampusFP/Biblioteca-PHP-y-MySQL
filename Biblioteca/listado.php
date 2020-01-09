<!DOCTYPE html>
<html>
    <head>
        <title>Biblioteca</title>
        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1" />      
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="estilos/estilos2.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>

    <body>
        <header><br><h1 style="text-align:center;"> LISTA DE LIBROS EN PRÉSTAMO </h1>
             <br><br>
        </header>
        <div class = "container-fluid text-center" id="contenedor">
        <div class="row">
            <div class="col-lg-4">
                <div class="vertical-menu">
                    <a href="#" class="nombre"> <?php session_start(); echo $_SESSION['nombre']; ?> </a>
                    <a href="menu_usuario.php" ><i class="glyphicon glyphicon-user"></i>  Menu usuario</a>
                    <a href="index.php"><i class="glyphicon glyphicon-home"></i>  Inicio</a>
                    <a href="prestamos.php"><i class="glyphicon glyphicon-plus-sign"></i> Préstamos</a>
                    <a href="devoluciones.php"><i class="glyphicon glyphicon-minus-sign"></i> Devoluciones</a>
                    <a href="listado.php" class="active"><i class="glyphicon glyphicon-book"></i> Listado</a>
                </div>
            </div>

            <div class="col-lg-7 well" >
                <?php
                    include("conexion.php");
                    
                    $consulta="SELECT * FROM prestamos  WHERE  fecha_devolucion IS NULL";
                    $paquete=mysqli_query($conexion,$consulta);

                    echo "<table style='border:1px solid;'><thead>
                    <th>Titulo</th><th>Imagen</th><th>Autor</th><th>Nombre usuario</th></thead>"; 
                    
                    while($fila=mysqli_fetch_array($paquete)){
                        $consulta2="SELECT * FROM usuarios WHERE id_usuario='$fila[id_usuario]'";
                        $paquete2=mysqli_query($conexion,$consulta2);
                        $fila2=mysqli_fetch_array($paquete2);

                        $consulta2="SELECT * FROM libros WHERE id_libro='$fila[id_libro]'";
                        $paquete2=mysqli_query($conexion,$consulta2);
                        $fila3=mysqli_fetch_array($paquete2);

                        echo '<tr><form action="prestamos.php" method="post">
                        <td>'.$fila3['titulo'].'</td>
                        <td><a href="'.$fila3['imagen'].'" target="_blank"><img  width=40px height=60px src="'.$fila3['imagen'].'"></a></td>
                        <td>'.$fila3['autor'].'</td>
                        <td>'.$fila2['nombre'].'</td>                            
                        <td style="display:none;"><input type="hidden" name="id" value="'.$fila['id_libro'].'"></td> </form></tr>';
                    }
                    echo '</table>';

                ?>

            </div>
        </div>
        </div>
    </body>

</html>
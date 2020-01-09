<!DOCTYPE html>
<html>
    <head>
        <title>Biblioteca</title>
        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="estilos/estilos.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     
    </head>

    <body >
        <header><br><h1 style="text-align:center;"> LISTA DE TUS LIBROS PRESTADOS</h1>
        <br><br>
     </header>  
        <div class = "container-fluid text-center" id="contenedor">
        <div class="row">
            <div class="col-lg-4">
                <div class="vertical-menu">
                    <a href="#" class="nombre"> <?php session_start(); echo $_SESSION['nombre']; ?> </a>
                    <a href="menu_usuario.php" class="active"><i class="glyphicon glyphicon-user"></i>  Menu usuario</a>
                    <a href="index.php"><i class="glyphicon glyphicon-home"></i>  Inicio</a>
                    <a href="prestamos.php"><i class="glyphicon glyphicon-plus-sign"></i> Préstamos</a>
                    <a href="devoluciones.php"><i class="glyphicon glyphicon-minus-sign"></i> Devoluciones</a>
                    <a href="listado.php"><i class="glyphicon glyphicon-book"></i> Listado</a>
                </div>
            </div>
            <div class="col-lg-7 well" >
                <?php
                    include("conexion.php");
                    $id_usuario=$_SESSION['id'];
                   

                    if (isset($_POST['devolver'])){
                        $id_prestamo=$_POST['id_prestamo'];
                        $fecha=date("Y-m-d");
                        $consulta="UPDATE  prestamos SET fecha_devolucion='$fecha' WHERE id_prestamo='$id_prestamo'";
                        $paquete=mysqli_query($conexion,$consulta);

                        if ($paquete){
                            echo '<p> La devolución se ha realizado correctamente</p>';
                        }

                    }

                    $consulta="SELECT * FROM  prestamos WHERE  id_usuario='$id_usuario' AND fecha_devolucion IS  NULL";
                    $paquete=mysqli_query($conexion, $consulta);  

                    echo "<table   ><thead>
                    <th>Titulo</th><th>Imagen</th><th>Autor</th><th>Fecha préstamo</th><th>Devolucion</th></thead>"; 

                    while($fila=mysqli_fetch_array($paquete)){
                        $consulta2="SELECT * FROM libros WHERE id_libro='$fila[id_libro]'";

                        $paquete2=mysqli_query($conexion,$consulta2);
                        
                        $fila2=mysqli_fetch_array($paquete2);
                        echo '<tr><form action="devoluciones.php" method="post">
                        <td>'.$fila2['titulo'].'</td>
                        <td><a href="'.$fila2['imagen'].'" target="_blank"><img  width=40px height=60px src="'.$fila2['imagen'].'"></a></td>
                        <td>'.$fila2['autor'].'</td>
                        <td>'.$fila['fecha_prestamo'].'</td>
                        <input type="hidden" name="id_prestamo" value="'.$fila['id_prestamo'].'">
                        <td><input type="submit" style="width:auto;" name="devolver" value="Devolver"></td></form></tr>';
   
                    } 

                    echo "</table>"; 

                    if ( $fila=[]){
                        echo '<h1 style="text-align:center;> No tiene libros en préstamo </h1>';
                    }
                ?>
                
            </div>
        </div>
    </body>
</html>
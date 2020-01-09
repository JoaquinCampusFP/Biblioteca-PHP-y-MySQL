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

    <body >
        <header><br><h1 style="text-align:center;">LISTADO DE LIBROS DISPONIBLES </h1>
            <br><br>
        </header>
    
         <div class = "container-fluid text-center" id="contenedor">

            <div class="row">
                <div class="col-lg-4">
                    <div class="vertical-menu">
                    <a href="#" class="nombre"> <?php session_start(); echo $_SESSION['nombre']; ?> </a>
                        <a href="menu_usuario.php" > <i class="glyphicon glyphicon-user"></i> Menu usuario</a>
                        <a href="index.php"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                        <a href="prestamos.php" class="active"><i class="glyphicon glyphicon-plus"></i> Préstamos</a>
                        <a href="devoluciones.php"><i class="glyphicon glyphicon-minus"></i> Devoluciones</a>
                        <a href="listado.php"><i class="glyphicon glyphicon-book"></i> Listado</a>
                    </div>
                </div>
             
                <div  class="col-lg-7 well"  >         
                    <?php
                        include("conexion.php");

                        if (isset($_POST['adquirir'])){

                            $id_libro=$_POST['id'];
                            $id_user=$_SESSION['id'];
                            $fecha=date("Y-m-d");
                            $consulta="INSERT INTO prestamos VALUES (0,'$id_libro','$id_user','$fecha', null)";
                            $paquete=mysqli_query($conexion,$consulta) ;

                            if ($paquete){
                                echo '<p> El préstamo se ha realizado correctamente</p>';
                            }
                            echo '<br>';

                        }
                         
                        $consulta="SELECT * FROM libros ";
                        $paquete=mysqli_query($conexion,$consulta);

                        echo "<table style='border:1px solid;'><thead>
                        <th>Titulo</th><th>Imagen</th><th>Autor</th><th>&nbsp; Cantidad <br>&nbsp; disponible</th><th>Préstamo</th></thead>"; 
                        
                        while($fila=mysqli_fetch_array($paquete)){
                            $consultap="SELECT COUNT(id_usuario) AS qpres FROM prestamos WHERE id_libro='$fila[id_libro]' AND fecha_devolucion IS NULL";
                            $paquetep=mysqli_query($conexion,$consultap);

                            $filap=mysqli_fetch_array($paquetep);                         

                            if ($fila['cantidad']>$filap['qpres']){
                                echo '<tr><form action="prestamos.php" method="post">
                                <td>'.$fila['titulo'].'</td>
                                <td><a href="'.$fila['imagen'].'" target="_blank"><img  width=40px height=60px src="'.$fila['imagen'].'"></a></td>
                                <td>'.$fila['autor'].'</td>  
                                <td>'.($fila['cantidad']-$filap['qpres']).'</td>                                                 
                                <td><input type="submit" name="adquirir" value="Adquirir"></td>
                                <td style="display:none;"><input type="hidden" name="id" value="'.$fila['id_libro'].'"></td> </form></tr>';
                            }                        
                        }
                        echo '</table>';
                    ?>                

                </div>
            </div>

        </div>

    </body>

</html>
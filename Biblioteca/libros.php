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
        <style>
         input [type=text]{
             text-align:center;
         }
        </style>
       
    </head>

    <body>
    <header><br><h1 style="text-align:center;"> LISTA DE LIBROS REGISTRADOS </h1>
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
                    <a href="libros.php" class="active"><i class="glyphicon glyphicon-book"></i>Listado libros</a>
                    <a href="registro.php"><i class="glyphicon glyphicon-plus"></i> Registro de libros</a>
                    <a href="disponibilidad.php"><i class="glyphicon glyphicon-book"></i> Disponibilidad</a>
                </div>
            </div>
            <div class="col-lg-8 well">
                <?php
                    include("conexion.php");
                    
                    $consulta="SELECT * FROM libros";
                    $paquete=mysqli_query($conexion,$consulta);
                    
                    echo "<table style='border:1px solid;'><thead>
                    <th>Id_libro</th><th>Imagen</th><th>Titulo</th><th>Autor</th><th>Cantidad</th><th>Opción1</th><th>Opción2</th></thead>";  

                    while($fila=mysqli_fetch_array($paquete)){
                        echo '<tr><form action="libros.php" method="post">
                        <td><input type="text" name="id_libro" size=2 value="'.$fila['id_libro'].'"></td>
                        <td><a href="'.$fila['imagen'].'" target="_blank"><img  width=40px height=60px src="'.$fila['imagen'].'"></a></td>
                        <td><input type="text" name="titulo" size="30" value="'.$fila['titulo'].'"></td>   
                        <td><input type="text" name="autor" size="15" value="'.$fila['autor'].'"></td>
                        <td><input type="text" name="cantidad" size=2 value="'.$fila['cantidad'].'"></td>
                        <td><input type="submit" name="actualizar" value="Actualizar"></td>
                        <td><input type="submit" name="borrar" value="Borrar"></td></form></tr>';
                    }
                    echo '</table>';      


                    if (isset($_POST['actualizar'])){
                        $id_libro=$_POST['id_libro'];
                        $titulo=$_POST['titulo'];
                        $autor=$_POST['autor'];
                        $cantidad=$_POST['cantidad'];

                        $consulta="UPDATE  libros SET id_libro='$id_libro',titulo='$titulo',autor='$autor', cantidad='$cantidad' WHERE id_libro='$id_libro'";
                        $paquete=mysqli_query($conexion, $consulta);
                        if ($paquete){
                            echo '<br> Datos actualizados correctamente';
                        }
                    }
                    if (isset($_POST['borrar'])){
                        $id_libro=$_POST['id_libro'];
                        $consulta="DELETE FROM libros WHERE id_libro='$id_libro'";
                        $paquete=mysqli_query($conexion,$consulta);
                        if ($paquete){
                            echo '<br>Se han borrado los datos </br>';
                        }
                    }

                ?>
            </div>
        </div>

    </body>

</html>
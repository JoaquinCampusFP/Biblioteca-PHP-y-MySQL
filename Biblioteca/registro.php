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
            form{
                width: 30vw;
                margin: 0 auto;
                font-family: Arial;
                padding: 20px;
                border: 2px solid white;
                border-radius: 8px;
                background-color: silver;
                filter: drop-shadow(.3em .3em .3em);
            }
            
            h2{
                margin: 0;
                padding: 0;
                text-align: center;
                color: white;
                margin-bottom: 4px;
            }
            
            form div{ margin-bottom: 8px;}
            
            label{
                width: 30%;
                float: left; 
            }
            
            input {
                width:65%;
                border-radius: 5px;
            }       
        </style>
    </head>

    <body>
        <header><br><h1 style="text-align:center;"> REGISTRO DE LIBROS</h1>
             <br><br>
        </header>
        <div class = "container-fluid text-center" id="contenedor">
        <div class="row">
            <div class="col-lg-4">
                <div class="vertical-menu">     
                    <a href="#" class="nombre"> Administrador </a>             
                    <a href="menu_admin.php" > <i class="glyphicon glyphicon-user"></i> Menu Administrador</a>                               
                    <a href="index.php"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                    <a href="usuarios.php" > <i class="glyphicon glyphicon-user"></i> Listado usuarios</a>
                    <a href="libros.php" ><i class="glyphicon glyphicon-book"></i>Listado libros</a>
                    <a href="registro.php" class="active"><i class="glyphicon glyphicon-plus"></i> Registro de libros</a>
                    <a href="disponibilidad.php"><i class="glyphicon glyphicon-book"></i> Disponibilidad</a>
                </div>
            </div>
            <div id="form" class="col-lg-7 well">
                <form action="registro.php" method="post" enctype="multipart/form-data">
                    <h2>Introduzca los datos</h2>
                    <br>
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="titulo" required><br><br>
                    </div>
                    <div class="form-group">
                        <label>Autor</label>
                        <input type="text" name="autor" required><br><br>
                    </div>
                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" name="cantidad" required><br><br>
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="imagen" required><br><br>
                    </div>
                    <input type="submit" name="submit" value="Registrar">
                    <br>
                    <?php
                        include("conexion.php");
                        if (isset($_POST['submit'])){
                            $titulo=$_POST['titulo'];
                            $autor=$_POST['autor'];
                            $cantidad=$_POST['cantidad'];
                           
                            $rutaenservidor="imagenes";
                            $rutatemporal=$_FILES['imagen']['tmp_name'];

                            $rutadestino=$rutaenservidor."/".$_FILES['imagen']['name'];

                            move_uploaded_file($rutatemporal,$rutadestino);

                            $consulta="INSERT INTO libros VALUES (0,'$titulo','$autor', '$cantidad','$rutadestino')";
                            $paquete=mysqli_query($conexion,$consulta);

                            if ($paquete){
                                echo '<h4> Los datos se han guardado correctamente</h4>';
                            }
                        }

                    ?>
                </form>

            </div>
        </div>

    </body>

</html>
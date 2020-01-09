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
        <header>
            <br>
            <?php
                 session_start();
                echo '<h1 style="text-align:center;"> Bienvenido Administrador</h1>';
            ?>
            <br>
        </header>
        <div class = "container-fluid text-center" >
           <div class="row">
                <div class="col-lg-4">
                    <div class="vertical-menu">     
                        <a href="#" class="active"> <i class="glyphicon glyphicon-user"></i> Menu Administrador</a>                               
                        <a href="index.php"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                        <a href="usuarios.php" > <i class="glyphicon glyphicon-user"></i> Listado usuarios</a>
                        <a href="libros.php"><i class="glyphicon glyphicon-book"></i>Listado libros</a>
                        <a href="registro.php"><i class="glyphicon glyphicon-plus"></i> Registro de libros</a>
                        <a href="disponibilidad.php"><i class="glyphicon glyphicon-book"></i> Disponibilidad</a>
                    </div>
                </div>
             <!--   <div class="col-lg-1"></div>  -->
                <div class="col-lg-7 well" id="img" >         
                    <img src="imagenes/libros.jpg" width=100% height=80%>

                </div>
            </div>

         </div>

    </body>

</html>





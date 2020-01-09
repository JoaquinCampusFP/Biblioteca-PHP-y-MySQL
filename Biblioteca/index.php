
<html>
    <head>
        <title>Biblioteca</title>
        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron text-center">
                <h1 class="display-2">BIBLIOTECA</h1>
                <hr class="my-2">
            </div>
            <?php
                include("conexion.php");

                function imprimirFormulario() {
                    echo '<div class="login">';
                    echo '<h1>INICIO</h1>';
                    echo '<form action="index.php" method="post">
                    <label>Nombre:</label>
                    <input type="text" name="nombre"><br><br>
                    <label>Contraseña:</label>
                    <input type="password" name="clave"><br><br>
                    <input type="submit" name="entrar" value="LOGIN">
                    <input type="submit" name="agregar" value="REGISTRO">
                    </form>';
                
                }

                if (isset($_POST['entrar'])){
                    $nombre=$_POST['nombre'];
                    $clave=md5($_POST['clave']);

                    $consulta="SELECT * FROM usuarios WHERE nombre='$nombre' AND clave='$clave'";
                    $paquete=mysqli_query($conexion,$consulta);
                    $resultado=mysqli_fetch_array($paquete);

                    if ($resultado==[]){
                        imprimirFormulario();
                        echo '<h2 id="error"> Acceso denegado</h2>';
                    }else{
                        imprimirFormulario();
                        session_start();
                        $_SESSION['nombre']=$resultado['nombre'];
                        $_SESSION['id']=$resultado['id_usuario'];
                        if ($_SESSION['nombre']=='admin'){
                            header('Location:menu_admin.php');
                        }else{
                            header('Location:menu_usuario.php');
                        }
                    } 
                } else if (isset($_POST['agregar'])) {
                    $nombre=$_POST['nombre'];
                    $clave=md5($_POST['clave']);
                    $consulta="SELECT * FROM usuarios WHERE nombre='$nombre'";
                    $paquete=mysqli_query($conexion,$consulta);
                    $resultado=mysqli_fetch_array($paquete);

                    if (  $resultado==0){
                        $consulta="INSERT INTO usuarios(id_usuario,nombre,clave) VALUES (0,'$nombre','$clave')";
                        $paquete=MYSQLi_QUERY($conexion,$consulta);
                        if ($paquete==true){
                            imprimirFormulario(); 
                            echo 'Los datos se han guardado correctamente <br>';
                        }
                    }else{
                        imprimirFormulario();
                        echo 'Error: Nombre de usuario ya registrado';
                    }                  

                } else {
                    imprimirFormulario();
                }
                echo '</div>';

            ?> 
        </div>


    </body>

</html>
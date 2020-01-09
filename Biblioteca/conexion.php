<?php

    $host="localhost";
    $usuario="root";
    $clave="";
    $base="biblioteca";

    $conexion=MYSQLi_CONNECT($host,$usuario,$clave,$base);
    mysqli_set_charset($conexion,"utf8");

?>
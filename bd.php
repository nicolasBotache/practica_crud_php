<?php

    $servidor="localhost";
    $baseDeDatos="app";
    $usuario="root";
    $contraseina="";


    try{
          $conexion =new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contraseina);
    }catch(Exception $ex){
        echo $ex->getMessage();

    }



?>
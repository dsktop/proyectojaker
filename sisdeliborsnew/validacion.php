<?php
error_reporting(0);
$msg = "";
$validacion = True;
require 'cn/cnx.php';
   
   session_start();

   $correo = $_POST['correo'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND password = '$password';";
   $resultado = $cnx->query($sql);
   $rsUsuarios = $resultado->fetch(PDO::FETCH_ASSOC);

   if($correo === '' && $password === '') {
      $_SESSION['msgError'] = 'Todos los campos son obligatorios';
      header("location: login.php");
   }else if($rsUsuarios['correo'] == $correo && $rsUsuarios['password'] == $password) {
         $_SESSION['nombre'] = $nombre;
         header("location: index.php");
   }else {
         $_SESSION['msgError'] = 'correo o password incorrectas';
         header("location: login.php");
   }
?>
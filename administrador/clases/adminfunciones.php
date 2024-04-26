<?php

function esNulo(array $parametos){
    foreach($parametos as $parametos){
        if(strlen(trim($parametos)) < 1){

        }
    }
}

function validaContrasena($contrasena, $recontrasena){
    if(strcmp($contrasena, $recontrasena)=== 0){
        return true;
    }
    return false;
}

function login($usuario, $contrasena, $conexion){
    $sql= $conexion->prepare("SELECT id, usuario, contrasena, nombre FROM admin WHERE usuario LIKE ? AND activo= 1 LIMIT 1");
    $sql->execute([$usuario]);
    if ($row= $sql->fetch(PDO::FETCH_ASSOC)){
        if (password_verify($contrasena, $row['contrasena'])) {
            // Agregar mensajes de depuración
            echo "Contraseña ingresada: " . $contrasena . "<br>";
            echo "Contraseña almacenada: " . $row['contrasena'] . "<br>";
        
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['nombre'];
            $_SESSION['user_type'] = 'admin';
        
            header('Location: inicio.php');
            exit;
        }
        
    }
    return 'El usuario o contraseña son incorrectos.';

}

function esActivo($usuario, $conexion) {
    $sql= $conexion->prepare("SELECT activo FROM admin WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    $row= $sql->fetch(PDO::FETCH_ASSOC);
    if ($row['activo'] == 1) {
        return true;
    }
    return false;
}

function mostrarMensajes(array $errors) {
    if(count($errors) > 0 ){
        echo '<div class="alert alert-warning alert-dismissable fade show" role="alert"><ul>';
        foreach($errors as $error) {
            echo '<li>'. $error. '</li>';
        }
        echo '</ul>';
        echo '<button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

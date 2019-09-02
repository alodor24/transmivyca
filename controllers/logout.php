<?php
require_once '../models/class.usuario.php';
session_start();

$userLogout = new Usuario();

// Verifica si existe una sesion
if (isset($_SESSION['user_session'])) {
    
    $userLogout->Logout();
    header('location: /transmivyca/views');
}
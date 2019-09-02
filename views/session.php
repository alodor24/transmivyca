<?php
session_start();
require_once '../models/class.usuario.php';

$session = new Usuario();

// Si el usuario no se encuentra logeado, será redirigido a la pantalla de login
if (!$session->Loggedin()) {
    header('location: /transmivyca');    
}
<?php
require_once '../models/class.cliente.php';

$eliminar = new Cliente();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
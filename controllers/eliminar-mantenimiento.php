<?php
require_once '../models/class.mantenimiento.php';

$eliminar = new Mantenimiento();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
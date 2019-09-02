<?php
require_once '../models/class.asignar-viaje.php';

$eliminar = new AsignarViaje();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
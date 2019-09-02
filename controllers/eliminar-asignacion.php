<?php
require_once '../models/class.asignar-chuto.php';

$eliminar = new AsignarChuto();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
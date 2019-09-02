<?php
require_once '../models/class.destino.php';

$eliminar = new Destino();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
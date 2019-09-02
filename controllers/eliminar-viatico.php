<?php
require_once '../models/class.viaticos.php';

$eliminar = new Viaticos();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
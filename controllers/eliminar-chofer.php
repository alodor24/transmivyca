<?php
require_once '../models/class.chofer.php';

$eliminar = new Chofer();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
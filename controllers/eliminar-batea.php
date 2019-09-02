<?php
require_once '../models/class.batea.php';

$eliminar = new Batea();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
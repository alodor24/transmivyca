<?php
require_once '../models/class.chuto.php';

$eliminar = new Chuto();

$id = $_POST['id'];

if (isset($id)) {
    $eliminar->Eliminar($id);
}
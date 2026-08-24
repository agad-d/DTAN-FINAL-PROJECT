<?php

include '../config.php';

$id = intval($_GET['id']);

$imgsql = "SELECT image FROM room WHERE id = $id";
$imgres = mysqli_query($conn, $imgsql);
if ($imgrow = mysqli_fetch_assoc($imgres)) {
    if (!empty($imgrow['image']) && file_exists('../' . $imgrow['image'])) {
        unlink('../' . $imgrow['image']);
    }
}

$roomdeletesql = "DELETE FROM room WHERE id = $id";

$result = mysqli_query($conn, $roomdeletesql);

header("Location:room.php");

?>
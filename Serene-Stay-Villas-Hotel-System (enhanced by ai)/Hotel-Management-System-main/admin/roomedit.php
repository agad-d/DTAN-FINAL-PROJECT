<?php
session_start();
include '../config.php';

$id = intval($_GET['id']);

$sql = "SELECT * FROM room WHERE id = $id";
$re = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($re);

if (!$row) {
    header("Location: room.php");
    exit();
}

$type = $row['type'];
$bedding = $row['bedding'];
$image = $row['image'];

if (isset($_POST['editroom'])) {
    $newType = $_POST['troom'];
    $newBed = $_POST['bed'];
    $newImage = $image;

    if (isset($_FILES['roomimage']) && $_FILES['roomimage']['error'] === UPLOAD_ERR_OK) {
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $originalName = $_FILES['roomimage']['name'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (in_array($ext, $allowedExt) && $_FILES['roomimage']['size'] <= 5 * 1024 * 1024) {
            $uploadDir = '../image/uploads/rooms/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newFileName = uniqid('room_', true) . '.' . $ext;
            if (move_uploaded_file($_FILES['roomimage']['tmp_name'], $uploadDir . $newFileName)) {
                // remove old photo so uploads don't pile up
                if (!empty($image) && file_exists('../' . $image)) {
                    unlink('../' . $image);
                }
                $newImage = 'image/uploads/rooms/' . $newFileName;
            }
        }
    }

    $stmt = $conn->prepare("UPDATE room SET type = ?, bedding = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $newType, $newBed, $newImage, $id);
    $stmt->execute();

    header("Location: room.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serene Stay Villas - Admin</title>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/room.css">
    <link rel="stylesheet" href="css/editform.css">
</head>

<body>
    <div class="editformwrap">
        <div class="editformcard">
            <h2>Edit Room</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="troom">Type of Room :</label>
                <select name="troom" id="troom" class="form-control">
                    <option value="Superior Room" <?php if ($type == 'Superior Room') echo 'selected'; ?>>SUPERIOR ROOM</option>
                    <option value="Deluxe Room" <?php if ($type == 'Deluxe Room') echo 'selected'; ?>>DELUXE ROOM</option>
                    <option value="Guest House" <?php if ($type == 'Guest House') echo 'selected'; ?>>GUEST HOUSE</option>
                    <option value="Single Room" <?php if ($type == 'Single Room') echo 'selected'; ?>>SINGLE ROOM</option>
                </select>

                <label for="bed">Type of Bed :</label>
                <select name="bed" id="bed" class="form-control">
                    <option value="Single" <?php if ($bedding == 'Single') echo 'selected'; ?>>Single</option>
                    <option value="Double" <?php if ($bedding == 'Double') echo 'selected'; ?>>Double</option>
                    <option value="Triple" <?php if ($bedding == 'Triple') echo 'selected'; ?>>Triple</option>
                    <option value="Quad" <?php if ($bedding == 'Quad') echo 'selected'; ?>>Quad</option>
                    <option value="None" <?php if ($bedding == 'None') echo 'selected'; ?>>None</option>
                </select>

                <label for="roomimage">Room Photo :</label>
                <?php if (!empty($image)) { ?>
                    <img class="currentphoto" src="../<?php echo htmlspecialchars($image); ?>" alt="Current photo">
                <?php } ?>
                <input type="file" name="roomimage" id="roomimage" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
                <small>Leave blank to keep the current photo.</small>

                <div class="editformbtns">
                    <button type="submit" class="btn btn-success" name="editroom">Save Changes</button>
                    <a href="room.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

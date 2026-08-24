<?php
session_start();
include '../config.php';
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
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="formfield">
                <label for="troom">Type of Room :</label>
                <select name="troom" class="form-control" id="troom">
                    <option value selected></option>
                    <option value="Superior Room">SUPERIOR ROOM</option>
                    <option value="Deluxe Room">DELUXE ROOM</option>
                    <option value="Guest House">GUEST HOUSE</option>
                    <option value="Single Room">SINGLE ROOM</option>
                </select>
            </div>

            <div class="formfield">
                <label for="bed">Type of Bed :</label>
                <select name="bed" class="form-control" id="bed">
                    <option value selected></option>
                    <option value="Single">Single</option>
                    <option value="Double">Double</option>
                    <option value="Triple">Triple</option>
                    <option value="Quad">Quad</option>
                    <option value="Triple">None</option>
                </select>
            </div>

            <div class="formfield">
                <label for="roomimage">Room Photo :</label>
                <input type="file" name="roomimage" id="roomimage" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
            </div>

            <button type="submit" class="btn btn-success" name="addroom">Add Room</button>
        </form>

        <?php
        if (isset($_POST['addroom'])) {
            $typeofroom = $_POST['troom'];
            $typeofbed = $_POST['bed'];
            $imagePath = null;

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
                        $imagePath = 'image/uploads/rooms/' . $newFileName;
                    }
                }
            }

            $stmt = $conn->prepare("INSERT INTO room(type, bedding, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $typeofroom, $typeofbed, $imagePath);
            $result = $stmt->execute();

            if ($result) {
                header("Location: room.php");
                exit();
            }
        }
        ?>
    </div>

    <div class="room">
        <?php
        $sql = "select * from room";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
            $type = $row['type'];
            $boxClass = 'roombox';
            if ($type == "Superior Room") {
                $boxClass .= ' roomboxsuperior';
            } else if ($type == "Deluxe Room") {
                $boxClass .= ' roomboxdelux';
            } else if ($type == "Guest House") {
                $boxClass .= ' roomboguest';
            } else if ($type == "Single Room") {
                $boxClass .= ' roomboxsingle';
            }

            $photoHtml = "<i class='fa-solid fa-bed fa-4x mb-2'></i>";
            if (!empty($row['image'])) {
                $photoHtml = "<img class='roomboxphoto' src='../" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($type) . "'>";
            }

            echo "<div class='" . $boxClass . "'>
                    <div class='text-center no-boder'>
                        " . $photoHtml . "
                        <h3>" . htmlspecialchars($row['type']) . "</h3>
                        <div class='mb-1'>" . htmlspecialchars($row['bedding']) . "</div>
                        <div class='roomboxbtns'>
                            <a href='roomedit.php?id=" . $row['id'] . "'><button class='btn btn-primary'>Edit</button></a>
                            <a href='roomdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a>
                        </div>
                    </div>
                </div>";
        }
        ?>
    </div>

</body>

</html>
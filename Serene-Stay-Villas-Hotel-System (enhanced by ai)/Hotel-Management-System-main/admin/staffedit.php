<?php
session_start();
include '../config.php';

$id = intval($_GET['id']);

$sql = "SELECT * FROM staff WHERE id = $id";
$re = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($re);

if (!$row) {
    header("Location: staff.php");
    exit();
}

$name = $row['name'];
$work = $row['work'];
$image = $row['image'];

if (isset($_POST['editstaff'])) {
    $newName = $_POST['staffname'];
    $newWork = $_POST['staffwork'];
    $newImage = $image;

    if (isset($_FILES['staffimage']) && $_FILES['staffimage']['error'] === UPLOAD_ERR_OK) {
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $originalName = $_FILES['staffimage']['name'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (in_array($ext, $allowedExt) && $_FILES['staffimage']['size'] <= 5 * 1024 * 1024) {
            $uploadDir = '../image/uploads/staff/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newFileName = uniqid('staff_', true) . '.' . $ext;
            if (move_uploaded_file($_FILES['staffimage']['tmp_name'], $uploadDir . $newFileName)) {
                // remove old photo so uploads don't pile up
                if (!empty($image) && file_exists('../' . $image)) {
                    unlink('../' . $image);
                }
                $newImage = 'image/uploads/staff/' . $newFileName;
            }
        }
    }

    $stmt = $conn->prepare("UPDATE staff SET name = ?, work = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $newName, $newWork, $newImage, $id);
    $stmt->execute();

    header("Location: staff.php");
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
            <h2>Edit Staff</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="staffname">Name :</label>
                <input type="text" name="staffname" id="staffname" class="form-control" value="<?php echo htmlspecialchars($name); ?>">

                <label for="staffwork">Work :</label>
                <select name="staffwork" id="staffwork" class="form-control">
                    <option value="Manager" <?php if ($work == 'Manager') echo 'selected'; ?>>Manager</option>
                    <option value="Cook" <?php if ($work == 'Cook') echo 'selected'; ?>>Cook</option>
                    <option value="Helper" <?php if ($work == 'Helper') echo 'selected'; ?>>Helper</option>
                    <option value="cleaner" <?php if ($work == 'cleaner') echo 'selected'; ?>>cleaner</option>
                    <option value="Waiter" <?php if ($work == 'Waiter') echo 'selected'; ?>>Waiter</option>
                </select>

                <label for="staffimage">Photo :</label>
                <?php if (!empty($image)) { ?>
                    <img class="currentphoto" src="../<?php echo htmlspecialchars($image); ?>" alt="Current photo">
                <?php } ?>
                <input type="file" name="staffimage" id="staffimage" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
                <small>Leave blank to keep the current photo.</small>

                <div class="editformbtns">
                    <button type="submit" class="btn btn-success" name="editstaff">Save Changes</button>
                    <a href="staff.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

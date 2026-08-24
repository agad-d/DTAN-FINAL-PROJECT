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
    <style>
        .roombox{
            background-color: #d1d7ff;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="formfield">
                <label for="staffname">Name :</label>
                <input type="text" name="staffname" id="staffname" class="form-control">
            </div>

            <div class="formfield">
                <label for="staffwork">Work :</label>
                <select name="staffwork" id="staffwork" class="form-control">
                    <option value selected></option>
                    <option value="Manager">Manager</option>
                    <option value="Cook">Cook</option>
                    <option value="Helper">Helper</option>
                    <option value="cleaner">cleaner</option>
                    <option value="Waiter">Waiter</option>
                </select>
            </div>

            <div class="formfield">
                <label for="staffimage">Photo :</label>
                <input type="file" name="staffimage" id="staffimage" class="form-control" accept="image/png,image/jpeg,image/webp,image/gif">
            </div>

            <button type="submit" class="btn btn-success" name="addstaff">Add Room</button>
        </form>

        <?php
        if (isset($_POST['addstaff'])) {
            $staffname = $_POST['staffname'];
            $staffwork = $_POST['staffwork'];
            $imagePath = null;

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
                        $imagePath = 'image/uploads/staff/' . $newFileName;
                    }
                }
            }

            $stmt = $conn->prepare("INSERT INTO staff(name, work, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $staffname, $staffwork, $imagePath);
            $result = $stmt->execute();

            if ($result) {
                header("Location: staff.php");
                exit();
            }
        }
        ?>
    </div>


    <!-- here room add because room.php and staff.php both css is similar -->
    <div class="room">
    <?php
        $sql = "select * from staff";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
                $photoHtml = "<i class='fa fa-users fa-5x'></i>";
                if (!empty($row['image'])) {
                    $photoHtml = "<img class='roomboxphoto' src='../" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                }
                echo "<div class='roombox'>
						<div class='text-center no-boder'>
                            " . $photoHtml . "
							<h3>" . htmlspecialchars($row['name']) . "</h3>
                            <div class='mb-1'>" . htmlspecialchars($row['work']) . "</div>
                            <div class='roomboxbtns'>
                                <a href='staffedit.php?id=" . $row['id'] . "'><button class='btn btn-primary'>Edit</button></a>
                                <a href='staffdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a>
                            </div>
						</div>
                    </div>";
        }
        ?>
    </div>

</body>

</html>
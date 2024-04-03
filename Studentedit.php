<?php
include "db_conn.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $sql = "SELECT * FROM students WHERE Rollno='$id'";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
}

if (!$student) {
    header("location: studentlist.php");
}

if (isset($_POST['btnUpdate'])) {
    $Sname = $_POST['Sname'];
    $Address = $_POST['Address'];
    $Email = $_POST['Email'];

    $sql = "UPDATE students SET Sname='$Sname', Address='$Address', Email='$Email' WHERE Rollno='$id'";
    mysqli_query($conn, $sql);

    header("Location: studentlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Edit Student
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="Sname">Student Name:</label>
                                <input type="text" name="Sname" id="Sname" class="form-control" value="<?php echo $student['Sname']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Address">Address:</label>
                                <input type="text" name="Address" id="Address" class="form-control" value="<?php echo $student['Address']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email:</label>
                                <input type="email" name="Email" id="Email" class="form-control" value="<?php echo $student['Email']; ?>">
                            </div>
                            <button type="submit" name="btnUpdate" class="btn btn-primary">Update</button>
                            <a href="studentlist.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

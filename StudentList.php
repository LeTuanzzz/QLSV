
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
        color: #444;
    }
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }
    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 30px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #007bff;
        color: #fff;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    caption {
        font-size: 1.6em;
        margin: 10px 0;
        font-weight: 600;
        padding: 10px;
        text-align: left;
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    form {
        padding: 20px;
    }
    .form-row {
        margin-bottom: 15px;
    }
    input[type="text"], input[type="email"], input[type="number"] {
        width: calc(100% - 16px);
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type="submit"], input[type="reset"] {
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
    }
    input[type="reset"] {
        background-color: #6c757d;
        color: #fff;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    input[type="reset"]:hover {
        background-color: #545b62;
    }
    .form-title {
        margin-bottom: 25px;
        color: #007bff;
    }
</style>
</head>
<body>
    <?php
    include "db_conn.php";
    $sql = "select * from students";
    //Executing query
    $result = mysqli_query($conn,$sql);
    ?>

    <table align="center" border="1px" cellpadding="0" cellspacing="0">
    <caption align="center">Student List</caption>
    <tr>
        <th>Rollno</th>
        <th>Student Fullname</th>
        <th>Address</th>
        <th>Email</th>
        <th>functions</th>
    </tr>

    <?php
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {        
    ?>
    <tr>
        <td><?php echo $row['Rollno']; ?></td>
        <td><?php echo $row['Sname']; ?></td>
        <td><?php echo $row['Address']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td>
         <a href="studentedit.php?id=<?php echo $row['Rollno']; ?>">Edit</a> |
        <a href="studendelete.php?id=<?php echo $row['Rollno']; ?>">Delete</a>
        </td>

    </tr>
    <?php

        }

    ?>

    </table>
    
    
    <?php
    //Add student
    include "db_conn.php";
    if(isset($_POST['btnAdd']))
    {
        //Get data from student form
        $Rollno = $_POST['Rollno'];
        $Sname = $_POST['Sname'];
        $Address = $_POST['Address'];
        $Email = $_POST['Email'];
        if($Rollno=="" || $Sname=="" || $Address=="" || $Email=="")
        {
            echo "(*) is not empty";
        }
        else
        {
            //Retrieving data from table
            $sql = "select Rollno from students where Rollno='$Rollno'";
            //Executing query
            $result = mysqli_query($conn,$sql);
            //Testing exist data and then insert into table
            if(mysqli_num_rows($result)==0)
            {
                $sql = "INSERT INTO students VALUES ('$Rollno', '$Sname', '$Address', '$Email')";
                mysqli_query($conn,$sql);
                echo '<meta http-equiv="refresh" content="0; URL=StudentList.php"';
            }
            else
            {
                echo "Existed student in list";
            }

        }
    }

    ?>

    <form method="post" id="AddStudent">
        <table align="center" border="0" cellpadding="1" cellspacing="1">
           <caption align="center"><b>Adding Student</b></caption> 
           <tr>
                <td>Rollno</td>
                <td><input type="text" name="Rollno"/>(*)</td>
           </tr>

           <tr>
                <td>Student Name</td>
                <td><input type="text" name="Sname"/>(*)</td>
           </tr>

           <tr>
                <td>Student Address</td>
                <td><input type="text" name="Address"/>(*)</td>
           </tr>

           <tr>
                <td>Student Email</td>
                <td><input type="text" name="Email"/>(*)</td>
           </tr>

           <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Add" name="btnAdd"/>
                    <input type="reset" value="cancel" name="btnCancel"/>
                </td>
           </tr>
               <a href="studendelete.php?id=<?php echo $row['Rollno']; ?>">Delete</a>
           <tr>
                

           </tr>
        </table>
    </form>

</body>
</html>
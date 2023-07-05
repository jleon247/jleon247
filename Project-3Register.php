<!DOCTYPE html>
<html>
    <head>
        <title>Project-3 Registration</title>
           <style>
            body {
            background-image: url('/Images/goal.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-family:  font-family: Arial, sans-serif;
            }
        </style>
    </head>
    <body>
        <h1>GGC Registration</h1>
        <p>Required field are marked with an asterisk (*)</p>
        <form method = "post" action = "" enctype = "multipart/form-data" >
            <fieldset>
                <legend> Personal Information </legend>
                <table>
                    <tr>
                        <th>User Name * </th>
                        <td><input type = "text" name = "userName" required = "required"></td>
                    </tr>
                    <tr>
                        <th>Password * </th>
                        <td><input type = "password" name = "password1" required = "required"></td>
                    </tr>
                    <tr>
                        <th>Retype Password *  </th>
                        <td><input type = "password" name = "password2" required = "required"></td>
                    </tr>
                    <tr>
                        <th>Name * </th>
                        <td><input type = "text" name = "myName" placeholder="Input your name here" required = "required"></td>
                    </tr>
                    <tr>
                        <th>Email *</th>
                        <td><input type = "email" name = "email" placeholder="Input your email" required = "required"></td>
                    </tr>
                    <tr>
                        <th>Level *</th>
                        <td>
                            <select size = "1" name = "level" required = "required">
                                <option value = "Freshmen">Freshmen</option>
                                <option value = "Sophmore">Sophmore</option>
                                <option value = "Junior">Junior</option>
                                <option value = "Senior">Senior</option>
                            </select>
                        </td>
                    </tr> 
                </table>
            </fieldset>
            <br>
            <input type = "submit" name = "register" value="Register">
            <input type = "reset">
        </form>
    </body>
</html>

<?php
    include "SQLfunctions.php";
    if(isset($_POST["register"])){
        if($_POST["password1"] != $_POST["password2"]){
            die("Password does not match");
        }
        if(isset($_POST["userName"]) && !empty($_POST["userName"])){
            $conn = connectDB();
            $sql = "SHOW TABLES LIKE 'Students';";
            $result = exeSQL($conn, $sql);
            if(mysqli_num_rows($result) == 0){
                $sql = "CREATE TABLE Students 
                        ( id INT NOT NULL AUTO_INCREMENT,
                          userName VARCHAR(20) NOT NULL,
                          password VARCHAR(64) NOT NULL,
                          name VARCHAR(20) NOT NULL,
                          email VARCHAR(20) NOT NULL,
                          level VARCHAR(10) NOT NULL,
                          PRIMARY KEY(id)
                        )";
                exeSQL($conn, $sql);
            }

            $sql = "SELECT * FROM Students WHERE userName= '" . $_POST["userName"]. "';";
            $result = exeSQL($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                die("User name exists, please choose another one.");
            } else {
                $file = uploadFile("myPhoto", "jpg:png:gif");
                echo $_POST["password1"];
                $sql = "INSERT INTO Students (userName, password, name, email, level)
                       VALUES ('" . $_POST["userName"]. "', 
                               '" . sha1($_POST["password1"]). "',
                               '" . $_POST["myName"] . "',
                               '" . $_POST["email"] . "',
                               '" . $_POST["level"] . "')";
                exeSQL($conn, $sql);
                echo "<br>Click <a href='Project-3Login.html'>here</a> to login.<br>";
            }
        }
    }
?>

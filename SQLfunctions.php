 <?php
    function connectDB(){
        $servername = "sql204.infinityfree.com";
        $username = "epiz_34256384";
        $password = "fQwcMYt3dmqHZg";
        $dbname = "epiz_34256384_jleon4";
        $conn = mysqli_connect($servername, $username, $password, $dbname );
        if(!$conn){
            die("Connection to DB failed:" . mysqli_connect_error() . "<br>");
        } return $conn;
    }

    function exeSQL($conn, $sql){
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "$sql is executed successfully.";
        } else{
            echo "Error in running sql: " . $sql . " with error: " . mysqli_error($conn). ".<br>";
        } return $result;
    }

    function showResults($result){
        if(mysqli_num_rows($result) > 0){
            echo "<table border = '1'>";
                echo "<tr>";
                while($fieldInfo = mysqli_fetch_field($result)){
                    if($fieldInfo->name != "password"){
                        echo "<th>$fieldInfo->name</th>";
                    }
                }
                echo "</tr>";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                        foreach($row as $key=>$value){
                            if($key == "password")
                                continue;
                            if($key == "photo")
                                echo "<td><img src = '". $value ."' width= '100px'></td>";
                            else 
                                echo "<td>$value</td>";
                        } 
                    echo "</tr>";
                }
            echo "</table>";
        } else {
            echo "No Results was found.<br>";
        }
    }

    function disconnectDB ($conn){
        mysqli_close($conn);
    }

    function uploadFile($fname, $format){
        if($_FILES[$fname]["name"] == NULL){
            echo "No file selected<br>";
            return false;
        }

        $fileType = pathinfo($_FILES[$fname]["name"], PATHINFO_EXTENSION);
        //echo "File type: $fileType<br>";
        if(stristr($format, $fileType) == false){
            echo "Wrong file type<br>";
            return false;

        }
        define("SizeLimit", 10000000); //file size limit 10MB
        $fileSize = $_FILES[$fname]["size"];
        if($fileSize > SizeLimit){
            echo "File size is over 10MB<br>";
            return false;
        }

        $dir = "Upload";
        if(!file_exists($dir)){
            mkdir($dir);
        }

        $file = $dir . "/" . $_FILES[$fname]["name"];
        if(!move_uploaded_file($_FILES[$fname]["tmp_name"], $file)){
            return false;
        } return $file;
    }
 ?>
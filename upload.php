<?php
session_start();
if ($_SESSION['type'] !== "admin") {
  header("Location: index.php");
} else {
$connection = new mysqli("localhost", "root", "Alvaro", "tienda");
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
$sql="INSERT INTO `item` (`reference`, `name`, `value`,
`subcategory_name`, `description`, `stock`, `pic`) VALUES
(NULL, '".$_POST['name']."', '".$_POST['value']."', '".$_POST['subcategory']."',
 '".$_POST['description']."', '".$_POST['stock']."', 'images/".$_FILES['fileToUpload']['name']."');";
 var_dump($sql);
  if ($result = $connection->query($sql)) {
    echo "test";
    //header("Location: productcreator.php");
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                header("Location: productcreator.php");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

  }
}
 ?>

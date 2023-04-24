<?php
include 'connect.php';

$statusMsg = '';

// $targetFilePath = $targetDir . $fileName;
// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"])){
  if(!empty($_FILES["file"]["name"])){
    $targetDir = "./img/product/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePart = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePart,PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'png', 'jpeg');

    if(in_array($fileType, $allowTypes)){
      // up file
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePart)){
        $insert = $conn->query("INSERT INTO image VALUES('', '$fileName', '')");
        if($insert){
          $statusMsg = "Ten file" .$fileName." da tai len thanh cong";
        }else{
          $statusMsg = "Tai file loi";
        }
      }else{
        $statusMsg = " chua tai len thanh cong";
      }
    }else{
      $statusMsg="sai dinh dang";
    }
  }else{
    $statusMsg = "vui long chon file";
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
  </head>
  <body>
    <?php if(!empty($statusMsg)){?>
      <p><?php echo $statusMsg ?></p>
    <?php } ?>

    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <label for="image">Image : </label>
      <input type="file" name="file" accept=".jpg, .jpeg, .png" value=""> <br> <br>
      <button type = "submit" name = "submit">Submit</button>
    </form>
    <br>
    <a href="data.php">Data</a>
  </body>
</html>


<!-- require 'connect.php';
if(isset($_POST["submit"])){
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Hình ảnh không tồn tại'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Phần mở rộng về hình ảnh không hợp lệ');
      </script>
      ";
    }
    else if($fileSize > 8000000){
      echo
      "
      <script>
        alert('Kích thước hình ảnh quá lớn');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/'.$newImageName);
      // move_uploaded_file($_FILES[$tmpName]['tmp_name'], $uploads_dir.$name);

      $query = "INSERT INTO image VALUES('', '$newImageName', '')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Them thanh cong');
      </script>
      ";
    }
  }
} -->
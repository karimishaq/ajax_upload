<?php
 
foreach ($_FILES["images"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $nama = $_FILES["images"]["name"][$key];
    move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $nama) or die("gagal");
  }
}
 
echo "<h2>Berhasil meng-upload file</h2>";
?>
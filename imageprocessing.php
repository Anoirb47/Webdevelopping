<?php	

$target_file =$target_dir. $newfilename;    //. basename($_FILES["img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["img"]["tmp_name"]);
  if($check !== false) {
   // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $errortype="danger";
    $error="خطاء في تحميل الصورة حاول مجددا.";
    $uploadOk = 0;
  }


// Check if file already exists
/*if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}*/

// Check file size
if ($_FILES["img"]["size"] > 500000) {
   $errortype="danger";
    $error="الصورة كبيرة جدا إختر أخرى.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
  $errortype="danger";
    $error="غير مقبول هذا النوع من الصور إختر أخرى.";
  $uploadOk = 0;
}


 


?>    
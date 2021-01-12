<?php include 'inc/header.php'; ?>

<?php 

$errortype="info";
    $error="";
// Check if image file is a actual image or fake image
if(isset($_POST["sub"])) {
	
	//`id`  `name`  `date_born` `place_born`  `date_inscription` `personalimg` , `sora`  `matn`
	$name     = $_POST['name'];	
    
    $date_born = $_POST['date_born'];
	
	$place_born = $_POST['place_born'];
	
	//$date_born    = $_POST['date_born'];
	$date_inscription = $_POST['date_inscription'];
	
	
	
	
    if(empty($name) || empty($date_born) || empty($place_born) || 
	empty($date_inscription) ||  ! is_uploaded_file($_FILES["img"]["tmp_name"])  ){	  
        $error=" هناك حقل فارغ الرجاء إكمال إدخال البيانات.";
		 $errortype="danger";       
	              
				   dtc($error);      
    }else{
        	$temp = explode(".", basename($_FILES["img"]["name"]));
            $newfilename =  crc32($name) . '.' . end($temp);
            $personalimg= $newfilename;
			
			include 'imageprocessing.php';		 
			
			if($uploadOk != 0){
			 move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
			$stmt = $conn->prepare("INSERT INTO student (id, name,  date_born, place_born, date_inscription, personalimg) VALUES 
			(NULL,?, ?,?,?,?)");
            $stmt->bind_param("sssss",$name,$date_born, $place_born, $date_inscription, $personalimg);
            
			if ($stmt -> execute()) {
              	  
	            $id = $stmt->insert_id;  dtc( $id);
				$_SESSION['id']=$id;
                deltypedata();
				header('Location: account.php');
               
               } else {
				   $error="لم تتم عملية التسجيل أعد المحاولة.";
				   $errortype="danger";       
	            
				   dtc("Error: " .$conn->error);
                
            }}
                           
    }

}else{

	
    $error="تأكد من كتابة معلومتك الشخصية بشكل صحيح.";	  
	$errortype="info";
  
        
}
?>
<!------ <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 Include the above in your HEAD tag 

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">---------->


  <style>
  
	
	 	
  </style>
<div class="container" style="padding-top: 20px;" > 
<?=alertshow($error,$errortype);?>
                <div class="row ">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
                        <div class="panel panel-default">
                                <div class="panel-heading" dir="rtl">
                                                <h3 class="panel-title">إنشاء سجل جديد  </h3>
                                                        </div>
                                                        <div class="panel-body">
                                                        <form method="POST" dir="rtl" role="form"  enctype="multipart/form-data">
															
                                                        <div class="form-group">
														التسمية:
                                                                <input type="text" name="name"  class="form-control " placeholder="الإسم الكامل">
                                                        </div>
																							
														<div class="form-group">
														تاريخ الميلاد:
                                                                <input type="date" name="date_born"  class="form-control "> 
                                                        </div>
														
														
														<div class="form-group">
														مكان الميلاد:
                                                                <input type="text" name="place_born"  class="form-control " placeholder="المدينة">
                                                        </div>
                                                       
														<div class="form-group">
														تاريخ الإنتساب للمدرسة:
                                                                <input type="date" name="date_inscription"  class="form-control " >
                                                        </div>
														<div class="form-group">
														إختر الصورة الشخصية:
                                                                <input type="file" name="img"   class="form-control ">
                                                        </div>

                                                    <input name="sub" type="submit" value="التسجيل" class="form-control btn btn-info btn-block">

                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>
            

</div>

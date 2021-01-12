<?php include 'inc/header.php'; ?>

	

 
      <!-- left column -->
      <!--div class="col-md-3">
        <div class="text-center">
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control">
        </div>
      </div-->
      
      <!-- edit form column -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
 <h1 >تعديل الملف الشخصي</h1> <a  href='index.php' role="button" class="  btn-success  pull-left">  العودة إلى الرئيسية  </a>
  
<hr>      
<?php
$errortype="info";
    $error="";
	//
	$id=$_SESSION['id'];
$sqlgetstudent = "SELECT * FROM `student` WHERE `id`=$id";
$getstudent     = $conn->query($sqlgetstudent);
$row = $getstudent->fetch_assoc() ;
	$name     = $row['name'];	
    
    $date_born = $row['date_born'];
	
	$place_born = $row['place_born'];
		
	$date_inscription = $row['date_inscription'];
    $personalimg = $row['personalimg']; 
  //$sora = $row['sora']; 
  
if(isset($_GET['DS'])){
    $sora = $_GET['DS'];
    $sqlDelete = "DELETE FROM `sowar` WHERE `sora` = '$sora' AND `s_id`='$id'";
   
	if($conn->query($sqlDelete)){deltypedata(); header('Location: account.php');}
   
}
if(isset($_GET['DM'])){
    $matn = $_GET['DM'];
    $sqlDelete = "DELETE FROM `matn` WHERE `matn` = '$matn' AND `s_id`='$id'";
   
	if($conn->query($sqlDelete)){
	deltypedata(); header('Location: account.php');
	}
   
}


if(isset($_POST['postmatnname'])){
	$newmatnname = $_POST['newmatnname'];
	        $stmt = $conn->prepare("INSERT INTO matnname ( matn) VALUES (?)");
            $stmt->bind_param("s",$newmatnname);            
			if($stmt->execute()){deltypedata();} 

}
if(isset($_POST['addmatn'])){
	$matn_select = $_POST['matn_select'];
	        $stmt = $conn->prepare("INSERT INTO matn (s_id, matn) VALUES (?,?)");
            $stmt->bind_param("is",$id,	$matn_select);            
			if($stmt->execute()){deltypedata();} 

}
if(isset($_POST['addsora'])){
	$sora_select = $_POST['sora_select'];
	        $stmt = $conn->prepare("INSERT INTO sowar (s_id, sora) VALUES (?,?)");
            $stmt->bind_param("is",$id,	$sora_select);            
			if($stmt->execute()){deltypedata();} 

}

if(isset($_POST['PIU'])){
     $name     = $_POST['name'];	
    
    $date_born = $_POST['date_born'];
	
	$place_born = $_POST['place_born'];
	
	$date_inscription = $_POST['date_inscription'];
	
    if(empty($name) || empty($date_born) || empty($place_born) || empty($date_inscription) ){
		 $error=" الرجاء إتمام إدخال البيانات الشخصية.";
		    $errortype="danger";       	        	   
			alertDismissShow($error,$errortype);
	
	}else{
    $query = "UPDATE student 
                    SET name = ?, date_born = ?, place_born = ? , date_inscription = ? 
                    WHERE id = ?";
 
        // prepare query for excecution
        $stmt = $conn->prepare($query);
 
       
        // bind the parameters
        $stmt->bind_param("ssssi", $name,$date_born, $place_born, $date_inscription,$id);
     
        // Execute the query
        if($stmt->execute()){
                   
           	 $error=" تم تحديث المعلومات الشخصية.";
		    $errortype="success";       
	        	   
			alertDismissShow($error,$errortype);
		echo '<script>
                 if ( window.history.replaceState ) {
                 window.history.replaceState( null, null, window.location.href );
                   }
                 </script>';
        }else{
			 $error=" غير قادر على تحديث. حاول مجددا.";
		    $errortype="danger";       
	        	   
			alertDismissShow($error,$errortype);
        }
	}	
}

?>
	 
        <h3>المعلومات الشخصية</h3> 
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 pull-left">
               <img src="<?= $target_dir.$personalimg ?>" width="250" height="300" alt="">  
         </div>
        
		
		 
		 
		 <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 pull-right">
		 <hr>
        <form method="POST" class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label pull-right" >الإسم:</label>
            <div class="col-lg-8">
                <input name="name" class="form-control" type="text" value="<?= $name; ?>">
            </div>
          </div>
          
		  <div class="form-group">
            <label class="col-lg-3 control-label  pull-right">تاريخ الميلاد:</label>
            <div class="col-lg-8">
                <input class="form-control" name="date_born" type="date" value="<?= $date_born; ?>" >
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-lg-3 control-label  pull-right">مكان الميلاد:</label>
            <div class="col-lg-8">
                <input class="form-control" name="place_born" type="text" value="<?= $place_born; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label  pull-right" >تاريخ الإنتساب:</label>
            <div class="col-lg-8">
                <input class="form-control" name="date_inscription" type="date" value="<?= $date_inscription; ?>">
            </div>
          </div>
		  <hr>
          <div class="form-group col-lg-8">
                      
                <input name="PIU" type="submit" class="btn btn-primary   pull-left" value="حفظ التغييرات">    
               	
              <input type="reset" class="btn btn-default pull-right " value="الرجوع">
            
          </div>
        </form>
		</div>
      </div>
 
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
<h3 >حفظ السور</h3>
<hr>                                               
 </div>  
         <div class=" col-sm-12 col-md-12 col-lg-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
		 <form method="POST" dir="rtl" role="form"  > 
     
               <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                       <div class="form-group">
                             <select name="sora_select" class="form-control">
                               <?php foreach($kolsowar as $element) {
                               echo "<option value='$element'>$element</option>" ;
                               }?>
                              </select>
                       </div>
              </div>
		      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 ">
		      <input name="addsora" type="submit" value="إضافة سورة جديدة" class="form-control btn btn-success btn-block">
              </div>  
       </form>			  
       </div>
	
<?php 
$sqlgetsowar = "SELECT sora FROM `sowar` WHERE `s_id`=$id";
$getsowar     = $conn->query($sqlgetsowar);
//$row = $getstudent->fetch_assoc() ;
?>	
<style>
.center-align [class*='col-'] {
  display: inline-block;
  vertical-align: top;
  letter-spacing: 0;
  font-size: 14px;
  float: right;
}
</style>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center-align" >

     <?php while ($row = $getsowar->fetch_assoc()) { ?>
      <div class=" col-xs-4 col-sm-3 col-md-3 col-lg-2" >
	  
         <div class="alert alert-success alert-dismissible">
           <a href="?DS=<?= $row['sora'] ?>" class="close" >&times;</a>
           <strong><?= $row['sora'] ?></strong> 
         </div>   
	       </div>

    <?php } ?>		
</div>	

<?php 
$sqlgetmatnname = "SELECT matn FROM `matnname` ";
$getmatnnames     = $conn->query($sqlgetmatnname);
//$row = $getstudent->fetch_assoc() ;
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
<h3 >حفظ المتون</h3>
<hr>
</div>

   
    <div class=" col-sm-12 col-md-12 col-lg-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
		   	<div class="row">
		    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		    <a href="#addskill" role="button" data-toggle="modal" class="form-control btn btn-info btn-block">تعريف كتاب جديد</a>
		   <hr>
		   </div>
     </div>
		 <form method="POST" dir="rtl" role="form"  > 

               <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                       <div class="form-group">
                             <select name="matn_select" class="form-control">
                               <?php while ($row = $getmatnnames->fetch_assoc()){
								   $matnname=$row['matn'];
                               echo "<option value='$matnname'>$matnname</option>" ;
                               }?>
                              </select>
                       </div>
              </div>
		      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 ">
		      <input name="addmatn" type="submit" value="إظافة كتاب" class="form-control btn btn-success btn-block">
              </div>  
       </form>			  
       </div>
	   
<?php 
$sqlgetmatn = "SELECT matn FROM `matn` WHERE `s_id`=$id";
$getmatn     = $conn->query($sqlgetmatn);
//$row = $getstudent->fetch_assoc() ;
?>	

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center-align" >

     <?php while ($row = $getmatn->fetch_assoc()) { ?>
      <div class=" col-xs-6 col-sm-4 col-md-4 col-lg-3" >
	  
         <div class="alert alert-warning alert-dismissible">
           <a href="?DM=<?= $row['matn'] ?>" class="close" >&times;</a>
           <strong><?= $row['matn'] ?></strong> 
         </div>   
	       </div>

    <?php } ?>		
</div>	

<div id="addskill" class="modal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">تعريف كتاب جديد</h4>
                    </div>
                    <div class="modal-body">
                        <div class="containter">
                            <div class="row">
                                <form class="form-horizontal" name="commentform" method="post" dir="rtl" >
                                  <div class="form-group">
                                            <label for="InputName" class="col-lg-4 control-label pull-right"> التسمية</label>
                                            <div class="col-lg-8 ">
                                                <input type="text" class="form-control" name="newmatnname"   required>
                                            </div>
                                  </div>
			                     <input type="submit" name="postmatnname" value="إضافة" class="form-control btn btn-info btn-block">
                                </form>
                            
                            </div>

                        </div>
                    </div><!-- End of Modal body -->
                </div><!-- End of Modal content -->
            </div><!-- End of Modal dialog -->
        </div><!-- End of Modal -->                        
<?php //include 'job_process.php'; ?>





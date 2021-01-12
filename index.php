<?php include 'inc/header.php'; ?>




<style type="text/css">
  .cardshr {  
  background-color:  #ECE9E8 ;
   padding: 10px 10px 0px 10px;  
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
   transition: 0.3s;  
   border-radius: 5px;
 }
.cardshr:hover {
   cursor: pointer;
   box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);
 }

 .form-control {
  padding-left: 30px;
}

.form-control + .glyphicon {
  position: absolute;
  left: 0;
  padding: 8px 27px;
}


</style>
<?php
$sqlgetstudent = "SELECT * FROM `student`";
$getstudent     = $conn->query($sqlgetstudent);
$studentcount= mysqli_num_rows($getstudent);

if(isset($_GET['US'])){
	$_SESSION['id'] = $_GET['US'];
	 header('Location: account.php');
}
if(isset($_GET['DU'])){
	
    $dd_id = $_GET['DU'];
    $sqlsDelete = "DELETE FROM `sowar` WHERE  `s_id`='$dd_id'";
    $sqlmDelete = "DELETE FROM `matn` WHERE `s_id`='$dd_id'";
	$sqluDelete = "DELETE FROM `student` WHERE `id`='$dd_id'";
	
	if($conn->query($sqlsDelete) && $conn->query($sqlmDelete)  && $conn->query($sqluDelete) ){
		deltypedata(); header('Location: index.php');
		}
 
}
if(isset($_POST['search'])){

 $selected_sora=$_POST['selected_sora'];
 
    if(strcmp($selected_sora,"الكل")!=0)  {
     $sql_search_student = "SELECT * FROM `student`, `sowar` WHERE `sowar`.s_id=`student`.id AND 
	 `sowar`.sora='".$selected_sora."'";
	 dtc($sql_search_student);
     $getstudent     = $conn->query($sql_search_student);
     $studentcount= mysqli_num_rows($getstudent);
    }

}


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="z-index:2; position:fixed; padding-top: 20px; background-color: #6C6A6A ;">

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <div class="cardshr">
         <div class="row">
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                <input class="form-control" name="email" type="text" value="<?= " عدد السجلات:".$studentcount ?>" readonly>
                </div> 
           </div>  
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                   <a href="registrar.php" role="button" class="form-control btn btn-success btn-block">إضافة سجل جديد</a>
                  </div> 
           </div> 
          </div>  
     </div>
</div>	


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
  <div class="cardshr">
                    <form method="POST" role="form">
                          <div class="row">
                           
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"  style="float: left !important;">
                              <div class="form-group">
                                
                                  
                                 <span class="ion-ios-arrow-down"></span>
                                    <select name="selected_sora"  class="form-control input-md">
                                    <option   value="الكل">الكل</option> 
                                     <?php foreach($kolsowar as $element) {
                                     echo "<option value='$element'>$element</option>" ;
                                     }?>
                                    </select>
                
             
                              </div>
                            </div>
                           
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"  >
                              <div class="form-group">                            
                                  <button name="search" type="submit" class="form-control btn btn-primary">فرز حسب</button>          
                              </div>
                            </div>
                          </div>
                        </form>
     </div>       
</div>			
 

</div>
 
 
<style>



.clrfx {
	clear:both
}

.thumbnail {
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
   transition: 0.3s;
   min-width: 40%;  
   border-radius: 5px;
 }

 .thumbnail-description {
   width: 95%; 
   white-space:nowrap;
   overflow:hidden;
   text-overflow:ellipsis;	
 }
 .cardtitle {
   width: 90%; 
   white-space:nowrap;
   overflow:hidden;
   text-overflow:none;  
 }
 .thumbnail:hover {

   cursor: pointer;
   box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);
 }

.avatar {
  vertical-align: middle;
  width: 72px;
  height: 72px;
  border-radius: 50%;
}

.center-align {
  letter-spacing: -4px;
  text-align: center;
  font-size: 0;
}

.center-align [class*='col-'] {
  display: inline-block;
  vertical-align: top;
  letter-spacing: 0;
  font-size: 14px;
  float: none;
}
</style>





<style>
main-box.no-header {
    padding-top: 20px;
}
.main-box {
    background: #FFFFFF;
    -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
    box-shadow: 1px 1px 2px 0 #CCCCCC;
    margin-bottom: 16px;
    -webikt-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.table a.table-link.danger {
    color: #e74c3c;
}
.label {
    border-radius: 3px;
    font-size: 0.875em;
    font-weight: 600;
}
.user-list tbody td .user-subhead {
    font-size: 0.875em;
    font-style: italic;
}
.user-list tbody td .user-link {
    display: block;
    font-size: 1.25em;
    padding-top: 3px;
    margin-left: 60px;
}
a {
    color: #3498db;
    outline: none!important;
}
.user-list tbody td img {
    position: relative;
    max-width: 50px;
    float: right;
    margin-right: 15px;
}

.table thead tr th {
    text-transform: uppercase;
    font-size: 0.875em;
}
.table thead tr th {
    border-bottom: 2px solid #e7ebee;
}
.table tbody tr td:first-child {
    font-size: 1.125em;
    font-weight: 300;
}
.table tbody tr td {
    font-size: 0.875em;
    vertical-align: middle;
    border-top: 1px solid #e7ebee;
    padding: 12px 8px;
}
span {
	font-size: 1.5em;
}

</style>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" z-index:1; position:relative; padding-top: 120px;">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                <th class="text-right" ><span>الإسم الكامل</span></th>
                                <th class="text-right"><span>تاريخ الميلاد</span></th>
                                <th class="text-right"><span>مكان الميلاد</span></th>
                                <th class="text-right"><span>تاريخ الإنتساب</span></th>
                                <th class="text-right"><span>العملية</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $getstudent->fetch_assoc()) {                                                                         
                                    ?>
                                <tr>                
                                    <td>                                
                                   <img src="<?= $target_dir.$row['personalimg'] ?>" alt="">
                    
                                    <a href="#" class="user-link"><?= $row['name'] ?></a>
                                                                                                                                   
                                    </td>
                                                      
                                    <td >
                                        <span class="label label-default" style="font-size: 1.2em;"><?= $row['date_born'] ?></span>
                                    </td>
                                    <td>
                                        <a href="#" style="font-size: 1.6em;"><?= $row['place_born'] ?></a>
                                    </td>
									 <td >
                                        <span class="label label-default" style="font-size: 1.2em;"><?= $row['date_inscription'] ?></span>
                                    </td>
									
                                    <td>
                                    <a href="?US=<?= $row['id'] ?>" role="button" class="btn btn-primary" >تعديل</a>
                                    <a href="?DU=<?= $row['id'] ?>" onclick="return confirm('هل انت متأكد من حذف هذ السجل؟')" class="btn btn-danger" >حذف</a>
 
									</td>
                                </tr>
                                 <!-- Modal -->
								 

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      




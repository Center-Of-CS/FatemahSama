<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?php 
            $title = "Create project"; 
            include_once("title.php");
        ?>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <?php  
    include("../lib/crud.php");
    $db = new CRUD();
    $room_no = $type= $price= $details="";
    $imageErr = $room_noErr = $typeErr= $priceErr= $detailsErr="";   										
    if(isset($_POST['submit'])){
        if(empty($_POST['room_no'])){
            $room_noErr = "room_no can not be empty";	
        }else{
            $room_no = cleanData($_POST['room_no']);
        }
        if(empty($_POST['type'])){
            $typeErr = "type can not be empty";	
        }else{
            $type = cleanData($_POST['type']);
        }
        if(empty($_POST['price'])){
            $priceErr = "price can not be empty";	
        }else{
            $price = cleanData($_POST['price']);
        }
        if(empty($_POST['details'])){
            $usdetailsErr = "detail can not be empty";	
        }else{
            $details = cleanData($_POST['details']);
        }
        // file name
        $photoName = $_FILES["image"]["name"];
        // directory
        $file_path = "images/";
        // source
        $source = $_FILES["image"]["tmp_name"];
        $allowed_extension = array("png","jpg","JPG","PNG","jpeg");
        $extension = strtolower(PATHINFO($photoName ,PATHINFO_EXTENSION));
        if(!in_array($extension, $allowed_extension)){
            $fileErr = "Unfortunatly the type file is not allowed!";     
        }
        else{
            $fulldate = date("Y_m_d h_i_s");
            $photoName = "pic _ ".$fulldate.".".$extension;
            move_uploaded_file($source,$file_path.$photoName);
        }
        if(empty($imageErr) && empty($room_noErr) && empty($typeErr) && empty($priceErr) && empty($detailsErr)){
            $insert = $db->insert("rooms","`room_no`, `type`, `price`, `details`,image"," '$room_no','$type','$price','$details','$photoName'");
            header("location:roomsetting.php?save=1");  
        }
    }
    function cleanData($data){
        $data = trim($data);
        $data = htmlSpecialChars($data);
        $data = stripslashes($data);
        return $data;
    }
?>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <?php include 'include/header.php'?>
    <!-- Main Menu area End-->
	<!-- Breadcomb area Start-->
	<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Add  Rooms</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcomb area End-->
    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        <div class="basic-tb-hd">
                            <h2>Add New Room</h2>
                        </div>
                        <form action=" <?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="">Number</i>
                                        </div>
                                        <div class="nk-int-st">
                                            <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $room_noErr?></label>
                                            <input  type="number" class="form-control" name="room_no" value="<?php echo $room_no;?>" id="room_no"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="">Type</i>
                                        </div>
                                        <div class="nk-int-st">
                                            <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $typeErr?></label>
                                            <input placeholder="" type="text" class="form-control" name="type" id="type"  value="<?php echo $type?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="">Price</i>
                                        </div>
                                        <div class="nk-int-st">
                                            <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $priceErr?></label>
                                            <input  type="number" class="form-control" name="price" id="price" value="<?php echo $price?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i >Details</i>
                                        </div>
                                        <div class="nk-int-st">
                                            <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $detailsErr?></label>
                                            <textarea  class="form-control" name="details" id="details" ><?php echo $details?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="">Image</i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="file" class="form-control" name="image" id="image"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                    <div class="form-example-int">
                                        <button class="btn btn-success notika-btn-success" type="submit" name="submit" value="Submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Element area End-->
    <?php include 'include/footer.php'?>
  
    </body>
    
    </html>
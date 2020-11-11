<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php 
        $title = "Report project"; 
        include_once("title.php");
    ?>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php  
    include("../lib/crud.php");
    $db = new CRUD();
    $rooms = "";
    // <a href='list_of_users.php?deleteID=$id&url=$photo'>Delete</a>
    // <a href='update_user.php?updateID=$id'>Update</a>
    $row = $db->select("rooms","*","");
    foreach ($row as $re) {
      $id = $re['room_id'];
      $room_no = $re['room_no'];
      $type = $re['type'];
      $detail = $re['details'];
      $price = $re['price'];
      $img= $re['image'];
      $rooms .="<tr>
        <td>$id</td>
        <td>$room_no</td>
        <td>$type</td>
        <td>$price</td>
        <td>$detail</td>
        <td class='datatable-ct'>
          <a href='roomupdate.php?updateID=$id' style='font-size:25px; color:#00c292; font-weight:bold;'><i class='fa fa-edit' ></i>  </a> <i style='font-size:25px; color:#000; font-weight:bold;'>/<i>
          <a href='roomsetting.php?deletId=$id&url=$img' style='font-size:25px; color:red; font-weight:bold;'><i class='fa fa-trash-o'></i></a>
        </td>
      </tr>";        
    }
    if(isset($_GET['deletId'])){
      $id_delet = (int) $_GET['deletId'];
      $url = $_GET['url'];
      $de = $db->delete("rooms","room_id='$id_delet' and image='$url'");
      if($de){
        unlink("images/$url");
        header("location:s_page.php?deleted=1");  
      } 
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
										<i class="notika-icon notika-windows"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Rooms Data Table</h2>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Room_no</th>
                                      <th>Type</th>
                                      <th>Price</th>
                                      <th>Detail</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php echo $rooms;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->
    <!-- Start Footer area-->
    <?php include 'include/footer.php'?>
</body>

</html>
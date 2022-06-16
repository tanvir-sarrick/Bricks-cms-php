<?php include "inc/header.php";?><?php
	$id = $_SESSION['id'];
	$oldpassword ="";
	$err_oldpassword="";
	$newpassword ="";
	$err_newpassword="";
	$repassword="";
	$err_repassword="";
	$hasError = false;

  if( isset( $_POST['Updatepassword']) ){
	if(empty($_POST["oldpassword"])){
	  $err_oldpassword="*Old Password is required";
	  $hasError = true;
	}
	else{
	  $oldpassword=$_POST["oldpassword"];
	}
	if(empty($_POST["newpassword"])){
	  $err_newpassword="*New Password required";
	  $hasError = true;
	}
	else{
	  $newpassword=$_POST["newpassword"];
	}
	if(empty($_POST["repassword"])){
	  $err_repassword="*Re-type Password is required";
	  $hasError = true;
	}
	else{
	  $repassword= $_POST["repassword"];
	}
	
	if(!$hasError){
	$oldpassword= sha1($_POST["oldpassword"]);
	$newpassword= $_POST["newpassword"];
	$repassword= $_POST["repassword"];

	$sql = "SELECT password FROM users WHERE id='$id'";
	//echo $sql;
	$result = mysqli_query($db, $sql);
	
	while ( $row = mysqli_fetch_assoc($result)){
		$pass = $row['password'];
		
		if( $pass == $oldpassword){
			if( $newpassword == $repassword){
			  $hassedPass = sha1($newpassword);
			  $sqlUpdate = "UPDATE users SET password='$hassedPass' WHERE id='$id'";
			  $update= mysqli_query($db, $sqlUpdate);
			  if($update){
				header("location:editProfile.php");
				//echo "successfully";
			  }
			}
			else{
			  $err_repassword="*Confram Password do not match";
			  //echo ' <div class="alert alert-warning">Password do not match</div>';
			}
		}
		else{
			$err_oldpassword="*Old Password do not match";
		  //echo ' <div class="alert alert-warning">Old Password do not match</div>';
		}
	}
	}
	
  }
?>
<div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Manage Update Profile</h4>
          <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
      </div>

      <div class="br-pagebody">
	  		<div class="container-fluid">
                    <div class="row">
                      <div class="col-lg-12">
                         <div class="row">
						    <div class="col-3"></div>
							<div class="col-6">
								<div class="card bd-0 shadow-base">
									<form action="" method="post">
										<h2 class="text-center">Change Password</h2><br>
										<div class="form-group">
											<label for="">Old Password</label>
											<input type="password" name="oldpassword" placeholder="Old Password">
											<span class="tx-danger"><?php echo $err_oldpassword; ?></span>
										</div>
										<div class="form-group">
											<label for="">New Password</label>
											<input type="password" name="newpassword" placeholder="New Password">
											<span class="tx-danger"><?php echo $err_newpassword; ?></span>
										</div>
										<div class="form-group">
											<label for="">Confirm New Password</label>
											<input type="password" name="repassword" placeholder="Confirm New Password">
											<span class="tx-danger"><?php echo $err_repassword; ?></span>
										</div>		
										
										<div class="form-group">
											<input type="submit" name="Updatepassword" value="Change Password" class="btn btn-teal btn-block bg-b-10">
										</div>
										
									</form>
								</div>
							</div>
						 </div>
							
            
                   
                  
				    <!-- Body content End -->
					</div><!-- br-pagebody -->
					<?php include"inc/footer.php";?>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <?php include "inc/script.php";?>

      
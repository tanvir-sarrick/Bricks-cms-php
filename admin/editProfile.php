<?php include "inc/header.php";?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Manage Update Profile</h4>
          <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
      </div>

      <div class="br-pagebody">
        <!-- Body content Start -->
        <?php 
                
                $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';

                if( $do == 'Manage' ){
                  ?>
                    
                          
                    <?php 
                      $sessionId = $_SESSION['id'];
                      $sql = "SELECT * FROM users WHERE id = '$sessionId' ";
                      $allUnits = mysqli_query($db, $sql);
                     // $rowcount = mysqli_num_rows($allUnits);
                      //echo $sessionId;
                      while ( $row = mysqli_fetch_assoc($allUnits))
                          {
                              $id     = $row['id'];
                              $name     = $row['name'];
                              $email    = $row['email'];
                              $image    = $row['image'];
                              $phone    = $row['phone'];
                              $address  = $row['address'];
                              $role     = $row['role'];
                              $status   = $row['status'];
                              ?>
                                <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="card bd-0 shadow-base">
                                        <form action="editProfile.php?do=Changeimage" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                              <div class="col-lg-12 align-center">
                                                  <div class="form-group">
                                                      <?php 
                                                          if( !empty( $image )){
                                                            ?>
                                                            <img src="assets/img/users/<?php echo $image; ?>" wdith=500 height=500 class="profile-avater">
                                                            <?php
                                                          }
                                                          else {
                                                            ?>
                                                            <img src="assets/img/users/emptyProfile.jpg" class="profile-avater">
                                                            <?php
                                                          }
                                                      ?>
                                                  </div> 
                                                  <div class="form-group">
                                                  
                                                      <input type="file" name="image" value="Upload File">
                                                      <span class="tx-danger">
                                                          <?php 
                                                            if(isset($_SESSION['errpic'])){
                                                              echo  $_SESSION['errpic'];
                                                            }
                                                          ?>
                                                      </span>
                                                      <input type="hidden" name="userId" value="<?php echo $id; ?>">
                                                      <input type="submit" name="updateImage" value="Change Profile" class="btn btn-teal btn-block bg-b-10">
                                                </div>
                                              </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="card bd-0 shadow-base">
                                        <form action="editProfile.php?do=Changeprofile" method="POST" >
                                            <div class="row">
                                              <div class="col-lg-12 profile">
                                                  <div class="form-group">
                                                      <h5 for="">Email : <?php echo $email; ?></h5>
                                                  </div> 
                                                  <div class="form-group">
                                                      <h5 for="">Address : <?php 
                                                        if( !empty( $address )){
                                                          echo $address;}
                                                        else{ echo 'N/A';} ?></h5>
                                                  </div> 
                                                  <div class="form-group">
                                                      <h5 for="">Account Name : <?php echo $name; ?></h5>
                                                  </div> 
                                                  <div class="form-group">
                                                      <h5 for="">Phone Number : <?php 
                                                    if( !empty( $phone )){
                                                      echo $phone;}
                                                    else{ echo 'N/A';} ?></h5>
                                                  </div> 
                                                  <div class="form-group">
                                                      <h5 class="" for="">Account Status : <?php 
                                                        if($status ==1 ){
                                                          echo '<span class="badge badge-success">Active</span>';}
                                                      ?> </h5>
                                                  </div> 
                                                  <div class="form-group btn-profileba d-flex">
                                                      
                                                      <div class="col-lg-6 btn-profilebar-left">
                                                      <input type="hidden" name="userId" value="<?php echo $id; ?>">
                                                          <a href="editProfile.php?do=Changeprofile"><button type="submit" class="btn btn-teal btn-block bg-b-10">Change Profile</button></a>
                                                      </div>
                                                      <div class="col-lg-6 btn-profilebar-right">
                                                      <input type="hidden" name="userId" value="<?php echo $id; ?>">
                                                      <a href="changePassword.php" class="btn btn-info btn-block bg-b-10">Change Pasword</a>
                                                          <!-- <input type="submit" name="updateImage" value="Change Password" class="btn btn-info btn-block bg-b-10"> -->
                                                      </div>
                                                </div>
                                              </div>
                                            </div>
                                         </form>
                                      </div>    
                                    </div>
                                  </div>
                                </div>

                            <?php
                          }
                               
                    }
                    elseif( $do == 'Changeimage'){
                    
                      if( isset( $_POST['updateImage'])){
                        $_SESSION['errpic'] ="";
                        $userId = $_SESSION['id'];
                        $image= $_FILES['image']["name"];
                        $image_tmp= $_FILES['image']["tmp_name"];
                        if( !empty( $image )){
                          // Old image Delete
                            $query = "SELECT * FROM users WHERE id = '$userId' ";
                            $userData = mysqli_query($db, $query); 
                            while ( $row = mysqli_fetch_assoc($userData))
                            {
                                $oldimage     = $row['image'];
                                if( !empty( $oldimage )){
                                  unlink( "assets/img/users/" . $oldimage );
                                }
                            }
                          
                          $image_name =rand(1,9999999) . '-' . $image;
                          move_uploaded_file($image_tmp, "assets/img/users/" . $image_name );
                          $sql = " UPDATE users SET image='$image_name' WHERE id = '$userId' ";
                          $updateData = mysqli_query($db, $sql);
                            if( $updateData ){
                            header("location: editProfile.php?do=Manage");
                            }
                            else{
                            die("MySQL Error. " . mysqli_error($db));
                            }
                          }

                          elseif( empty( $image )){
                            
                           $_SESSION['errpic'] = "* Picture required";
                           header("location: editProfile.php?do=Manage");
                          }
                       }
                      }
                     

                elseif( $do == 'Changeprofile'){
                    if( isset( $_SESSION['id'] ) ){
                      $sessionId = $_SESSION['id'];
                      $sql = "SELECT * FROM users WHERE id = '$sessionId' ";
                      $editUnit = mysqli_query($db, $sql);
                      while ( $row = mysqli_fetch_assoc($editUnit))
                      {
                          $id     = $row['id'];
                          $name   = $row['name'];
                          $email   = $row['email'];
                          $phone   = $row['phone'];
                          $address   = $row['address'];
                          //$status  = $row['status'];
                          ?>

                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="card">
                                      <form action="editProfile.php?do=Update" method="POST">
                                      
                                          <div class="row">
                                            <div class="col-lg-6 cardbg">
                                                <div class="form-group">
                                                    <label for="">My Name</label>
                                                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email Address</label>
                                                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Phone Number</label>
                                                    <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <input type="text" name="address" value="<?php echo $address; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="unitId" value="<?php echo $sessionId; ?>">
                                                    <input type="submit" name="updateProfile" value="Save Changes" class="btn btn-teal btn-block bg-b-10">
                                                </div>
                                            </div>
                                        </div>
                                      </form>
                                  </div>    
                                </div>
                              </div>
                            </div>

                          <?php
                    }
                  }
                }

                elseif( $do == 'Update'){
                    
                  if( isset( $_POST['updateProfile'])){
                    $unitId = $_POST['unitId'];
                    $name= $_POST["name"];
                    $email= $_POST["email"];
                    $phone= $_POST["phone"];$address= $_POST["address"];
                    $sql = " UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id = '$unitId' ";
                    $updateData = mysqli_query($db, $sql);
                    if( $updateData ){
                    header("location: editProfile.php?do=Manage");
                    }
                    else{
                    die("MySQL Error. " . mysqli_error($db));
                    }
                    
                  }

                }
                elseif( $do == 'Changepassword'){
                  // $oldpassword ="";
                  //     $err_oldpassword="";
                  //     $newpassword ="";
                  //     $err_newpassword="";
                  //     $repassword="";
                  //     $err_repassword="";
                  //     $hasError = false;
                  ?>
                    <form action="" method="post">
                    <h2>Change Password</h2>
            
                    <label>Old Password</label>
                    <input type="password" 
                      name="oldpassword" 
                      placeholder="Old Password">
                      <span class="tx-danger"><?php echo $err_oldpassword; ?></span>
                      <br>
            
                    <label>New Password</label>
                    <input type="password" 
                      name="newpassword" 
                      placeholder="New Password"><span class="tx-danger"><?php echo $err_newpassword; ?></span>
                      <br>
            
                    <label>Confirm New Password</label>
                    <input type="password" 
                      name="repassword" 
                      placeholder="Confirm New Password"><span class="tx-danger"><?php echo $err_repassword; ?></span>
                      <br>
            
                      <div class="form-group">
                          <input type="submit" name="Updatepassword" value="Change Password" class="btn btn-teal btn-block bg-b-10">
                      </div>
                  </form>
                  <?php
                }

                elseif( $do == 'Updatepass'){
                    // $id = $_SESSION['id'];
                    //   $oldpassword ="";
                    //   $err_oldpassword="";
                    //   $newpassword ="";
                    //   $err_newpassword="";
                    //   $repassword="";
                    //   $err_repassword="";
                    //   $hasError = false;

                    // if( isset( $_POST['Updatepassword']) ){
                    //   if(empty($_POST["oldpassword"])){
                    //     $err_oldpassword="*Old Password is required";
                    //     $hasError = true;
                    //   }
                    //   else{
                    //     $oldpassword=$_POST["oldpassword"];
                    //   }
                    //   if(empty($_POST["newpassword"])){
                    //     $err_newpassword="*New Password required";
                    //     $hasError = true;
                    //   }
                    //   else{
                    //     $newpassword=$_POST["newpassword"];
                    //   }
                    //   if(empty($_POST["repassword"])){
                    //     $err_repassword="*Re-type Password is required";
                    //     $hasError = true;
                    //   }
                    //   else{
                    //     $repassword= $_POST["repassword"];
                    //   }
                      
                    //   if(!$hasError){
                    //   $oldpassword= sha1($_POST["oldpassword"]);
                    //   $newpassword= $_POST["newpassword"];
                    //   $repassword= $_POST["repassword"];

                    //   $sql = "SELECT password FROM users WHERE id='$id'";
                    //   //echo $sql;
                    //   $result = mysqli_query($db, $sql);
                      
                    //   while ( $row = mysqli_fetch_assoc($result)){
                    //       $pass = $row['password'];
                          
                    //       if( $pass == $oldpassword){
                    //           if( $newpassword == $repassword){
                    //             $hassedPass = sha1($newpassword);
                    //             $sqlUpdate = "UPDATE users SET password='$hassedPass' WHERE id='$id'";
                    //             $update= mysqli_query($db, $sqlUpdate);
                    //             if($update){
                    //               echo "successfully";
                    //             }
                    //           }
                    //           else{
                    //             $err_repassword="*Password do not match";
                    //             //echo ' <div class="alert alert-warning">Password do not match</div>';
                    //           }
                    //       }
                    //       else{$err_oldpassword="*Old Password do not match";
                    //         //echo ' <div class="alert alert-warning">Old Password do not match</div>';
                    //       }
                    //   }
                    //   }
                      
                    // }
                  
                  }
                  
        ?>
        <!-- Body content End -->
      </div><!-- br-pagebody -->
      
      <?php include"inc/footer.php";?>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <?php include "inc/script.php";?>

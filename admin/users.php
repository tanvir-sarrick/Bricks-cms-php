<?php include "inc/header.php";?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pagetitle">
          <i class="icon ion-ios-home-outline"></i>
          <div>
            <h4>Manage All Users</h4>
            <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
          </div>
        </div>

        <div class="br-pagebody">
          <!-- Body content Start -->
          <?php 
                  // if( isset( $_GET['do'] ) ){
                  //     $do = $_GET['do'];
                  // }
                  // else {
                  //     $do = 'Manage';
                  // }
                  //Tarnary Condition
                  $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';

                  if( $do == 'Manage' ){
                    ?>
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card bd-0 shadow-base">
                            
                      <?php 
                          $sql = "SELECT * FROM users ORDER BY name ASC";
                          $allUsers = mysqli_query($db, $sql);
                          $rowcount = mysqli_num_rows($allUsers);
                          $i  = 0;
                          if($rowcount <=0 )
                          {
                              echo '<div class="alert alert-danger">Opps...! No data found. </div>';
                          }
                          else{ ?>
                            <table id="studentData" class="table table-borderd table-hover table-striped">
                                <thead class="">
                                  <tr>
                                    <th scope="col">#Sl.</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Join Date</th>
                                    <th scope="col">Action</th>

                                  </tr>
                                </thead>
                              <tbody>
                              <?php 
                                  while ( $row = mysqli_fetch_assoc($allUsers))
                                  {
                                      $id            = $row['id'];
                                      $image         = $row['image'];
                                      $name          = $row['name'];
                                      $email         = $row['email'];
                                      $phone         = $row['phone'];
                                      $address       = $row['address'];
                                      $role          = $row['role'];
                                      $status        = $row['status'];
                                      $j_date        = $row['j_date'];
                                      $i++;
                                      ?>

                                      <tr>
                                        <td ><?php echo $i; ?></td>
                                        <td ><?php 
                                              if( !empty( $image )){
                                                ?>
                                                <img src="assets/img/users/<?php echo $image; ?>" class="user-avater">
                                                <?php
                                              }
                                              else {
                                                ?>
                                                <img src="assets/img/users/emptyProfile.jpg" class="user-avater">
                                                <?php
                                              }
                                            ?>
                                        </td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td ><?php
                                              if( $role == 0 ){
                                                echo '<span class="badge badge-success">Supper Admin</span>';
                                              }
                                              elseif( $role == 1 ){
                                                echo '<span class="badge badge-primary">Accountant</span>';
                                              }
                                              elseif( $role == 2){
                                                echo '<span class="badge badge-info">Customer</span>';
                                              }
                                              else{
                                                echo '<span class="badge badge-danger">Not Found</span>';
                                              }
                                            ?>
                                        </td>
                                        <td ><?php  
                                            if( $status == 0 ){
                                              echo '<span class="badge badge-danger">Inactive</span>';
                                            }
                                            elseif( $status == 1 ){
                                              echo '<span class="badge badge-success">Active</span>';
                                            }
                                            ?>
                                        </td>

                                        <td><?php echo $j_date; ?></td>
                                        <td>
                                            <div class="btn-actionbar">
                                                <ul>
                                                  <li>
                                                    <a href="users.php?do=Edit&id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                                  </li>
                                                  <li>
                                                  <a href=""><i class="fa fa-trash"></i></a>
                                                  </li>
                                                </ul>
                                            </div>
                                        </td>
                                      </tr>
                                      <?php
                                  }
                                  ?>

                                </tbody>
                            </table>
                              <?php
                          }
                          ?>
                            </div>
                          </div>
                        </div>
                      </div>  
                    <?php
                  }

                  elseif( $do == 'Add'){
                    ?>
                    
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card bd-0 shadow-base">
                              <form action="users.php?do=Store" method="POST" enctype="multipart/form-data">
                              
                                  <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Full Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email Address</label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Re-Type Password</label>
                                            <input type="password" name="repassword" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mobile Number</label>
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                    </div>
                                    <!-- RIGHT SIDE -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">User Role</label>
                                            <select name="role" class="form-control">
                                                <option value="2">Please Select The User Role</option>
                                                <option value="0">Supper Admin</option>
                                                <option value="1">Accountant</option>
                                                <option value="2">Customer</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1">Please Select The Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Profile Picture</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" >
                                                <label class="custom-file-label custom-file-label-primary " for="">Choose</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="addUser" value="Add New User" class="btn btn-teal btn-block bg-b-10">
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
                  elseif( $do == 'Store'){
                  if( isset( $_POST['addUser'] ) ){
                    $name               = $_POST["name"];
                    $email              = $_POST["email"];
                    $password           = $_POST["password"];
                    $repassword         = $_POST["repassword"];
                    $phone              = $_POST["phone"];
                    $address            = $_POST["address"];
                    $role               = $_POST["role"];
                    $status             = $_POST["status"];
                    $image              = $_FILES['image']["name"];
                    $image_tmp          = $_FILES['image']["tmp_name"];

                      if( $password == $repassword ){
                        $hassedPass = sha1($password);

                        if( !empty($image) ){
                          $image_name =rand(1,9999999) . '-' . $image;
                          move_uploaded_file($image_tmp, "assets/img/users/" . $image_name );

                          $sql = "INSERT INTO users (name,email,password,phone,address,image,role,status,j_date) VALUES ( '$name', '$email', '$hassedPass', '$phone', '$address', '$image_name', '$role', '$status', now() )";
                          $storeUser = mysqli_query($db, $sql);
                          if( $storeUser ){
                            header("location: users.php?do=Manage");
                          }
                          else{
                            die("MYSQLi Error. " . mysqli_error($db));
                          }
                        }
                      }
                  }
                      

                  }
                  elseif( $do == 'Edit'){
                      if( isset( $_GET['id'] ) ){
                        $userId = $_GET['id'];
                        $sql = "SELECT * FROM users WHERE id = '$userId' ";
                        $readUser = mysqli_query($db, $sql);
                        while ( $row = mysqli_fetch_assoc($readUser))
                        {
                            $id              = $row['id'];
                            $image           = $row['image'];
                            $name            = $row['name'];
                            $email           = $row['email'];
                            $phone           = $row['phone'];
                            $address         = $row['address'];
                            $role            = $row['role'];
                            $status          = $row['status'];
                            $j_date          = $row['j_date'];
                            
                            ?>

                              <div class="container-fluid">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="card bd-0 shadow-base">
                                        <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
                                        
                                            <div class="row">
                                              <div class="col-lg-6">
                                                  <div class="form-group">
                                                      <label for="">Full Name</label>
                                                      <input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="">Email Address</label>
                                                      <input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="">Password</label>
                                                      <input type="password" name="password" class="form-control" placeholder="********" >
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="">Re-Type Password</label>
                                                      <input type="password" name="repassword" class="form-control" placeholder="********" >
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="">Mobile Number</label>
                                                      <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control">
                                                  </div>
                                              </div>
                                              <!-- RIGHT SIDE -->
                                              <div class="col-lg-6">
                                                  <div class="form-group">
                                                      <label for="">Address</label>
                                                      <input type="text" name="address" value="<?php echo $address; ?>" class="form-control">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="">User Role</label>
                                                      <select name="role" class="form-control">
                                                          <option value="2" >Please Select The User Role</option>
                                                          <option value="0" <?php if( $role == 0 ){ echo "selected";} ?> >Supper Admin</option>
                                                          <option value="1" <?php if( $role == 1 ){ echo "selected";} ?> >Accountant</option>
                                                          <option value="2" <?php if( $role == 2 ){ echo "selected";} ?> >Customer</option>
                                                      </select>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="">Status</label>
                                                      <select name="status" class="form-control">
                                                          <option value="1">Please Select The Status</option>
                                                          <option value="1" <?php if( $status == 1 ){ echo "selected"; } ?> >Active</option>
                                                          <option value="0" <?php if( $status == 0 ){ echo "selected"; } ?> >Inactive</option>
                                                      </select>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="">Profile Picture</label>
                                                      <div class="custom-file">
                                                          <input type="file" class="custom-file-input" name="image" >
                                                          <label class="custom-file-label custom-file-label-primary " for="">Choose</label>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <input type="hidden" name="userId" value="<?php echo $id; ?>">
                                                      <input type="submit" name="updateUser" value="Update User" class="btn btn-teal btn-block bg-b-10">
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
                      
                    if( isset( $_POST['updateUser'])){
                      $userId = $_POST['userId'];
                      $name= $_POST["name"];
                      $email= $_POST["email"];
                      $password= $_POST["password"];
                      $repassword= $_POST["repassword"];
                      $phone = $_POST["phone"];
                      $address = $_POST["address"];
                      $role= $_POST["role"];
                      $status= $_POST["status"];
                      $image= $_FILES['image']["name"];
                      $image_tmp= $_FILES['image']["tmp_name"];

                      if( !empty( $password ) && !empty( $image )){
                        //New Password Create
                        if( $password == $repassword ){
                          $hassedPass = sha1($password);

                        } 
                        // Old image Delete
                        $query = "SELECT * FROM users WHERE id = '$userId' ";
                        $userData = mysqli_query($db, $query); 
                        while ( $row = mysqli_fetch_assoc($userData))
                        {
                            $image     = $row['image'];
                            if( !empty( $image )){
                              unlink( "assets/img/users/" . $image );
                            }
                        }
                        
                        $image_name =rand(1,9999999) . '-' . $image;
                        move_uploaded_file($image_tmp, "assets/img/users/" . $image_name );
                        $sql = " UPDATE users SET name='$name', email='$email', password='$hassedPass', phone='$phone', address='$address',
                        role='$role', status='$status', image='$image_name' WHERE id = '$userId' ";
                        $updateData = mysqli_query($db, $sql);
                        if( $updateData ){
                          header("location: users.php?do=Manage");
                        }
                        else{
                          die("MySQL Error. " . mysqli_error($db));
                        }
                      }
                      elseif( !empty( $password ) && empty( $image )){
                        //New Password Create
                        if( $password == $repassword ){
                          $hassedPass = sha1($password);

                        } 
                        
                        $sql = " UPDATE users SET name='$name', email='$email', password='$hassedPass', phone='$phone', address='$address',
                        role='$role', status='$status' WHERE id = '$userId' ";
                        $updateData = mysqli_query($db, $sql);
                        if( $updateData ){
                          header("location: users.php?do=Manage");
                        }
                        else{
                          die("MySQL Error. " . mysqli_error($db));
                        }
                      }
                      elseif( empty( $password ) && !empty( $image )){
                        
                        // Old image Delete
                        $query = "SELECT * FROM users WHERE id = '$userId' ";
                        $userData = mysqli_query($db, $query); 
                        while ( $row = mysqli_fetch_assoc($userData))
                        {
                            $image     = $row['image'];
                            if( !empty( $image )){
                              unlink( "assets/img/users/" . $image );
                            }
                        }
                        
                        $image_name =rand(1,9999999) . '-' . $image;
                        move_uploaded_file($image_tmp, "assets/img/users/" . $image_name );
                        $sql = " UPDATE users SET name='$name', email='$email', phone='$phone', address='$address',
                        role='$role', status='$status', image='$image_name' WHERE id = '$userId' ";
                        $updateData = mysqli_query($db, $sql);
                        if( $updateData ){
                          header("location: users.php?do=Manage");
                        }
                        else{
                          die("MySQL Error. " . mysqli_error($db));
                        }
                      }
                      else{
                        
                        $sql = " UPDATE users SET name='$name', email='$email', phone='$phone', address='$address',
                        role='$role', status='$status' WHERE id = '$userId' ";
                        $updateData = mysqli_query($db, $sql);
                        if( $updateData ){
                          header("location: users.php?do=Manage");
                        }
                        else{
                          die("MySQL Error. " . mysqli_error($db));
                        }
                      }
                    }

                  }

                  elseif( $do == 'Delete'){
                      
                  }
          ?>
          <!-- Body content End -->
        </div><!-- br-pagebody -->
      
      <?php include"inc/footer.php";?>
  </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

<?php include "inc/script.php";?>

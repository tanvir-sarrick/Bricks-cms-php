<?php include "inc/header.php";?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Manage All Units</h4>
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
                        $sql = "SELECT * FROM unit_type ORDER BY unit_name ASC";
                        $allUnits = mysqli_query($db, $sql);
                        $rowcount = mysqli_num_rows($allUnits);
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
                                <th scope="col">Unit Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            while ( $row = mysqli_fetch_assoc($allUnits))
                            {
                                $id     = $row['id'];
                                $unit_name   = $row['unit_name'];
                                $status  = $row['status'];
                                $i++;
                                ?>

                                <tr>
                                <td ><?php echo $i; ?></td>
                                <td><?php echo $unit_name; ?></td>
                                <td ><?php  
                                    if( $status == 0 ){
                                      echo '<span class="badge badge-danger">Inactive</span>';
                                    }
                                    elseif( $status == 1 ){
                                      echo '<span class="badge badge-success">Active</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-actionbar">
                                        <ul>
                                          <li>
                                            <a href="unitType.php?do=Edit&id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                          </li>
                                          <li>
                                          <a href=""><i class="fa fa-trash"></i></a>
                                          </li>
                                        </ul>
                                    </div>
                                </td>
                                </tr>
                                <?php
                            }?>

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
                            <form action="unitType.php?do=Store" method="POST">
                            
                                <div class="row">
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="">Unit Name</label>
                                          <input type="text" name="unit_name" class="form-control">
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
                                          <input type="submit" name="addUnit" value="Add New Unit" class="btn btn-teal btn-block bg-b-10">
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
                 if( isset( $_POST['addUnit'] ) ){
                  $unit_name= $_POST["unit_name"];
                  $status= $_POST["status"];

                  $sql =" INSERT INTO unit_type ( unit_name, status ) VALUES ( '$unit_name', '$status' ) ";
                  $storeUnit = mysqli_query($db, $sql);

                  if( $storeUnit ){
                      header("location: unitType.php?do=Manage");
                  }
                  else{
                      die("MySQL Error. " . mysqli_error($db) );
                  }
                 }
                    

                }
                elseif( $do == 'Edit'){
                    if( isset( $_GET['id'] ) ){
                      $unitId = $_GET['id'];
                      $sql = "SELECT * FROM unit_type WHERE id = '$unitId' ";
                      $editUnit = mysqli_query($db, $sql);
                      while ( $row = mysqli_fetch_assoc($editUnit))
                      {
                          $id     = $row['id'];
                          $unit_name   = $row['unit_name'];
                          $status  = $row['status'];
                          ?>

                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="card bd-0 shadow-base">
                                      <form action="unitType.php?do=Update" method="POST">
                                      
                                          <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Unit Name</label>
                                                    <input type="text" name="unit_name" value="<?php echo $unit_name; ?>" class="form-control">
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
                                                    <input type="hidden" name="unitId" value="<?php echo $id; ?>">
                                                    <input type="submit" name="updateUnit" value="Save Changes" class="btn btn-teal btn-block bg-b-10">
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
                    
                  if( isset( $_POST['updateUnit'])){
                    $unitId = $_POST['unitId'];
                    $unit_name= $_POST["unit_name"];
                    $status= $_POST["status"];
                      
                    $sql = " UPDATE unit_type SET unit_name='$unit_name', status='$status' WHERE id = '$unitId' ";
                    $updateData = mysqli_query($db, $sql);
                    if( $updateData ){
                    header("location: unitType.php?do=Manage");
                    }
                    else{
                    die("MySQL Error. " . mysqli_error($db));
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

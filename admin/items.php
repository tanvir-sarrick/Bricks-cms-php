<?php include "inc/header.php";?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Manage All Purchase Item</h4>
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
                        $sql = "SELECT * FROM pr_materials ORDER BY item_name ASC";
                        $allItems = mysqli_query($db, $sql);
                        $rowcount = mysqli_num_rows($allItems);
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
                                <th scope="col">Item Name</th>
                                <th scope="col">Unit Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Purchase Date</th>
                                <th scope="col">Note</th>
                                <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            while ( $row = mysqli_fetch_assoc($allItems))
                            {
                                $id                 = $row['id'];
                                $item_name          = $row['item_name'];
                                $quantity           = $row['quantity'];
                                $unit_id            = $row['unit_id'];
                                $unit_price         = $row['unit_price'];
                                $p_date             = $row['p_date'];
                                $note               = $row['note'];
                                $i++;
                                ?>

                                <tr>
                                <td ><?php echo $i; ?></td>
                                </td>
                                <td><?php echo $item_name; ?></td>
                                <td><?php echo $quantity; ?>
                                    <?php
                                    $sql = "SELECT * FROM unit_type WHERE id = '$unit_id' ";
                                    $readUnit = mysqli_query($db, $sql);

                                    while( $row = mysqli_fetch_assoc($readUnit) ){
                                        $unit_name = $row['unit_name'];
                                        echo $unit_name;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $unit_price; ?> BDT</td>
                                <td><?php echo $quantity * $unit_price; ?> BDT</td>
                                <td><?php echo $p_date; ?></td>
                                <td><?php echo $note; ?></td>
                                <td>
                                    <div class="btn-actionbar">
                                        <ul>
                                          <li>
                                            <a href="items.php?do=Edit&id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>
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
                            <form action="items.php?do=Store" method="POST">
                            
                                <div class="row">
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="">Item Name</label>
                                          <input type="text" name="item_name" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="">Item Quantity</label>
                                          <input type="text" name="quantity" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="">Unit Id</label>
                                          <select name="unit_id" class="form-control">
                                            <option value="">Please Select The Unit Type</option>
                                            <?php
                                                $sql = "SELECT * FROM unit_type WHERE status = 1 ORDER BY unit_name ASC";
                                                $allUnits = mysqli_query($db, $sql);
                                                while ( $row = mysqli_fetch_assoc($allUnits))
                                                {
                                                    $id     = $row['id'];
                                                    $unit_name   = $row['unit_name'];
                                                    ?>
                                                    <option value="<?php echo $id;?>"> <?php echo $unit_name; ?></option>
                                                    <?php
                                                } 
                                            ?>
                                          </select>
                                      </div>
                                  </div>
                                  <!-- RIGHT SIDE -->
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="">Unit Price</label>
                                          <input type="text" name="unit_price" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="">Note</label>
                                          <input type="text" name="note" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <input type="submit" name="addItem" value="Add New Item" class="btn btn-teal btn-block bg-b-10">
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
                 if( isset( $_POST['addItem'] ) ){
                    $item_name          = $_POST["item_name"];
                    $quantity           = $_POST["quantity"];
                    $unit_id            = $_POST['unit_id'];
                    $unit_price         = $_POST['unit_price'];
                    $p_date             = $_POST['p_date'];
                    $note               = $_POST['note'];

                        $sql = "INSERT INTO pr_materials (item_name,quantity,unit_id,unit_price,p_date,note) VALUES ( '$item_name', '$quantity', '$unit_id', '$unit_price', now(), '$note' )";
                        $storeItem = mysqli_query($db, $sql);
                        if( $storeItem ){
                          header("location: items.php?do=Manage");
                        }
                        else{
                          die("MYSQLi Error. " . mysqli_error($db));
                        }
                     
                  }   

                }
                elseif( $do == 'Edit'){
                    if( isset( $_GET['id'] ) ){
                      $itemId = $_GET['id'];
                      $sql = "SELECT * FROM pr_materials WHERE id = '$itemId' ";
                      $readItem = mysqli_query($db, $sql);
                      while ( $row = mysqli_fetch_assoc($readItem))
                      {
                          $id                 = $row['id'];
                          $item_name          = $row['item_name'];
                          $quantity           = $row['quantity'];
                          $unit_id            = $row['unit_id'];
                          $unit_price         = $row['unit_price'];
                          $note               = $row['note'];
                          ?>

                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="card bd-0 shadow-base">
                                      <form action="items.php?do=Update" method="POST" enctype="multipart/form-data">
                                      
                                          <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Item Name</label>
                                                    <input type="text" name="item_name" value="<?php echo $item_name; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Item Quantity</label>
                                                    <input type="text" name="quantity" value="<?php echo $quantity; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Unit Id</label>
                                                    <select name="unit_id" class="form-control">
                                                        <option>Please Select The Status</option>
                                                        <?php
                                                            $sql = "SELECT * FROM unit_type WHERE status = 1 ORDER BY unit_name ASC";
                                                            $allUnits = mysqli_query($db, $sql);
                                                            while ( $row = mysqli_fetch_assoc($allUnits))
                                                            {
                                                                $unt_id     = $row['id'];
                                                                $unit_name   = $row['unit_name'];
                                                                ?>
                                                                <option value="<?php echo $unt_id;?>" 
                                                                  <?php if( $unit_id == $unt_id ) { echo 'selected';}  ?>
                                                                > <?php echo $unit_name; ?></option>
                                                                <?php
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- RIGHT SIDE -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Unit Price</label>
                                                    <input type="text" name="unit_price" value="<?php echo $unit_price; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Note</label>
                                                    <input type="text" name="note" value="<?php echo $note; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="itemId" value="<?php echo $id; ?>">
                                                    <input type="submit" name="updateItem" value="Save Change" class="btn btn-teal btn-block bg-b-10">
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
                    
                  if( isset( $_POST['updateItem'])){
                    $itemId           = $_POST['itemId'];
                    $item_name        = $_POST["item_name"];
                    $quantity         = $_POST["quantity"];
                    $unit_id          = $_POST['unit_id'];
                    $unit_price       = $_POST['unit_price'];
                    $note             = $_POST['note'];

                      $sql = " UPDATE pr_materials SET item_name='$item_name', quantity='$quantity', unit_id='$unit_id', unit_price='$unit_price', note='$note' WHERE id = '$itemId' ";
                      $updateData = mysqli_query($db, $sql);
                      if( $updateData ){
                        header("location: items.php?do=Manage");
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

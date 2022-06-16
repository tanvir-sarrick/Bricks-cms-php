<?php include "inc/header.php";?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Manage All Product / Quangtity</h4>
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
                        $sql = "SELECT * FROM products ORDER BY product_id ASC";
                        $allProducts = mysqli_query($db, $sql);
                        $rowcount = mysqli_num_rows($allProducts);
                        $i  = 0;
                        $currentStock = 0;
                        if($rowcount <=0 )
                        {
                            echo '<div class="alert alert-danger">Opps...! No data found. </div>';
                        }
                        else{ ?>
                          <table id="studentData" class="table table-borderd table-hover table-striped">
                            <thead class="">
                                <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Total Stock (QN)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Stock Date</th>
                                <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            while ( $row = mysqli_fetch_assoc($allProducts))
                            {
                                $id             = $row['id'];
                                $product_id     = $row['product_id'];
                                $quantity       = $row['quantity'];
                                $price          = $row['price'];
                                $status         = $row['status'];
                                $stock_date     = $row['stock_date'];
                                $i++;
                                ?>

                                <tr>
                                <td ><?php echo $i; ?></td>
                                <td><?php 
                                  $sql = "SELECT * FROM product_type WHERE id = '$product_id' ";
                                    $readUnit = mysqli_query($db, $sql);

                                    while( $row = mysqli_fetch_assoc($readUnit) ){
                                        $product_name = $row['product_name'];
                                        echo $product_name;
                                    }
                                ?>
                                </td>
                                <td><?php echo $quantity; ?>
                                    <?php
                                    // $sql = "SELECT * FROM unit_type WHERE id = '$unit_id' ";
                                    // $readUnit = mysqli_query($db, $sql);

                                    // while( $row = mysqli_fetch_assoc($readUnit) ){
                                    //     $unit_name = $row['unit_name'];
                                    //     echo $unit_name;
                                    // }
                                    ?>
                                </td>
                                <td><?php echo $price; ?> BDT</td>
                                <td> 
                                    <?php
                                        $currentStock += $quantity;
                                        echo $currentStock;
                                    ?>
                                </td>
                                <td><?php  
                                    if( $status == 0 ){
                                      echo '<span class="badge badge-danger">Inactive</span>';
                                    }
                                    elseif( $status == 1 ){
                                      echo '<span class="badge badge-success">Active</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $stock_date; ?></td>
                                <td>
                                    <div class="btn-actionbar">
                                        <ul>
                                          <li>
                                            <a href="products.php?do=Edit&id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>
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
                            <form action="products.php?do=Store" method="POST">
                            
                                <div class="row">
                                  <div class="col-lg-6">
                                  <div class="form-group">
                                      <label for="">Product Name</label>
                                      <select name="product_id" class="form-control">
                                        <option value="">Please Select Product Type</option>
                                        <?php
                                            $sql = "SELECT * FROM product_type WHERE status = 1 ORDER BY product_name ASC";
                                            $allUnits = mysqli_query($db, $sql);
                                            while ( $row = mysqli_fetch_assoc($allUnits))
                                            {
                                                $id     = $row['id'];
                                                $product_name   = $row['product_name'];
                                                ?>
                                                <option value="<?php echo $id;?>"> <?php echo $product_name; ?></option>
                                                <?php
                                            } 
                                        ?>
                                      </select>
                                  </div>
                                      <div class="form-group">
                                          <label for="">Product Quantity</label>
                                          <input type="text" name="quantity" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="">Unit Price</label>
                                          <input type="text" name="price" class="form-control">
                                      </div>
                                  </div>
                                  <!-- RIGHT SIDE -->
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="">Status</label>
                                          <select name="status" class="form-control">
                                              <option value="1">Please Select The Status</option>
                                              <option value="1">Active</option>
                                              <option value="0">Inactive</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <input type="submit" name="addProduct" value="Add New Product" class="btn btn-teal btn-block bg-b-10">
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
                 if( isset( $_POST['addProduct'] ) ){
                    $product_id         = $_POST['product_id'];
                    $quantity           = $_POST["quantity"];
                    $unit_price         = $_POST['price'];
                    $status             = $_POST["status"];
                    $stock_date         = $_POST['stock_date'];

                        $sql = "INSERT INTO products (product_id, quantity, price, status, stock_date) VALUES ( '$product_id', '$quantity', '$unit_price', '$status', now() )";
                        $storeProduct = mysqli_query($db, $sql);
                        if( $storeProduct ){
                          header("location: products.php?do=Manage");
                        }
                        else{
                          die("MYSQLi Error. " . mysqli_error($db));
                        }
                     
                  }   

                }
                elseif( $do == 'Edit'){
                    if( isset( $_GET['id'] ) ){
                      $productId = $_GET['id'];
                      $sql = "SELECT * FROM products WHERE id = '$productId' ";
                      $readProduct = mysqli_query($db, $sql);
                      while ( $row = mysqli_fetch_assoc($readProduct))
                      {
                          $id                 = $row['id'];
                          $product_id         = $row['product_id'];
                          $quantity           = $row['quantity'];
                          $price              = $row['price'];
                          $status             = $row['status'];
                          $stock_date         = $row['stock_date'];
                          ?>

                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="card bd-0 shadow-base">
                                      <form action="products.php?do=Update" method="POST">
                                      
                                          <div class="row">
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                    <label for="">Product Name</label>
                                                    <select name="product_id" class="form-control">
                                                        <option>Please Select Product Name</option>
                                                        <?php
                                                            $sql = "SELECT * FROM product_type WHERE status = 1 ORDER BY product_name ASC";
                                                            $allUnits = mysqli_query($db, $sql);
                                                            while ( $row = mysqli_fetch_assoc($allUnits))
                                                            {
                                                                $p_id     = $row['id'];
                                                                $p_name   = $row['product_name'];
                                                                ?>
                                                                <option value="<?php echo $p_id;?>" 
                                                                  <?php if( $product_id == $p_id ) { echo 'selected';}  ?>
                                                                > <?php echo $p_name; ?></option>
                                                                <?php
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                              <div class="form-group">
                                                  <label for="">Product Quantity</label>
                                                  <input type="text" name="quantity" value="<?php echo $quantity; ?>" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="">Unit Price</label>
                                                  <input type="text" name="price" value="<?php echo $price; ?>" class="form-control">
                                              </div>
                                            </div>
                                            <!-- RIGHT SIDE -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1">Please Select The Status</option>
                                                        <option value="1" <?php if( $status == 1 ){ echo "selected"; } ?> >Active</option>
                                                        <option value="0" <?php if( $status == 0 ){ echo "selected"; } ?> >Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="productId" value="<?php echo $id; ?>">
                                                    <input type="submit" name="updateProduct" value="Save Change" class="btn btn-teal btn-block bg-b-10">
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
                    
                  if( isset( $_POST['updateProduct'])){
                    $productId          = $_POST['productId'];
                    $product_id         = $_POST['product_id'];
                    $quantity           = $_POST["quantity"];
                    $unit_price         = $_POST['price'];
                    $status             = $_POST["status"];
                    

                      $sql = " UPDATE products SET product_id='$product_id', quantity='$quantity', price='$unit_price', status='$status' WHERE id = '$productId' ";
                      $updateData = mysqli_query($db, $sql);
                      if( $updateData ){
                        header("location: products.php?do=Manage");
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

<?php include "inc/header.php";?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Selling History</h4>
          <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
        
      </div>

     

      <div class="br-pagebody">
      
        <!-- Body content Start -->
        <?php 
            $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';

            if( $do == 'Manage' ){
              ?>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card bd-0 shadow-base">
                      
                <?php 
                    $sql = "SELECT * FROM sells_info ORDER BY selling_date ASC";
                    $allItems = mysqli_query($db, $sql);
                    $rowcount = mysqli_num_rows($allItems);
                    $i  = 0;
                    if($rowcount <=0 )
                    {
                        echo '<div class="alert alert-danger">Opps...! No Selling data found. </div>';
                    }
                    else{ ?>
                      <table id="studentData" class="table table-borderd table-hover table-striped">
                        <thead class="">
                            <tr>
                            <th scope="col">#Sl.</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Mobile NUmber</th>
                            <th scope="col">Customer Address</th>
                            <th scope="col">Sold Products</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Selling Date</th>
                            <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        while ( $row = mysqli_fetch_assoc($allItems))
                        {
                            $id                 = $row['id'];
                            $name               = $row['name'];
                            $email              = $row['email'];
                            $phone              = $row['phone'];
                            $address            = $row['address'];
                            $product_id         = $row['product_id'];
                            $quantity           = $row['quantity'];
                            $price              = $row['price'];
                            $selling_date       = $row['selling_date'];
                           
                            $i++;
                            ?>

                            <tr>
                            <td ><?php echo $i; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $address; ?></td>
                            <td>
                              <?php
                                $sql = "SELECT * FROM product_type WHERE id = '$product_id' ";
                                $readUnit = mysqli_query($db, $sql);

                                while( $row = mysqli_fetch_assoc($readUnit) ){
                                    $product_name = $row['product_name'];
                                    echo $product_name;
                                }
                                ?>
                            </td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $price; ?> BDT</td>
                            <td><?php echo $quantity * $price; ?> BDT</td>
                            <td><?php echo $selling_date; ?></td>
                            
                            <td>
                                <div class="btn-actionbar">
                                    <ul>
                                      <li>
                                        <a href="sells.php?do=Edit&id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>
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
              
                  <div class="br-pagebody">
                      <!-- Body content Start -->
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="card bg-info">
                                        <h5 class="text-center text-white">Production History</h5><br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                              <table id="studentData" class="table table-borderd table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ITEM NAME</th>
                                                        <th>INVENTORY AMOUNT</th>
                                                        <th>AVERAGE UNIT PRICE</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tx-white">
                                                    <tr>
                                                        <td> 
                                                            <?php 
                                                              $sql = "SELECT product_name FROM product_type WHERE id='1' ";
                                                                $readUnit = mysqli_query($db, $sql);

                                                                while( $row = mysqli_fetch_assoc($readUnit) ){
                                                                    $product_name = $row['product_name'];
                                                                    echo $product_name;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                              $sql = "SELECT SUM(quantity) AS sum FROM products WHERE product_id='1'";

                                                              $result = mysqli_query($db, $sql);
                                                              while ( $row = mysqli_fetch_assoc($result))
                                                              {
                                                                  $total_quantity = $row['sum'];
                                                                  echo $total_quantity . ' Pices';
                                                              }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                              $sql = "SELECT AVG(price) AS avg FROM products WHERE product_id='1'";

                                                              $result = mysqli_query($db, $sql);
                                                              while ( $row = mysqli_fetch_assoc($result))
                                                              {
                                                                  $avg_price = $row['avg'];
                                                                  echo $avg_price . ' BDT';
                                                              }
                                                            ?> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Sold</td>
                                                        <td>
                                                            <?php 
                                                              $sql = "SELECT SUM(quantity) AS sum FROM sells_info WHERE product_id='1'";

                                                              $result = mysqli_query($db, $sql);
                                                              while ( $row = mysqli_fetch_assoc($result))
                                                              {
                                                                $sold_quantity = $row['sum'];
                                                                  echo $sold_quantity . ' Pices';
                                                              }
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                                    <tr>
                                                          <td>Bricks in Inventory</td>
                                                          <td>
                                                          <td>
                                                              <?php 
                                                                $inventory = ( $total_quantity - $sold_quantity);
                                                                echo $inventory;
                                                              ?>
                                                        </td>
                                                          </td>
                                                    </tr>
                                                </tbody>
                                              </table>
                                            </div>

                                            <div class="col-lg-6">
                                            <table id="studentData" class="table table-borderd table-hover      table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ITEM NAME</th>
                                                        <th>INVENTORY AMOUNT</th>
                                                        <th>AVERAGE UNIT PRICE</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tx-white">
                                                    <tr>
                                                        <td> 
                                                            <?php 
                                                              $sql = "SELECT product_name FROM product_type WHERE id='2' ";
                                                                $readUnit = mysqli_query($db, $sql);

                                                                while( $row = mysqli_fetch_assoc($readUnit) ){
                                                                    $product_name = $row['product_name'];
                                                                    echo $product_name;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                              $sql = "SELECT SUM(quantity) AS total FROM products WHERE product_id='2'";

                                                              $result = mysqli_query($db, $sql);
                                                              while ( $row = mysqli_fetch_assoc($result))
                                                              {
                                                                  $total_quantity = $row['total'];
                                                                  echo $total_quantity . ' Pices';
                                                              }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                              $sql = "SELECT AVG(price) AS avg FROM products WHERE product_id='2'";

                                                              $result = mysqli_query($db, $sql);
                                                              while ( $row = mysqli_fetch_assoc($result))
                                                              {
                                                                  $avg_price = $row['avg'];
                                                                  echo $avg_price . ' BDT';
                                                              }
                                                            ?> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Sold</td>
                                                        <td>
                                                            <?php 
                                                              $sql = "SELECT SUM(quantity) AS sum FROM sells_info WHERE product_id='2'";

                                                              $result = mysqli_query($db, $sql);
                                                              while ( $row = mysqli_fetch_assoc($result))
                                                              {
                                                                  $sold_quantity = $row['sum'];
                                                                  echo $sold_quantity . ' Pices';
                                                              }
                                                            ?>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                          <td>Picket in Inventory</td>
                                                          <td>
                                                          <td>
                                                              <?php 
                                                                $inventory = ( $total_quantity - $sold_quantity);
                                                                echo $inventory;
                                                              ?>
                                                        </td>
                                                          </td>
                                                    </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                  </div>
                              </div>  
                      
                  </div> 
                  <br>        
                  <!-- Body content End -->
                  </div><!-- br-pagebody -->


                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="card bd-0 shadow-base">
                                    <form action="sells.php?do=Store" method="POST">
                                    
                                        <div class="row">
                                          <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label for="">Customer Name</label>
                                                  <input type="text" name="name" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="">Email Address</label>
                                                  <input type="email" name="email"  class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="">Mobile Number</label>
                                                  <input type="text" name="phone"  class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="">Address</label>
                                                  <input type="text" name="address"  class="form-control">
                                              </div>

                                          </div>
                                          <!-- RIGHT SIDE -->
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
                                                  <label for="">Quantity</label>
                                                  <input type="text" name="quantity" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="">Unit Price</label>
                                                  <input type="text" name="price" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <input type="submit" name="addItem" value="Check Out" class="btn btn-teal btn-block bg-b-10">
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
                            $name           = $_POST["name"];
                            $email          = $_POST["email"];
                            $phone          = $_POST["phone"];
                            $address        = $_POST["address"];
                            $product_id     = $_POST['product_id'];
                            $quantity       = $_POST["quantity"];
                            $price          = $_POST['price'];
                            $selling_date    = $_POST['selling_date'];
                            

                                $sql = "INSERT INTO sells_info (name,email,phone,address,product_id,quantity,price,selling_date) 
                                  VALUES ( '$name','$email','$phone','$address','$product_id','$quantity','$price', now() )";
                                $storeItem = mysqli_query($db, $sql);
                                if( $storeItem ){
                                  header("location: sells.php?do=Manage");
                                }
                                else{
                                  die("MYSQLi Error. " . mysqli_error($db));
                                }
                              
                          }   

                        }
                    ?>
                    <!-- Body content End -->
                  </div><!-- br-pagebody -->
      
      <?php include"inc/footer.php";?>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <?php include "inc/script.php";?>

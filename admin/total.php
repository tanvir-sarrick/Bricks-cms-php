
<?php include "inc/header.php";?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Dashboard</h4>
          <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
      </div>

      <div class="br-pagebody">
        <table id="studentData" class="table table-borderd table-hover table-striped">
            <thead>
                <tr>
                    <th>ITEM Name</th>
                    <th>Name</th>
                    <th>avge</th>
                </tr>
            </thead>
            <tbody>
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
                </tr>
            </tbody>
        </table>
      
   
  


        <!-- Body content Start -->
        <!-- Body content End -->
      </div><!-- br-pagebody -->
      
      <?php include"inc/footer.php";?>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <?php include "inc/script.php";?>

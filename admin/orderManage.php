<div class="container" style="margin-top:98px; background-color: #121212; padding-bottom: 50px;">
    <div class="table-wrapper" style="background-color: #1e1e1e; border-radius: 15px; padding: 25px; border: 1px solid #333;">
        
        <div class="table-title" style="background-color: #000; border-radius: 15px 15px 0 0; padding: 20px; border-bottom: 2px solid #ffc107;">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h2 style="color: #ffc107; margin: 0; text-transform: uppercase; font-weight: 800;">Order <b style="color: #fff;">Manage</b></h2>
                </div>
                <div class="col-sm-8 text-right">                      
                    <a href="index.php?page=orderManage" class="btn btn-warning btn-sm font-weight-bold" style="border-radius: 50px;">
                        <i class="material-icons" style="vertical-align: middle;">refresh</i> <span>Refresh</span>
                    </a>
                    <a href="#" onclick="window.print()" class="btn btn-secondary btn-sm font-weight-bold ml-2" style="border-radius: 50px;">
                        <i class="material-icons" style="vertical-align: middle;">print</i> <span>Print</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover text-center mb-0" id="NoOrder" style="color: #fff;">
                <thead style="background-color: #333; color: #ffc107;">
                    <tr>
                        <th>Order Id</th>
                        <th>User Id</th>
                        <th class="text-left">Address</th>
                        <th>Phone No</th>
                        <th>Amount</th>                    
                        <th>Payment Mode</th>
                        <th>Order Date</th>
                        <th>Status</th>                    
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM `orders` ORDER BY `orderId` DESC";
                        $result = mysqli_query($conn, $sql);
                        $counter = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $Id = $row['userId'];
                            $orderId = $row['orderId'];
                            $address = $row['address'];
                            $zipCode = $row['zipCode'];
                            $phoneNo = $row['phoneNo'];
                            $amount = $row['amount'];
                            $orderDate = $row['orderDate'];
                            $paymentMode = $row['paymentMode'];

                            if($paymentMode == 0) {
                                $paymentLabel = "<span class='badge badge-secondary'>COD</span>";
                            } else {
                                $paymentLabel = "<span class='badge badge-success'>Online</span>";
                            }
                            
                            $orderStatus = $row['orderStatus'];
                            $counter++;
                            
                            echo '<tr style="border-bottom: 1px solid #333;">
                                    <td><b>' . $orderId . '</b></td>
                                    <td>' . $Id . '</td>
                                    <td class="text-left" data-toggle="tooltip" title="' .$address. '" style="max-width: 200px;">' . substr($address, 0, 20) . '...</td>
                                    <td>' . $phoneNo . '</td>
                                    <td style="color: #ffc107; font-weight: bold;">Rp' . $amount . '.000</td>
                                    <td>' . $paymentLabel . '</td>
                                    <td>' . date("d M Y", strtotime($orderDate)) . '</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#orderStatus' . $orderId . '" class="view text-info" title="Update Status">
                                            <i class="material-icons">local_shipping</i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view text-warning" title="View Items">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                    </td>
                                </tr>';
                        }
                        
                        if($counter==0) {
                            echo '<tr><td colspan="9"><div class="alert alert-dark mt-3" role="alert"> No Orders Received Yet! </div></td></tr>';
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 

<?php 
    include 'partials/_orderItemModal.php';
    include 'partials/_orderStatusModal.php';
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    /* Tooltip Fix */
    .tooltip.show { top: -62px !important; }
    
    /* Hover Row Effect */
    .table-hover tbody tr:hover {
        background-color: #252525;
    }
    
    /* Icon Styling */
    .view i {
        font-size: 24px;
        transition: 0.3s;
    }
    .view:hover i {
        transform: scale(1.2);
    }
</style>

<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
</script>
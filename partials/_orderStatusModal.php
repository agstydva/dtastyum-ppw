<style>
    /* Modal Dark Theme */
    .modal-content {
        background-color: #1e1e1e;
        color: #fff;
        border: 1px solid #333;
        border-radius: 15px;
    }

    .modal-header {
        border-bottom: 1px solid #333;
        background-color: #000;
        border-radius: 15px 15px 0 0;
        padding: 20px;
    }

    .modal-title {
        color: #ffc107;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .close {
        color: #fff;
        text-shadow: none;
        opacity: 1;
        transition: 0.3s;
    }
    .close:hover {
        color: #ffc107;
    }

    /* Card di dalam Modal */
    .card-dark {
        background-color: #252525;
        border: 1px solid #333;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .label-title {
        color: #ffc107;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .label-value {
        color: #e0e0e0;
        font-size: 0.95rem;
    }

    /* Tracking Progress Bar */
    .track {
        position: relative;
        background-color: #444; /* Jalur mati (abu gelap) */
        height: 5px;
        display: flex;
        /* PERBAIKAN JARAK: Margin bottom diperbesar agar teks tidak tertabrak tombol */
        margin-bottom: 100px; 
        margin-top: 50px;
        border-radius: 5px;
    }

    .track .step {
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative;
    }

    .track .step::before {
        height: 5px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px;
    }

    /* Warna garis aktif (Kuning) */
    .track .step.active:before {
        background: #ffc107; 
    }

    /* Icon Bulat */
    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #333; /* Default mati */
        color: #777;
        z-index: 2;
        border: 2px solid #1e1e1e; /* Border luar agar terpisah dari garis */
    }

    /* Icon Aktif (Kuning, Icon Hitam) */
    .track .step.active .icon {
        background: #ffc107;
        color: #000;
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.4);
    }

    .track .text {
        display: block;
        margin-top: 15px; /* Jarak teks dari icon sedikit ditambah */
        font-size: 0.85rem;
        color: #999;
        font-weight: 500;
    }

    .track .step.active .text {
        color: #fff;
        font-weight: 600;
    }

    /* Tombol Help */
    .btn-help {
        background-color: #ffc107;
        color: #000;
        font-weight: 700;
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 50px;
        transition: 0.3s;
        display: block;
    }

    .btn-help:hover {
        background-color: #fff;
        color: #000;
        text-decoration: none;
    }
</style>

<?php 
    // Pastikan variabel $userId tersedia
    if(isset($userId)) {
        $statusmodalsql = "SELECT * FROM `orders` WHERE `userId`= $userId";
        $statusmodalresult = mysqli_query($conn, $statusmodalsql);
        while($statusmodalrow = mysqli_fetch_assoc($statusmodalresult)){
            $orderid = $statusmodalrow['orderId'];
            $status = $statusmodalrow['orderStatus'];
            
            // Status Text Logic
            if ($status == 0) $tstatus = "Pemesanan Dilakukan.";
            elseif ($status == 1) $tstatus = "Pesanan Dikonfirmasi.";
            elseif ($status == 2) $tstatus = "Pesanan Sedang Diproses.";
            elseif ($status == 3) $tstatus = "Sedang Dikirim.";
            elseif ($status == 4) $tstatus = "Tiba Di Tempat.";
            elseif ($status == 5) $tstatus = "Pesanan Ditolak.";
            else $tstatus = "Pesanan Dibatalkan.";

            // Delivery Details Logic
            if($status >= 1 && $status <= 4) {
                $deliveryDetailSql = "SELECT * FROM `deliverydetails` WHERE `orderId`= $orderid";
                $deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);
                if($deliveryDetailResult && mysqli_num_rows($deliveryDetailResult) > 0){
                    $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
                    $trackId = $deliveryDetailRow['id'];
                    $deliveryBoyName = $deliveryDetailRow['deliveryBoyName'];
                    $deliveryBoyPhoneNo = $deliveryDetailRow['deliveryBoyPhoneNo'];
                    $deliveryTime = $deliveryDetailRow['deliveryTime'];
                    if($status == 4) $deliveryTime = 'Arrived';
                } else {
                    $trackId = 'Waiting...';
                    $deliveryBoyName = '-';
                    $deliveryBoyPhoneNo = '-';
                    $deliveryTime = '-';
                }
            }
            else {
                $trackId = 'xxxxx';
                $deliveryBoyName = '-';
                $deliveryBoyPhoneNo = '-';
                $deliveryTime = 'xx';
            }
?>

<div class="modal fade" id="orderStatus<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Track Order #<?php echo $orderid; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-4">
                <div class="card-dark p-3">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="label-title">Estimated Time</div>
                            <div class="label-value"><?php echo $deliveryTime; ?> min</div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="label-title">Shipping By</div>
                            <div class="label-value">
                                <?php echo $deliveryBoyName; ?> <br>
                                <?php if($deliveryBoyPhoneNo != '-') echo '<small><i class="fa fa-phone text-warning"></i> '.$deliveryBoyPhoneNo.'</small>'; ?>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="label-title">Current Status</div>
                            <div class="label-value text-warning font-weight-bold"><?php echo $tstatus; ?></div>
                        </div>
                        <div class="col-md-3">
                            <div class="label-title">Tracking #</div>
                            <div class="label-value"><?php echo $trackId; ?></div>
                        </div>
                    </div>
                </div>

                <div class="track">
                    <?php
                        $step1 = ($status >= 0 && $status < 5) ? 'active' : '';
                        $step2 = ($status >= 1 && $status < 5) ? 'active' : '';
                        $step3 = ($status >= 2 && $status < 5) ? 'active' : '';
                        $step4 = ($status >= 3 && $status < 5) ? 'active' : '';
                        $step5 = ($status == 4) ? 'active' : '';

                        if($status < 5) { // Normal Process
                    ?>
                        <div class="step <?php echo $step1; ?>"> 
                            <span class="icon"> <i class="fa fa-clipboard-check"></i> </span> 
                            <span class="text">Ordered</span> 
                        </div>
                        <div class="step <?php echo $step2; ?>"> 
                            <span class="icon"> <i class="fa fa-user-check"></i> </span> 
                            <span class="text">Confirmed</span> 
                        </div>
                        <div class="step <?php echo $step3; ?>"> 
                            <span class="icon"> <i class="fa fa-fire"></i> </span> 
                            <span class="text">Cooking</span> 
                        </div>
                        <div class="step <?php echo $step4; ?>"> 
                            <span class="icon"> <i class="fa fa-shipping-fast"></i> </span> 
                            <span class="text">On Way</span> 
                        </div>
                        <div class="step <?php echo $step5; ?>"> 
                            <span class="icon"> <i class="fa fa-box-open"></i> </span> 
                            <span class="text">Delivered</span> 
                        </div>
                    <?php 
                        } elseif ($status == 5) { // Denied
                            echo '<div class="step active text-center w-100"> 
                                    <span class="icon" style="background:#dc3545; color:white;"> <i class="fa fa-times"></i> </span> 
                                    <span class="text text-danger">Order Denied / Rejected</span> 
                                  </div>';
                        } else { // Cancelled
                            echo '<div class="step active text-center w-100"> 
                                    <span class="icon" style="background:#dc3545; color:white;"> <i class="fa fa-ban"></i> </span> 
                                    <span class="text text-danger">Order Cancelled</span> 
                                  </div>';
                        }
                    ?>
                </div>

                <div class="text-center" style="margin-top: 30px; margin-bottom: 10px;">
                    <a href="contact.php" class="btn-help shadow-sm">
                        Need Help? Contact Support <i class="fa fa-chevron-right ml-1"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
        } // End While
    } // End If isset userId
?>
<style>
    /* Admin Global Style */
    .container-fluid {
        background-color: #121212;
        color: #fff;
        padding-bottom: 50px;
    }

    /* Card Styling */
    .card-dark {
        background-color: #1e1e1e;
        border: 1px solid #333;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.5);
    }

    /* Table Styling */
    .table-dark-custom {
        color: #e0e0e0;
        background-color: #1e1e1e;
    }

    .table-dark-custom thead th {
        background-color: #000;
        color: #ffc107;
        border-color: #333;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .table-dark-custom tbody td {
        border-color: #333;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #252525;
        color: #fff;
    }

    /* Buttons */
    .btn-theme {
        background-color: #ffc107;
        color: #000;
        font-weight: 700;
        border: none;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-theme:hover {
        background-color: #e0a800;
        color: #000;
    }

    .btn-outline-theme {
        background: transparent;
        border: 2px solid #ffc107;
        color: #ffc107;
        font-weight: 700;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-outline-theme:hover {
        background: #ffc107;
        color: #000;
    }

    /* Form Input Styling */
    .form-control-dark {
        background-color: #2d2d2d;
        border: 1px solid #444;
        color: #fff;
        border-radius: 8px;
    }

    .form-control-dark:focus {
        background-color: #333;
        color: #fff;
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    /* Modal Dark */
    .modal-content-dark {
        background-color: #1e1e1e;
        color: #fff;
        border: 1px solid #333;
    }
    
    .modal-header-dark {
        background-color: #000;
        border-bottom: 1px solid #333;
        color: #ffc107;
    }
    
    .close { color: #fff; text-shadow: none; opacity: 1; }
    .close:hover { color: #ffc107; }
</style>

<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%" id='notempty'>
    <strong><i class="fas fa-info-circle"></i> Info!</strong> Harap Tinggalkan Pesan Jika Membatalkan Pesanan! 
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
</div>

<div class="container-fluid" style="margin-top:98px">
    
    <div class="row mb-3">
        <div class="col-lg-12 text-right">
            <button type="button" class="btn btn-outline-theme py-2 px-4" data-toggle="modal" data-target="#history">
                <span>HISTORY <i class="fas fa-history ml-1"></i></span>
            </button>
        </div>
    </div>

    <div class="row" id='empty'>
        <div class="col-lg-12">
            <div class="card card-dark">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark-custom table-hover mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>UserId</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Order Id</th>
                                    <th>Message</th>
                                    <th>Date Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM contact"; 
                                    $result = mysqli_query($conn, $sql);
                                    $count = 0;
                                    while($row=mysqli_fetch_assoc($result)) {
                                        $contactId = $row['contactId'];
                                        $userId = $row['userId'];
                                        $email = $row['email'];
                                        $phoneNo = $row['phoneNo'];
                                        $orderId = $row['orderId'];
                                        $message = $row['message'];
                                        $time = $row['time'];
                                        $count++;

                                        echo '<tr>
                                                <td>' .$contactId. '</td>
                                                <td>' .$userId. '</td>
                                                <td>' .$email. '</td>
                                                <td>' .$phoneNo. '</td>
                                                <td>' .$orderId. '</td>
                                                <td>' .$message. '</td>
                                                <td>' .$time. '</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-theme" type="button" data-toggle="modal" data-target="#reply' .$contactId. '">
                                                        <i class="fas fa-reply"></i> Reply
                                                    </button>
                                                </td>
                                              </tr>';
                                    }
                                    if($count==0) {
                                      ?>
                                      <script> 
                                        document.getElementById("notempty").innerHTML = '<div class="alert alert-dark alert-dismissible fade show" role="alert" style="width:100%"> <i class="fas fa-inbox"></i> You have not received any message! </div>';
                                        document.getElementById("empty").style.display = 'none';
                                      </script> 
                                      <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    $contactsql = "SELECT * FROM `contact`";
    $contactResult = mysqli_query($conn, $contactsql);
    while($contactRow = mysqli_fetch_assoc($contactResult)){
        $contactId = $contactRow['contactId'];
        $Id = $contactRow['userId'];
?>

<div class="modal fade" id="reply<?php echo $contactId; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-dark">
      <div class="modal-header modal-header-dark">
        <h5 class="modal-title font-weight-bold">Reply (Contact Id: <?php echo $contactId; ?>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_contactManage.php" method="post">
            <div class="form-group">
                <label for="message" class="font-weight-bold text-warning">Message:</label>
                <textarea class="form-control form-control-dark" id="message" name="message" rows="4" required minlength="5" placeholder="Type your reply here..."></textarea>
            </div>
            <input type="hidden" id="contactId" name="contactId" value="<?php echo $contactId; ?>">
            <input type="hidden" id="userId" name="userId" value="<?php echo $Id; ?>">
            <button type="submit" class="btn btn-theme btn-block" name="contactReply">Send Reply</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>

<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-dark">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-history mr-2"></i> Sent Message History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="notReply">
                <div class="table-responsive">
                    <table class="table table-bordered table-dark-custom text-center mb-0">
                        <thead>
                            <tr>
                                <th>Contact Id</th>
                                <th>Reply Message</th>
                                <th>Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = "SELECT * FROM `contactreply`"; 
                            $result = mysqli_query($conn, $sql);
                            $totalReply = 0;
                            while($row=mysqli_fetch_assoc($result)) {
                                $contactId = $row['contactId'];
                                $message = $row['message'];
                                $datetime = $row['datetime'];
                                $totalReply++;

                                echo '<tr>
                                        <td>' .$contactId. '</td>
                                        <td>' .$message. '</td>
                                        <td>' .$datetime. '</td>
                                      </tr>';
                            }    

                            if($totalReply==0) {
                              ?>
                              <script> 
                                document.getElementById("notReply").innerHTML = '<div class="alert alert-dark text-center m-3" role="alert"> You have not replied to any message yet! </div>';
                              </script> 
                              <?php
                            }   
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
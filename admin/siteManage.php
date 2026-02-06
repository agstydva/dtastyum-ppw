<style>
    /* Admin Global Style */
    .container-fluid {
        background-color: #121212;
        color: #fff;
        padding-bottom: 50px;
        min-height: 100vh;
    }

    /* Card Styling */
    .card-dark {
        background-color: #1e1e1e;
        border: 1px solid #333;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .card-header-dark {
        background-color: #000;
        border-bottom: 2px solid #ffc107;
        color: #ffc107;
        padding: 20px;
        border-radius: 15px 15px 0 0 !important;
        text-align: center;
    }

    .card-header-dark h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Form Input Styling */
    .form-control-dark {
        background-color: #2d2d2d;
        border: 1px solid #444;
        color: #fff;
        border-radius: 8px;
        height: 45px;
    }

    .form-control-dark:focus {
        background-color: #333;
        color: #fff;
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    .control-label {
        font-weight: 600;
        color: #ffc107;
        margin-bottom: 8px;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    /* Button Styling */
    .btn-theme {
        background-color: #ffc107;
        color: #000;
        font-weight: 800;
        border: none;
        border-radius: 50px;
        padding: 12px 40px;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-theme:hover {
        background-color: #fff;
        color: #000;
        box-shadow: 0 0 15px rgba(255, 193, 7, 0.5);
    }
</style>

<?php
    $sql = "SELECT * FROM `sitedetail`";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $systemName = $row['systemName'];
    $address = $row['address'];
    $email = $row['email'];
    $contact1 = $row['contact1'];
    $contact2 = $row['contact2'];
?>

<div class="container-fluid" style="margin-top:98px">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card card-dark">
                
                <div class="card-header-dark">
                    <h2><i class="fas fa-cogs mr-2"></i> System Settings</h2>
                </div>
                
                <div class="card-body px-4 py-4">
                    <form action="partials/_siteManage.php" method="post">
                        
                        <div class="form-group">
                            <label for="name" class="control-label">System Name</label>
                            <input type="text" class="form-control form-control-dark" id="name" name="name" value="<?php echo $systemName; ?>" required placeholder="Enter System Name">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="control-label">Email Address</label>
                            <input type="email" class="form-control form-control-dark" id="email" name="email" value="<?php echo $email; ?>" required placeholder="Enter Email">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contact1" class="control-label">Contact 1</label>
                                <input type="tel" class="form-control form-control-dark" id="contact1" name="contact1" value="<?php echo $contact1; ?>" required placeholder="Primary Phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact2" class="control-label">Contact 2 <small class="text-muted text-lowercase" style="font-weight:normal;">(Optional)</small></label>
                                <input type="tel" class="form-control form-control-dark" id="contact2" name="contact2" value="<?php echo $contact2; ?>" placeholder="Secondary Phone">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class="control-label">Address</label>
                            <input type="text" class="form-control form-control-dark" id="address" name="address" value="<?php echo $address; ?>" required placeholder="Full Address">
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" name="updateDetail" class="btn btn-theme">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
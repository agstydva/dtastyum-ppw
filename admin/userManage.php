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

    .card-body {
        padding: 20px;
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
    
    .form-control-dark:disabled {
        background-color: #222;
        color: #888;
    }

    .custom-select-dark {
        background-color: #2d2d2d;
        border: 1px solid #444;
        color: #fff;
        border-radius: 8px;
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

<div class="container-fluid" style="margin-top:98px">
    
    <div class="row mb-3">
        <div class="col-lg-12">
            <button class="btn btn-theme float-right btn-sm" data-toggle="modal" data-target="#newUser">
                <i class="fa fa-plus-circle mr-1"></i> New User
            </button>
        </div>
    </div>
        
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-dark">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark-custom table-hover mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>UserId</th>
                                    <th style="width:10%">Photo</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM users"; 
                                    $result = mysqli_query($conn, $sql);
                                    
                                    while($row=mysqli_fetch_assoc($result)) {
                                        $Id = $row['id'];
                                        $username = $row['username'];
                                        $firstName = $row['firstName'];
                                        $lastName = $row['lastName'];
                                        $email = $row['email'];
                                        $phone = $row['phone'];
                                        $userType = $row['userType'];
                                        
                                        $userTypeLabel = ($userType == 0) ? "<span class='badge badge-secondary'>User</span>" : "<span class='badge badge-warning text-dark'>Admin</span>";

                                        echo '<tr>
                                                <td>' .$Id. '</td>
                                                <td>
                                                    <img src="/davaweb/img/person-' .$Id. '.jpg" alt="User" onError="this.src =\'/davaweb/img/profilePic.jpg\'" class="rounded-circle border border-warning" width="50" height="50" style="object-fit:cover;">
                                                </td>
                                                <td class="font-weight-bold">' .$username. '</td>
                                                <td>' .$firstName. ' ' .$lastName. '</td>
                                                <td>' .$email. '</td>
                                                <td>' .$phone. '</td>
                                                <td>' .$userTypeLabel. '</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#editUser' .$Id. '" type="button" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>';
                                                        
                                                        if($Id == 1) {
                                                            echo '<button class="btn btn-sm btn-secondary" disabled title="Cannot delete Super Admin"><i class="fas fa-trash"></i></button>';
                                                        }
                                                        else {
                                                            echo '<form action="partials/_userManage.php" method="POST">
                                                                    <button name="removeUser" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')" title="Delete">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                    <input type="hidden" name="Id" value="'.$Id. '">
                                                                  </form>';
                                                        }

                                        echo '      </div>
                                                </td>
                                            </tr>';
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

<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-dark">
      <div class="modal-header modal-header-dark">
        <h5 class="modal-title font-weight-bold">Create New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_userManage.php" method="post">
              <div class="form-group">
                  <label for="username">Username</label>
                  <input class="form-control form-control-dark" id="username" name="username" placeholder="Unique Username" type="text" required minlength="3" maxlength="11">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control form-control-dark" id="firstName" name="firstName" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control form-control-dark" id="lastName" name="lastName" placeholder="Last name" required>
                </div>
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control form-control-dark" id="email" name="email" placeholder="Email Address" required>
              </div>
              <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Phone No</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border-secondary text-white">+62</span>
                            </div>
                            <input type="tel" class="form-control form-control-dark" id="phone" name="phone" placeholder="8123xxxx" required pattern="[0-9]{10,13}">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="userType">Type</label>
                        <select name="userType" id="userType" class="custom-select custom-select-dark" required>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
              </div>
              <div class="form-group">
                  <label for="password">Password</label>
                  <input class="form-control form-control-dark" id="password" name="password" placeholder="Password" type="password" required minlength="4">
              </div>
              <div class="form-group">
                  <label for="cpassword">Confirm Password</label>
                  <input class="form-control form-control-dark" id="cpassword" name="cpassword" placeholder="Confirm Password" type="password" required minlength="4">
              </div>
              <button type="submit" name="createUser" class="btn btn-theme btn-block mt-3">Create User</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 
    $usersql = "SELECT * FROM `users`";
    $userResult = mysqli_query($conn, $usersql);
    while($userRow = mysqli_fetch_assoc($userResult)){
        $Id = $userRow['id'];
        $name = $userRow['username'];
        $firstName = $userRow['firstName'];
        $lastName = $userRow['lastName'];
        $email = $userRow['email'];
        $phone = $userRow['phone'];
        $userType = $userRow['userType'];
?>

<div class="modal fade" id="editUser<?php echo $Id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-dark">
      <div class="modal-header modal-header-dark">
        <h5 class="modal-title font-weight-bold">Edit User #<?php echo $Id; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row align-items-center mb-4 pb-4 border-bottom border-secondary">
            <div class="col-md-4 text-center">
                <img src="/davaweb/img/person-<?php echo $Id; ?>.jpg" alt="Profile" class="rounded-circle border border-warning" width="80" height="80" onError="this.src ='/davaweb/img/profilePic.jpg'" style="object-fit:cover;">
                <form action="partials/_userManage.php" method="post" class="mt-2">
                    <input type="hidden" name="userId" value="<?php echo $Id; ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm py-0" name="removeProfilePhoto" style="font-size: 0.7rem;">Remove</button>
                </form>
            </div>
            <div class="col-md-8">
                <form action="partials/_userManage.php" method="post" enctype="multipart/form-data">
                    <label class="small text-muted mb-1">Update Photo (.jpg)</label>
                    <input type="file" name="userimage" accept=".jpg" class="form-control form-control-dark p-1" style="height:auto; font-size:0.8rem;" required>
                    <input type="hidden" name="userId" value="<?php echo $Id; ?>">
                    <button type="submit" class="btn btn-success btn-sm mt-2" name="updateProfilePhoto">Upload</button>
                </form>
            </div>
        </div>
        
        <form action="partials/_userManage.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control form-control-dark" name="username" value="<?php echo $name; ?>" type="text" disabled>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control form-control-dark" name="firstName" value="<?php echo $firstName; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control form-control-dark" name="lastName" value="<?php echo $lastName; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-dark" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Phone No</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border-secondary text-white">+62</span>
                        </div>
                        <input type="tel" class="form-control form-control-dark" name="phone" value="<?php echo $phone; ?>" required pattern="[0-9]{10,13}">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="userType">Type</label>
                    <select name="userType" class="custom-select custom-select-dark" required>
                        <option value="0" <?php if($userType==0) echo 'selected'; ?>>User</option>
                        <option value="1" <?php if($userType==1) echo 'selected'; ?>>Admin</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="userId" value="<?php echo $Id; ?>">
            <button type="submit" name="editUser" class="btn btn-theme btn-block mt-3">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>
<style>
    /* Global Styles for Admin Content */
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

    .card-header-dark {
        background-color: #000;
        border-bottom: 2px solid #ffc107;
        color: #ffc107;
        padding: 15px 20px;
        border-radius: 15px 15px 0 0 !important;
    }

    .card-header-dark h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 800;
        text-transform: uppercase;
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

    .control-label {
        font-weight: 600;
        color: #ccc;
        margin-bottom: 5px;
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

    /* Truncate Text */
    .truncate {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: normal !important;
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
    <div class="col-lg-12">
        <div class="row">
            
            <div class="col-md-4">
                <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data">
                    <div class="card card-dark mb-4">
                        <div class="card-header-dark">
                            <h3><i class="fas fa-plus-circle mr-2"></i> Create Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Category Name:</label>
                                <input type="text" class="form-control form-control-dark" name="name" required placeholder="e.g. Pizza">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control form-control-dark" name="desc" rows="3" required placeholder="Short description..."></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="image" class="control-label">Cover Image:</label>
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" accept=".jpg" class="form-control-dark" style="padding: 3px; height: auto;" required>
                                </div>
                                <small id="Info" class="form-text text-muted">Format: .jpg only</small>
                            </div>  
                        </div>  
                        <div class="card-footer" style="background-color: #1e1e1e; border-top: 1px solid #333;">
                            <button type="submit" name="createCategory" class="btn btn-theme btn-block"> Create Category </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 mb-3">
                <div class="card card-dark">
                    <div class="card-header-dark">
                        <h3><i class="fas fa-list mr-2"></i> Category List</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark-custom table-hover mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th style="width:10%;">ID</th>
                                        <th style="width:15%;">Image</th>
                                        <th style="width:50%;">Detail</th>
                                        <th style="width:25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `categories`"; 
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        $catId = $row['categorieId'];
                                        $catName = $row['categorieName'];
                                        $catDesc = $row['categorieDesc'];

                                        echo '<tr>
                                                <td><b>' .$catId. '</b></td>
                                                <td>
                                                    <img src="/davaweb/img/card-'.$catId. '.jpg" alt="Img" class="rounded border border-warning" width="60" height="60" style="object-fit:cover;">
                                                </td>
                                                <td class="text-left">
                                                    <b style="color:#ffc107; font-size:1.1rem;">' .$catName. '</b>
                                                    <p class="truncate mb-0 text-muted" style="font-size:0.85rem;">' .$catDesc. '</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn btn-sm btn-info mr-2" type="button" data-toggle="modal" data-target="#updateCat' .$catId. '" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="partials/_categoryManage.php" method="POST">
                                                            <button name="removeCategory" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <input type="hidden" name="catId" value="'.$catId. '">
                                                        </form>
                                                    </div>
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
</div>

<?php 
    $catsql = "SELECT * FROM `categories`";
    $catResult = mysqli_query($conn, $catsql);
    while($catRow = mysqli_fetch_assoc($catResult)){
        $catId = $catRow['categorieId'];
        $catName = $catRow['categorieName'];
        $catDesc = $catRow['categorieDesc'];
?>

<div class="modal fade" id="updateCat<?php echo $catId; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-dark">
      <div class="modal-header modal-header-dark">
        <h5 class="modal-title font-weight-bold">Edit Category #<?php echo $catId; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data" class="mb-4 pb-4 border-bottom border-secondary">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <img src="/davaweb/img/card-<?php echo $catId; ?>.jpg" id="itemPhoto<?php echo $catId; ?>" class="rounded border border-warning" width="100" height="100" style="object-fit:cover;">
                </div>
                <div class="col-md-8">
                    <label class="control-label">Update Image</label>
                    <input type="file" name="catimage" accept=".jpg" class="form-control form-control-dark p-1" style="height:auto;" 
                           onchange="document.getElementById('itemPhoto<?php echo $catId; ?>').src = window.URL.createObjectURL(this.files[0])" required>
                    <input type="hidden" name="catId" value="<?php echo $catId; ?>">
                    <button type="submit" class="btn btn-warning btn-sm mt-2" name="updateCatPhoto">Upload New Image</button>
                </div>
            </div>
        </form>

        <form action="partials/_categoryManage.php" method="post">
            <div class="form-group">
                <label for="name" class="control-label">Category Name</label>
                <input class="form-control form-control-dark" id="name" name="name" value="<?php echo $catName; ?>" type="text" required>
            </div>
            <div class="form-group">
                <label for="desc" class="control-label">Description</label>
                <textarea class="form-control form-control-dark" id="desc" name="desc" rows="3" required minlength="6"><?php echo $catDesc; ?></textarea>
            </div>
            <input type="hidden" name="catId" value="<?php echo $catId; ?>">
            <button type="submit" class="btn btn-theme btn-block" name="updateCategory">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>
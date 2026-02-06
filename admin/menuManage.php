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

    .custom-select-dark {
        background-color: #2d2d2d;
        border: 1px solid #444;
        color: #fff;
        border-radius: 8px;
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
                <form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
                    <div class="card card-dark mb-4">
                        <div class="card-header-dark">
                            <h3><i class="fas fa-plus-circle mr-2"></i> Create New Item</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input type="text" class="form-control form-control-dark" name="name" required placeholder="Item Name">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea cols="30" rows="3" class="form-control form-control-dark" name="description" required placeholder="Item Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Price (Rp):</label>
                                <input type="number" class="form-control form-control-dark" name="price" required min="1" placeholder="e.g. 50">
                            </div>  
                            <div class="form-group">
                                <label class="control-label">Category:</label>
                                <select name="categoryId" id="categoryId" class="custom-select custom-select-dark" required>
                                    <option hidden disabled selected value>Select Category</option>
                                    <?php
                                        $catsql = "SELECT * FROM `categories`"; 
                                        $catresult = mysqli_query($conn, $catsql);
                                        while($row = mysqli_fetch_assoc($catresult)){
                                            $catId = $row['categorieId'];
                                            $catName = $row['categorieName'];
                                            echo '<option value="' .$catId. '">' .$catName. '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="image" class="control-label">Image:</label>
                                <input type="file" name="image" id="image" accept=".jpg" class="form-control-dark p-1" style="height:auto;" required>
                                <small id="Info" class="form-text text-muted">Format: .jpg only</small>
                            </div>
                        </div>
                        <div class="card-footer" style="background-color: #1e1e1e; border-top: 1px solid #333;">
                            <button type="submit" name="createItem" class="btn btn-theme btn-block"> Create Item </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 mb-3">
                <div class="card card-dark">
                    <div class="card-header-dark">
                        <h3><i class="fas fa-utensils mr-2"></i> Menu List</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark-custom table-hover mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th style="width:7%;">Cat.ID</th>
                                        <th style="width:15%;">Image</th>
                                        <th style="width:55%;">Item Detail</th>
                                        <th style="width:23%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM `pizza` ORDER BY pizzaId DESC";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            $pizzaId = $row['pizzaId'];
                                            $pizzaName = $row['pizzaName'];
                                            $pizzaPrice = $row['pizzaPrice'];
                                            $pizzaDesc = $row['pizzaDesc'];
                                            $pizzaCategorieId = $row['pizzaCategorieId'];

                                            echo '<tr>
                                                    <td><b>' .$pizzaCategorieId. '</b></td>
                                                    <td>
                                                        <img src="/davaweb/img/pizza-'.$pizzaId. '.jpg" alt="Img" class="rounded border border-warning" width="80" height="80" style="object-fit:cover;">
                                                    </td>
                                                    <td class="text-left">
                                                        <b style="color:#ffc107; font-size:1.1rem;">' .$pizzaName. '</b>
                                                        <p class="truncate mb-1 text-muted" style="font-size:0.85rem;">' .$pizzaDesc. '</p>
                                                        <span class="badge badge-light">Rp ' .$pizzaPrice. '.000</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn btn-sm btn-info mr-2" type="button" data-toggle="modal" data-target="#updateItem' .$pizzaId. '" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form action="partials/_menuManage.php" method="POST">
                                                                <button name="removeItem" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\')" title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                                <input type="hidden" name="pizzaId" value="'.$pizzaId. '">
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
    $pizzasql = "SELECT * FROM `pizza`";
    $pizzaResult = mysqli_query($conn, $pizzasql);
    while($pizzaRow = mysqli_fetch_assoc($pizzaResult)){
        $pizzaId = $pizzaRow['pizzaId'];
        $pizzaName = $pizzaRow['pizzaName'];
        $pizzaPrice = $pizzaRow['pizzaPrice'];
        $pizzaCategorieId = $pizzaRow['pizzaCategorieId'];
        $pizzaDesc = $pizzaRow['pizzaDesc'];
?>

<div class="modal fade" id="updateItem<?php echo $pizzaId; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-dark">
      <div class="modal-header modal-header-dark">
        <h5 class="modal-title font-weight-bold">Edit Item #<?php echo $pizzaId; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="partials/_menuManage.php" method="post" enctype="multipart/form-data" class="mb-4 pb-4 border-bottom border-secondary">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <img src="/davaweb/img/pizza-<?php echo $pizzaId; ?>.jpg" id="itemPhoto<?php echo $pizzaId; ?>" class="rounded border border-warning" width="100" height="100" style="object-fit:cover;">
                </div>
                <div class="col-md-8">
                    <label class="control-label">Update Image</label>
                    <input type="file" name="itemimage" accept=".jpg" class="form-control form-control-dark p-1" style="height:auto;" 
                           onchange="document.getElementById('itemPhoto<?php echo $pizzaId; ?>').src = window.URL.createObjectURL(this.files[0])" required>
                    <input type="hidden" name="pizzaId" value="<?php echo $pizzaId; ?>">
                    <button type="submit" class="btn btn-warning btn-sm mt-2" name="updateItemPhoto">Upload New Image</button>
                </div>
            </div>
        </form>

        <form action="partials/_menuManage.php" method="post">
            <div class="form-group">
                <label for="name" class="control-label">Name</label>
                <input class="form-control form-control-dark" id="name" name="name" value="<?php echo $pizzaName; ?>" type="text" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="price" class="control-label">Price</label>
                    <input class="form-control form-control-dark" id="price" name="price" value="<?php echo $pizzaPrice; ?>" type="number" min="1" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="catId" class="control-label">Category ID</label>
                    <input class="form-control form-control-dark" id="catId" name="catId" value="<?php echo $pizzaCategorieId; ?>" type="number" min="1" required>
                </div>
            </div>
            <div class="form-group">
                <label for="desc" class="control-label">Description</label>
                <textarea class="form-control form-control-dark" id="desc" name="desc" rows="3" required minlength="6"><?php echo $pizzaDesc; ?></textarea>
            </div>
            <input type="hidden" name="pizzaId" value="<?php echo $pizzaId; ?>">
            <button type="submit" class="btn btn-theme btn-block" name="updateItem">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>
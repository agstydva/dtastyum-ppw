<?php 
    // Pastikan variabel $userId tersedia
    if(isset($userId)) {
        $itemModalSql = "SELECT * FROM `orders` WHERE `userId`= $userId";
        $itemModalResult = mysqli_query($conn, $itemModalSql);
        while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
            $orderid = $itemModalRow['orderId'];
    
?>

<style>
    /* Modal Content Dark */
    .modal-content-dark {
        background-color: #1e1e1e;
        color: #fff;
        border: 1px solid #333;
        border-radius: 15px;
    }
    
    .modal-header-dark {
        background-color: #000;
        border-bottom: 1px solid #333;
        border-radius: 15px 15px 0 0;
        padding: 20px;
    }

    .modal-title-custom {
        color: #ffc107;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Table Item Styling */
    .table-item-dark {
        width: 100%;
        color: #e0e0e0;
    }

    .table-item-dark thead th {
        border-top: none;
        border-bottom: 2px solid #444;
        color: #ffc107;
        font-size: 0.9rem;
        text-transform: uppercase;
        padding: 15px;
    }

    .table-item-dark tbody td {
        border-top: 1px solid #333;
        vertical-align: middle;
        padding: 15px;
    }

    /* Item Details */
    .item-img-container {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #333;
        float: left;
        margin-right: 15px;
    }

    .item-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-name {
        font-weight: 700;
        color: #fff;
        font-size: 1.1rem;
        text-decoration: none;
        display: block;
        margin-top: 5px;
    }
    
    .item-name:hover {
        color: #ffc107;
        text-decoration: none;
    }

    .item-price {
        color: #aaa;
        font-size: 0.9rem;
        font-style: italic;
    }

    .qty-badge {
        background-color: #333;
        color: #ffc107;
        padding: 5px 12px;
        border-radius: 5px;
        font-weight: 700;
        font-size: 1rem;
        border: 1px solid #444;
    }
</style>

<div class="modal fade" id="orderItem<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderItem<?php echo $orderid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-dark">
            
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title modal-title-custom" id="orderItem<?php echo $orderid; ?>">
                    <i class="fas fa-shopping-bag mr-2"></i> Items In Order #<?php echo $orderid; ?>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-item-dark mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="pl-4">Item Details</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-right pr-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mysql = "SELECT * FROM `orderitems` WHERE orderId = $orderid";
                                $myresult = mysqli_query($conn, $mysql);
                                while($myrow = mysqli_fetch_assoc($myresult)){
                                    $pizzaId = $myrow['pizzaId'];
                                    $itemQuantity = $myrow['itemQuantity'];
                                    
                                    $itemsql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
                                    $itemresult = mysqli_query($conn, $itemsql);
                                    $itemrow = mysqli_fetch_assoc($itemresult);
                                    
                                    $pizzaName = $itemrow['pizzaName'];
                                    $pizzaPrice = $itemrow['pizzaPrice'];
                                    $pizzaDesc = $itemrow['pizzaDesc'];
                                    $subTotal = $pizzaPrice * $itemQuantity;

                                    echo '<tr>
                                            <td class="pl-4">
                                                <div class="item-img-container">
                                                    <img src="img/pizza-'.$pizzaId. '.jpg" class="item-img" alt="'.$pizzaName.'" onerror="this.src=\'img/pizza-default.jpg\';">
                                                </div>
                                                <div class="d-inline-block align-middle pt-2">
                                                    <a href="viewPizza.php?pizzaid='.$pizzaId.'" class="item-name">'.$pizzaName.'</a>
                                                    <span class="item-price">Price: Rp '.$pizzaPrice.'.000</span>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="qty-badge">x ' .$itemQuantity. '</span>
                                            </td>
                                            <td class="align-middle text-right pr-4 text-warning font-weight-bold">
                                                Rp ' .$subTotal. '.000
                                            </td>
                                          </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="modal-footer border-top-0" style="border-top: 1px solid #333 !important; padding: 15px;">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php
        } // End While
    } // End If
?>
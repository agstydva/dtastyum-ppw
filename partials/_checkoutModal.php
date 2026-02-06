<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #1e1e1e; color: #fff; border: 1px solid #333; border-radius: 15px;">
            
            <div class="modal-header" style="background-color: #000; border-bottom: 1px solid #333; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title font-weight-bold text-uppercase" style="color: #ffc107; letter-spacing: 1px;">
                    <i class="fas fa-shipping-fast mr-2"></i> Confirm Order
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-4 py-4">
                <form action="partials/_manageCart.php" method="post">
                    
                    <div class="form-group">
                        <label for="address" class="font-weight-bold text-warning small text-uppercase">Delivery Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <input class="form-control" id="address" name="address" placeholder="e.g. Jl. Pemuda No. 123" type="text" required minlength="3" maxlength="500"
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address1" class="font-weight-bold text-warning small text-uppercase">Address Line 2 (Optional)</label>
                        <input class="form-control" id="address1" name="address1" placeholder="e.g. Near Indomaret / Blok C" type="text"
                               style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone" class="font-weight-bold text-warning small text-uppercase">Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;">+62</span>
                                </div>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="8123xxxx" required pattern="[0-9]{10,13}"
                                       style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zipcode" class="font-weight-bold text-warning small text-uppercase">Zip Code</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="xxxxx" required pattern="[0-9]{5}" maxlength="5"
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="password" class="font-weight-bold text-warning small text-uppercase">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;"><i class="fas fa-lock"></i></span>
                            </div>
                            <input class="form-control" id="password" name="password" placeholder="Enter password to verify" type="password" required minlength="4"
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                        <small class="text-muted">Required to complete the purchase.</small>
                    </div>

                    <div class="modal-footer border-0 px-0 pb-0 mt-4">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-dismiss="modal" style="color: #ccc; border-color: #666;">Cancel</button>
                        
                        <input type="hidden" name="amount" value="<?php echo $totalPrice ?>">
                        
                        <button type="submit" name="checkout" class="btn font-weight-bold rounded-pill px-5" style="background-color: #ffc107; color: #000; border: none; box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);">
                            Place Order
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        background-color: #333 !important;
        color: #fff !important;
        border-color: #ffc107 !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25) !important;
    }
</style>
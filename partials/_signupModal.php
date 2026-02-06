<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-color: #1e1e1e; color: #fff; border: 1px solid #333; border-radius: 15px;">
            
            <div class="modal-header" style="background-color: #000; border-bottom: 1px solid #333; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title font-weight-bold text-uppercase" style="color: #ffc107; letter-spacing: 1px;">
                    <i class="fas fa-user-plus mr-2"></i> Create Account
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-4 py-4">
                
                <div class="text-center mb-4">
                    <img class="rounded-circle shadow" src="img/D-logo.jpg" alt="Logo" style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #ffc107; padding: 2px; background: #1e1e1e;">
                    <h5 class="font-weight-bold mt-2">Join Dtastyum</h5>
                </div>

                <form action="partials/_handleSignup.php" method="post">
                    
                    <div class="form-group">
                        <label for="username" class="font-weight-bold text-warning small text-uppercase">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;">@</span>
                            </div>
                            <input class="form-control" id="username" name="username" placeholder="Choose a unique username" type="text" required
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName" class="font-weight-bold text-warning small text-uppercase">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName" class="font-weight-bold text-warning small text-uppercase">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email" class="font-weight-bold text-warning small text-uppercase">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required
                                       style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone" class="font-weight-bold text-warning small text-uppercase">Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;">+62</span>
                                </div>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="8123xxxx" required maxlength="12"
                                       style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password" class="font-weight-bold text-warning small text-uppercase">Password</label>
                            <input class="form-control" id="password" name="password" placeholder="Create Password" type="password" required minlength="4"
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpassword" class="font-weight-bold text-warning small text-uppercase">Confirm Password</label>
                            <input class="form-control" id="cpassword" name="cpassword" placeholder="Repeat Password" type="password" required minlength="4"
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                            <small id="passMsg" class="form-text text-muted">Make sure passwords match.</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block font-weight-bold shadow-sm mt-3" style="background-color: #ffc107; color: #000; border-radius: 50px; padding: 12px;">
                        REGISTER
                    </button>

                </form>

                <div class="text-center mt-4 pt-2 border-top border-secondary">
                    <p class="mb-0 text-muted small">Already have an account?</p>
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal" class="text-warning font-weight-bold" style="text-decoration: none;">
                        Login here <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
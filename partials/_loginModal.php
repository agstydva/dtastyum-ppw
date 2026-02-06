<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #1e1e1e; color: #fff; border: 1px solid #333; border-radius: 15px;">
            
            <div class="modal-header" style="background-color: #000; border-bottom: 1px solid #333; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title font-weight-bold text-uppercase" style="color: #ffc107; letter-spacing: 1px;">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-4 py-4">
                <div class="text-center mb-4">
                    <img class="rounded-circle shadow" src="img/D-logo.jpg" alt="Logo" style="width: 90px; height: 90px; object-fit: cover; border: 3px solid #ffc107; padding: 2px; background: #1e1e1e;">
                    <h4 class="font-weight-bold mt-3 mb-0">Dtastyum</h4>
                    <p class="text-muted small">Welcome back! Please login to continue.</p>
                </div>

                <form action="partials/_handleLogin.php" method="post">
                    
                    <div class="form-group mb-3">
                        <label for="loginusername" class="font-weight-bold text-warning small text-uppercase">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" id="loginusername" name="loginusername" placeholder="Enter your username" type="text" required 
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="loginpassword" class="font-weight-bold text-warning small text-uppercase">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;"><i class="fas fa-lock"></i></span>
                            </div>
                            <input class="form-control" id="loginpassword" name="loginpassword" placeholder="Enter your password" type="password" required data-toggle="password"
                                   style="background-color: #2d2d2d; border: 1px solid #444; color: #fff;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block font-weight-bold shadow-sm" style="background-color: #ffc107; color: #000; border-radius: 50px; padding: 12px;">
                        LOGIN
                    </button>

                </form>

                <div class="text-center mt-4 pt-2 border-top border-secondary">
                    <p class="mb-0 text-muted small">Don't have an account?</p>
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signupModal" class="text-warning font-weight-bold" style="text-decoration: none;">
                        Sign up now <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

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
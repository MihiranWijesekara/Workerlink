
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Worker Link &middot; Sign In</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- content -->
    <div class="container-fluid vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="col-12 border rounded">
                    <div class="row g-0">

                        <!-- image -->
                        <div class="col-lg-6 d-none col-md-6 d-md-block position-relative">
                            <div class="img-fluid1"></div>
                            <div class="position-absolute top-0 start-0 w-100 h-100 overlay"></div>
                        </div>
                        <!-- image end -->

                        <!-- view -->
                        <div class="col-md-6 my-3">
                            <div class="card-body">
                                <div class="text-center">
                                    <a href="index.php" class="text-text-decoration-none">
                                        <img class="logo rounded-circle" src="img/el.jpg" />
                                    </a>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-4">
                                <div class="col-11 form-floating">
                                    <div class="row">
                                        <div id="msgdiv" class="d-none col-12">
                                        </div>
                                        <?php

                                        $e = "";
                                        $p = "";

                                        if (isset($_COOKIE["email"])) {
                                            $e = $_COOKIE["email"];
                                        }

                                        if (isset($_COOKIE["password"])) {
                                            $p = $_COOKIE["password"];
                                        }

                                        ?>
                                        <div class="col-12 mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email" value="<?php echo ($e); ?>" placeholder="yourname@gmail.com" />
                                                <label for="email">Email address</label>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="ps" value="<?php echo ($p); ?>" placeholder="Password" />
                                                <label for="ps">Password</label>
                                            </div>
                                        </div>

                                        <div class="offset-lg-1 col-12 col-lg-10 my-3">
                                            <div class="text-center d-grid">
                                                <button class="btn btn-primary btn-block fw-bold" type="button" onclick="signin();">Sign In</button>
                                            </div>
                                        </div>

                                        <div class="offset-lg-1 col-12 col-lg-10 mb-5">
                                            <div class="text-center d-grid">
                                                <button class="btn btn-dark btn-block fw-bold" type="button" onclick="redirectedSignup();">Don't have an account? Register</button>
                                            </div>
                                        </div>

                                        <div class="col-6 text-start ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rm"/>
                                                <label class="form-check-label text-decoration-none small text-muted fw-bold fs-6 text-start cursor" for="rm">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-6 text-end">
                                            <a class="text-decoration-none small text-primary-emphasis fw-bold fs-6 text-start pe-2" href="#" onclick="forgotpassword();"> Forgotten Password? </a>
                                        </div>

                                        <div class="col-12 text-center text-muted mt-5 pt-3 tb">
                                            Copyright &copy; 2023 <b> Worker Link </b> Pvt Ltd. || All Rights Reserved.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- view end -->

                        </div>
                    </div>
                    <!-- modal -->
                    <div class="modal" tabindex="-1" id="forgotps">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black fw-bold">Forgot Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-none col-12 alert alert-danger" id="msg"></div>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label for="nps" class="fw-bold text-muted mb-2">New Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="nps" />
                                                <button class="btn btn-outline-secondary" id="np" onclick="pshow();"><i class="bi bi-eye"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="rps" class="fw-bold text-muted mb-2">Retype New Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="rps" />
                                                <button class="btn btn-outline-secondary" id="rp" onclick="psshow2();"><i class="bi bi-eye"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="vps" class="fw-bold text-muted mb-2">Email Varification Code</label>
                                            <div class="input-group mb-3">
                                                <button class="text-text-muted fs-5 fw-bold" for="np" disabled>WL &ndash; </button>
                                                <input type="text" class="form-control" id="vps" placeholder="XXXXXXXXXXXXX" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" onclick="resetpassword();">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal end -->
                </div>
            </div>
        </div>
    </div>
    <!-- content End -->
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>
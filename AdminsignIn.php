<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Worker Link &middot; Admin Sign In</title>
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
                            <div class="row justify-content-center align-items-center h-50 mt-5 mb-4">
                                <div class="col-11 form-floating">
                                    <div class="row">
                                        <div id="msgdiv" class="d-none alert alert-danger col-12"></div>
                                        <div class="col-12 my-2">
                                            <label for="ademail" class="fw-bold text-muted mb-2">Email Address</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text p-2">
                                                    <i class="bi bi-person-circle fs-5 fw-bold px-1 text-danger"></i>
                                                </span>
                                                <input type="text" class="form-control p-2" id="ademail" placeholder="Enter Your Email Address" />
                                            </div>
                                        </div>
                                        <div class="col-12 my-2 d-none" id="evc">
                                            <label for="avc" class="fw-bold text-muted mb-2">Varification Code</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text text-success fs-6 fw-bold p-2 border border-end-0 bg-secondary-subtle" for="np">WL &ndash;</span>
                                                <input type="password" class="form-control border-start-0" id="avc" placeholder="XXXXXXXXXXXXX" />
                                            </div>
                                        </div>
                                        <div class="offset-lg-1 col-12 col-lg-10 my-3">
                                            <div class="d-grid text-center" id="vcb">
                                                <button class="btn btn-dark btn-block fw-bold" type="button" onclick="adminvc();">Get Verification Code</button>
                                            </div>
                                            <div class="d-grid text-center my-4 d-none" id="sib">
                                                <button class="btn btn-primary btn-block fw-bold" type="button" onclick="adminSignIn();">Sign In</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- view end -->
                            </div>
                            <div class="col-12 text-center text-muted">
                                Copyright &copy; 2023 <b> Worker Link </b> Pvt Ltd. || All Rights Reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content End -->
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Link | Home</title>
    <link rel="icon" href="img/el.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php require('header.php'); ?>
    <div class="container-fluid w-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- carousel -->
            <div id="carouselExampleCaptions" class="carousel slide col-12 px-4 mt-4" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner" style="height:560px;">
                    <div class="carousel-item active" data-bs-interval="2000">
                        <img src="img/001.jpg" class="d-block w-100" />
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="img/002.jpg" class="d-block w-100" />
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="img/003.png" class="d-block w-100" />
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>
    <i class="bi bi-chat-dots-fill fixed-icon" onclick="chatIconClick();" id="chatIcon"></i>
    <div class="chat-container" id="chatBotContent">
        <div class="chat-header">
            Custom Chatbot
            <i id="cancelIcon" style="color: red; font-size: 25px; margin-left: 100px; margin-bottom: 200px; font-weight: bold;" class="bi bi-x"></i>
        </div>
        <div class="chat-box" id="chatBox"></div>
        <div class="chat-input">
            <input class="chatInput" type="text" id="userInput" placeholder="Type your message...">
            <button class="chatButton" onclick="sendMessage()">Send</button>
        </div>
    </div>

    <!-- carousel End -->

    <!--section strart-->
    <section id="learn" class="p-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md">
                    <img src="img/About.jpg" class="img-fluid" alt="" />
                </div>

                <div class="col-md p-5">
                    <h2>Best Service Providers In Your Area</h2>
                    <p class="lead">
                        If you are looking for carpenters, electricians ,,home maidens , mansonries , welders , water mechanics or plumbers

                    </p>
                    <p>
                        We are here for you !!!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--section end-->

    <!--Boxes-->
    <div class="about-1">
        <h1>ABOUT US</h1>
        <hr>
        <p>Worklink is the bridge between skilled workers and those in need of their expertise. Our platform simplifies the process of finding and offering services, empowering individuals to thrive in the ever-changing job market. With a commitment to innovation and inclusivity, we're reshaping the way people work and connect, one opportunity at a time
        </p>
    </div>
    <section class="p-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-dark text-light w-100 h-100">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="fa fa-book"></i>
                            </div>
                            <h3 class="card-title mb-3">
                                MISSION
                            </h3>
                            <p class="card-text ">
                                Our mission is to build a platform that connects workers with customers in a transparent, efficient, and fair manner, enabling seamless collaboration and unlocking the full potential of the global workforce

                            </p>
                            <a href="#" class="btn btn-primary">Read More</a>

                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card bg-secondary text-light w-100 h-100">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="fa fa-globe"></i>
                            </div>
                            <h3 class="card-title mb-3">
                                VISION
                            </h3>
                            <p class="card-text ">
                                To create a world where every individual has access to meaningful work opportunities, fostering personal growth, economic stability, and social inclusion

                            </p>
                            <a href="#" class="btn btn-primary">Read More</a>

                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-dark text-light w-100 h-100">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <h3 class="card-title mb-3">
                                ACHIVEMENTS
                            </h3>
                            <p class="card-text">
                                Promote diversity in workforce participation. <br>
                                Create numerous job opportunities. <br>
                                Maintain high customer satisfaction. <br>
                                Reduce carbon footprint with remote work options

                            </p>
                            <a href="#" class="btn btn-primary">Read More</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--------------Our Services--------------------------------->
    <section>
        <div class=" container">
            <h1 class="text-center mt-3 display-3  fw-bold">Our Services</h1>
            <hr>
            <p class="text-center  text-muted">We provide best services to our customer.</p>
            <div class="row my-5">
                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/carpenter.png" style="color: #000;" width="50" height="40">
                            <h3>Carpenter</h3>
                            <p>Transforming spaces with the artistry of wood</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/electrician.png" style="color: #000;" width="50" height="40">
                            <h3>Electricion</h3>
                            <p>Shocking excellence in every wire we lay!</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/mop.png" style="color: #000;" width="50" height="40">
                            <h3>Home Maiden</h3>
                            <p>Immaculate homes, expert maidens.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/plumber.png" style="color: #000;" width="50" height="40">
                            <h3>Plumber</h3>
                            <p>Your plumbing solution, swift and reliable.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/mop.png" style="color: #000;" width="50" height="40">
                            <h3>worker</h3>
                            <p>Immaculate homes, expert maidens.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/masonry.png" style="color: #000;" width="50" height="40">
                            <h3>Masonry</h3>
                            <p>Turning stone and mortar into art.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/piston.png" style="color: #000;" width="50" height="40">
                            <h3>Motor Mechanic</h3>
                            <p>Smooth rides start here. Let's get under the hood!</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 m-auto">
                    <div class="card border-0 shadow text-center my-3  w-100 h-100">
                        <div class="card-body">
                            <img src="img/welder.png" style="color: #000;" width="50" height="40">
                            <h3>Welder</h3>
                            <p>Ignite efficiency with our powerful motor welders</p>
                        </div>
                    </div>
                </div>
    </section>
    <!--------------Our Services--------------------------------->

    <!--customer review start-->
    <section id="instructors" class="p-5 bgm">
        <div class="container">
            <h2 class="text-center text-white">Customer Review</h2>
            <p class="lead text-center text-white mb-5">
                WHAT THEY SAY
            </p>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/men/11.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3 text-dark">John Doe</h3>
                            <p class="card-text text-dark"> I've had a perfect experience with the website. I totally reccomend this for carpenting service. </p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/11.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3 text-dark">Jane Doe</h3>
                            <p class="card-text text-dark"> I had such a great service and it was for very reasonable price too.Thank you for the amazing service. 10/10 </p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/men/12.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3 text-dark">Steve Smith</h3>
                            <p class="card-text text-dark"> I found a qulified and suitable babysitter through this website. I reccomend this website from my personal experince. </p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3 text-dark">Sara Smith</h3>
                            <p class="card-text text-dark"> I got a service through this website and it was better experience than before.100% reccomend. </p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--customer review end--->

    <div id="contactUsContent">
        <?php include('contctus.php') ?>
    </div>

    <?php include('footer.php') ?>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
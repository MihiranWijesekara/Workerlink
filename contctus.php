<!---------contctus.php----------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .bi20 {
            font-size: 50px !important;
        }

        .bi20:hover {
            color: #0d6efd !important;
        }

        .card {
            cursor: pointer;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .bgm {
            color: white;
            top: -142px;
            height: 80vh;
        }

        .card-row {
            position: relative;
            top: 110px;
        }

        .back-container {

            position: relative;
            top: 100px;
        }

        .btn-secondary {
            padding: 10px;
            width: 100px;
            border: none;
            background-color: white;
            color: black;
        }

        .form-control {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border: none;
            border-radius: 0;
        }


        .text-contact {
            font-size: 40px;
        }

        .border-danger {
            border-color: aliceblue !important;
        }
    </style>
</head>

<body>
    <div id="msg" class="d-none alert alert-danger"></div>

    <div class="container ">
        <div class="row row-cols-1 row-cols-md-4 g-4 card-row">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi20 bi-buildings-fill"></i>
                        <h5 class="card-title">Our Main Office</h5>
                        <p class="card-text">No : 444/B, Galle Road, Matara.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi20 bi-phone-vibrate-fill"></i>
                        <h5 class="card-title">Our Contact</h5>
                        <p class="card-text">+94 70 311 249 6</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi20 bi-envelope-at-fill"></i>
                        <h5 class="card-title">Our Mail</h5>
                        <p class="card-text"> WorkerLink@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi20 bi-facebook"></i>
                        <h5 class="card-title">Our Facebook </h5>
                        <p class="card-text">WorkerLink</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="bgm">
        <div class="container py-5 back-container">
            <div class="row row-cols-1 row-cols-md-2 g-4 ">
                <div class="col">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Your name</label>
                        <input type="email" class="form-control" id="cName">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Email address</label>
                        <input type="email" class="form-control" id="cEmail">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Any Message</label>
                        <textarea class="form-control" id="cMessage" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-secondary" onclick="contactUs();">Send..</button> 
                    </div>
                </div>

                <div class="col">
                    <p class="text-contact">Get in Touch</p>
                    <div class="mt-3">
                        <p>Have a question or ready to get started? Drop us a line! Our team is here to help you every step of the way, from answering inquiries to bringing your ideas to fruition. Let's build something amazing together!</p>
                    </div>
                    <div class="mt-3">
                        <p>contact us today !!!</p>
                    </div>
                    <div class="mt-3">
                        <i>Get to direction</i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="bootstrap.bundle.js"></script>   
     <script src="script.js"></script>
</body>

</html>

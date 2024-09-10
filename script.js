function redirectedSignin() {
    location.replace("signIn.php");
}

function redirectedSignup() {
    location.replace("signUp.php");
}

function showWorkerdetail() {
    var act = document.getElementById("at");
    var cvd = document.getElementById("cvd");

    if (act.value == "1") {
        cvd.classList.toggle("d-none");
    } else {
        cvd.classList.add("d-none");
    }
}

function signup() {
    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var ps = document.getElementById("ps");
    var rps = document.getElementById("rps");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gen");
    var at = document.getElementById("at");
    var ct = document.getElementById("ct");
    var cv = document.getElementById("wcv");

    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("ps", ps.value);
    f.append("rps", rps.value);
    f.append("mobile", m.value);
    f.append("gen", g.value);
    f.append("at", at.value);
    f.append("ct", ct.value);
    f.append("wcv", cv.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            document.getElementById("msgdiv").className = "d-block";

            if (t == "success") {
                document.getElementById("msgdiv").className = "alert alert-success";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-check2-circle pe-3"></i> Sign Up Process Successfully!';
            } else {
                document.getElementById("msgdiv").className = "alert alert-danger";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-exclamation-circle pe-3"></i>' + t;
            }
        }
    }
    r.open("POST", "signUpProcess.php", true);
    r.send(f);
}

function signin() {

    var e = document.getElementById("email");
    var p = document.getElementById("ps");
    var r = document.getElementById("rm");

    var f = new FormData();
    f.append("e", e.value);
    f.append("p", p.value);
    f.append("r", r.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "u") {
                window.location = "userMainView.php";
            } else if(t == "update"){
                window.location = "userProfile.php";
            } else if (t == "w") {
                window.location = "wokerMainView.php";
            } else {
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-exclamation-circle pe-3"></i>' + t;
                document.getElementById("msgdiv").className = "alert alert-danger mb-3";
                if (t == "Deactivate") {
                    document.getElementById("msgdiv").className = "alert alert-warning mb-3";
                    document.getElementById("msgdiv").innerHTML = '<i class="bi bi-person-fill-lock fs-5 pe-3"></i>' + "Your Account is Currently Inactive. Please Wait Or Contact Customer Care Service";
                } else if (t == "Prohibit") {
                    document.getElementById("msgdiv").innerHTML = '<i class="bi bi-person-fill-slash fs-5 pe-3"></i>' + "<b>Your Account Prohibited And Access Denied.</b>";
                }
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);
}

var fbm;
function forgotpassword() {

    var e = document.getElementById("email");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            document.getElementById("msgdiv").className = "d-block";

            if (t == "success") {
                document.getElementById("msg").className = "d-none";
                var mo = document.getElementById("forgotps");
                fbm = new bootstrap.Modal(mo);
                fbm.show();

            } else if (t == "1") {
                document.getElementById("msgdiv").className = "alert alert-warning mb-4";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-person-fill-lock fs-5 pe-3"></i>' + "Your Account is Currently Inactive. Please Wait Or Contact Customer Care Service";
            } else if (t == "3") {
                document.getElementById("msgdiv").className = "alert alert-danger mb-4";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-person-fill-slash fs-5 pe-3"></i>' + "<b>Your Account Prohibited And Access Denied.</b>";
            } else {
                document.getElementById("msgdiv").className = "alert alert-danger mb-4";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-exclamation-circle pe-3"></i>' + t;
            }
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + e.value, true);
    r.send();

}

function pshow() {
    var nps = document.getElementById("nps");
    var np = document.getElementById("np");

    if (nps.type == "password") {
        nps.type = "text";
        np.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        nps.type = "password";
        np.innerHTML = '<i class="bi bi-eye"></i>';
    }
}


function psshow2() {
    var rps = document.getElementById("rps");
    var rp = document.getElementById("rp");

    if (rps.type == "password") {
        rps.type = "text";
        rp.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        rps.type = "password";
        rp.innerHTML = '</i><i class="bi bi-eye"></i>';
    }
}
function psview() {
    var ps = document.getElementById("ps");
    var p = document.getElementById("psi");

    if (ps.type == "password") {
        ps.type = "text";
        p.innerHTML = '<i class="bi bi-eye-slash text-white"></i>';
    } else {
        ps.type = "password";
        p.innerHTML = '</i><i class="bi bi-eye text-white"></i>';
    }
}

function resetpassword() {

    var e = document.getElementById("email");
    var npw = document.getElementById("nps");
    var rpw = document.getElementById("rps");
    var evc = document.getElementById("vps");

    var f = new FormData();
    f.append("e", e.value);
    f.append("np", npw.value);
    f.append("rp", rpw.value);
    f.append("vc", evc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                alert("Change Your New Password");
                npw.value = "";
                rpw.value = "";
                evc.value = "";
                fbm.hide();
                window.location.reload();
            } else {
                document.getElementById("msg").className = "d-block alert alert-danger";
                document.getElementById("msg").innerHTML = '<i class="bi bi-exclamation-circle pe-3"></i>' + t;
            }
        }
    }

    r.open("POST", "restPasswordProcess.php", true);
    r.send(f);

}

function signout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "signIn.php";
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "signOutProcess.php", true);
    r.send();
}

function updateProfile() {

    var pimg = document.getElementById("pimg");
    var nic = document.getElementById("nic");
    var ps = document.getElementById("ps");
    var a1 = document.getElementById("line1");
    var a2 = document.getElementById("line2");
    var pro = document.getElementById("province");
    var d = document.getElementById("district");
    var c = document.getElementById("city");
    var pc = document.getElementById("pc");
    var pay = document.getElementById("pay");
    var disc = document.getElementById("dis");

    var r = new XMLHttpRequest();

    var f = new FormData();

    f.append("pi", pimg.files[0]);
    f.append("n", nic.value);
    f.append("p", ps.value);
    f.append("ad1", a1.value);
    f.append("ad2", a2.value);
    f.append("pr", pro.value);
    f.append("d", d.value);
    f.append("c", c.value);
    f.append("pc", pc.value);
    f.append("pay", pay.value);
    f.append("dis", disc.value);


    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "Ok") {
                signout();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

function updateUserProfile() {
    var pimg = document.getElementById("pimg");
    var nic = document.getElementById("nic");
    var ps = document.getElementById("ps");
    var a1 = document.getElementById("line1");
    var a2 = document.getElementById("line2");
    var pro = document.getElementById("province");
    var d = document.getElementById("district");
    var c = document.getElementById("city");
    var pc = document.getElementById("pc");

    var r = new XMLHttpRequest();

    var f = new FormData();


    f.append("pi", pimg.files[0]);
    f.append("n", nic.value);
    f.append("p", ps.value);
    f.append("ad1", a1.value);
    f.append("ad2", a2.value);
    f.append("pr", pro.value);
    f.append("d", d.value);
    f.append("c", c.value);
    f.append("pc", pc.value);



    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "Ok") {
                signout();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "updateUserprofileprocess.php", true);
    r.send(f);

}

function adminvc() {

    var email = document.getElementById("ademail").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                document.getElementById("evc").classList.toggle("d-none");
                document.getElementById("vcb").classList.toggle("d-none");
                document.getElementById("sib").classList.toggle("d-none");
            } else {

                document.getElementById("msgdiv").className = "alert alert-danger";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-exclamation-circle pe-3"></i>' + t;
            }
        }
    }

    r.open("GET", "adminSignInProccess.php?email=" + email, true);
    r.send();
}

function adminSignIn() {

    var email = document.getElementById("ademail");
    var advc = document.getElementById("avc");

    var r = new XMLHttpRequest();

    var f = new FormData();

    f.append("email", email.value);
    f.append("advc", advc.value);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "ok") {
                window.location = "admin.php";
            } else {
                // alert(t);
                document.getElementById("msgdiv").className = "alert alert-danger";
                document.getElementById("msgdiv").innerHTML = '<i class="bi bi-exclamation-circle pe-3"></i>' + t;
            }
        }
    }
    r.open("POST", "adminLoginProcess.php", true);
    r.send(f);
}

// var email = document.getElementById("email");

// var r = new XMLHttpRequest();

// var f = new FormData();

// f.append("email", email.value);
// r.onreadystatechange = function () {

// }
// r.open("POST", "delete_user.php", true);
// r.send(f);


function AdCustomersearch() {
    var search = document.getElementById("Searchcustomer").value;

    if (search == "") {
        alert("please Enter Customer Email");
    } else {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                var t = r.responseText;

                if (t == "Invalid Email") {
                    alert("Invalid Email");
                } else {
                    document.getElementById("customerTableBody").innerHTML = "";
                    document.getElementById("customerTableBody").innerHTML = r.responseText;
                }
            }
        }
        r.open("GET", "customerSearch.php?se=" + search, true);
        r.send();
    }

}

function deactivateCustomerAcc(x, checkbox) {
    console.log("Deactivating customer with mobile: " + x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            console.log("Response status: " + r.status);
            console.log("Response text: " + r.responseText);

            if (r.status == 200) {
                var t = r.responseText;

                if (t == "success") {
                    console.log("Deactivation successful");


                    localStorage.setItem('switchState_' + x, checkbox.checked);
                } else {
                    console.log("Deactivation failed. Server response: " + t);

                    if (t.trim() === "") {
                        console.log("Server response is empty");
                    } else {
                        console.log("Additional details: " + t);
                    }


                    checkbox.checked = !checkbox.checked;
                }
            } else {
                console.log("Error: " + r.statusText);
            }
        }
    }

    r.open("GET", "CustomerDeactivateProcess.php?m=" + x, true);
    r.send();
}


function AdminWorkermanageload() {
    AdminWorkerloadCategory();
    AdminWorkershowpageination();
}

function AdminWorkerloadCategory() {

    var Category = document.getElementById("selectcate").value;

    var r = new XMLHttpRequest();

    if (Category == "0") {
        window.location.reload();
    }

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {

            document.getElementById("wdtable").innerHTML = "";
            document.getElementById("wdtable").innerHTML = r.responseText;
        }
    }

    r.open("GET", "loadAdminWorkerCategoryProccess.php?c=" + Category, true);
    r.send();
}
function AdminWorkershowpageination() {

    var Category = document.getElementById("selectcate").value;
    var pageMoveDiv = document.getElementById("pageMove");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            pageMoveDiv.innerHTML = "";
            pageMoveDiv.innerHTML = r.responseText;
        }
    }

    r.open("GET", "ShowpageinationAdminWorkerProccess.php?c=" + Category, true);
    r.send();
}

function AdminWorkersearch() {
    var search = document.getElementById("SearchWork").value;

    if (search == "") {
        alert("Please Enter Worker email");
    } else {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {

                var t = r.responseText;

                if (t == "Invalid Email") {
                    alert("Invalid Email");
                } else {
                    document.getElementById("wdtable").innerHTML = "";
                    document.getElementById("wdtable").innerHTML = r.responseText;
                }
            }
        }

        r.open("GET", "SearchAdminWorkerProceess.php?se=" + search, true);
        r.send();
    }
}


function DeactivateWorkerAdminAcc(x, checkbox) {
    console.log("Deactivating worker with mobile: " + x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            console.log("Response status: " + r.status);
            console.log("Response text: " + r.responseText);

            if (r.status == 200) {
                var t = r.responseText;

                if (t == "success") {
                    console.log("Deactivation successful");

                    
                    localStorage.setItem('switchState_' + x, checkbox.checked);
                } else {
                    console.log("Deactivation failed. Server response: " + t);

                    if (t.trim() === "") {
                        console.log("Server response is empty");
                    } else {
                        console.log("Additional details: " + t);
                    }

                    checkbox.checked = !checkbox.checked;
                }
            } else {
                console.log("Error: " + r.statusText);
            }
        }
    }

    r.open("GET", "WorkerDeactivateProcess.php?m=" + x, true);
    r.send();
}

function manageload() {
    loadCategory();
    showpageination();
}

function loadCategory() {

    var Category = document.getElementById("selectcate").value;

    var r = new XMLHttpRequest();

    if (Category == "0") {
        window.location.reload();
    }

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {

            document.getElementById("wdtable").innerHTML = "";
            document.getElementById("wdtable").innerHTML = r.responseText;
        }
    }

    r.open("GET", "loadCategoryProccess.php?c=" + Category, true);
    r.send();
}
function showpageination() {

    var Category = document.getElementById("selectcate").value;
    var pageMoveDiv = document.getElementById("pageMove");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            pageMoveDiv.innerHTML = "";
            pageMoveDiv.innerHTML = r.responseText;
        }
    }

    r.open("GET", "ShowpageinationProccess.php?c=" + Category, true);
    r.send();
}

function activeAcc(x) {
    console.log(x);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                window.location.reload();
            } 

        }
    }

    r.open("GET", "wActiveProceess.php?m=" + x, true);
    r.send();

}

function AdWosearch() {
    var search = document.getElementById("SearchWork").value;

    if (search == "") {
        alert("Please Enter Worker email");
    } else {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {

                var t = r.responseText;

                if (t == "Invalid Email") {
                    alert("Invalid Email");
                } else {
                    document.getElementById("wdtable").innerHTML = "";
                    document.getElementById("wdtable").innerHTML = r.responseText;
                }
            }
        }

        r.open("GET", "SearchWorkerProceess.php?se=" + search, true);
        r.send();
    }

}

var ovm;
function orderVcode(order_id, x) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                window.location.reload();
            } else if (t == "Order Cancel") {
                alert("Order Cancel");
            } else if (t == "complete") {
                var mo = document.getElementById("modelemvc");
                ovm = new bootstrap.Modal(mo);
                ovm.show();
            }
        }
    };

    r.open("GET", "OrderActiveProcess.php?id=" + order_id + "&ac=" + x, true);
    r.send();
}

function compro() {
    var vCode = document.getElementById("emc").value;

    var r = new XMLHttpRequest();
    var f = new FormData();

    f.append("vrifyCode", vCode);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                ovm.hide();
                window.location.reload();
                console.log("success");
            } else if (t == "wrong") {
                alert("Your Code is Wrong. Try Again...!");
            }
        }
    }
    r.open("POST", "OrderCompleteProcess.php", true);
    r.send(f);
}

function UserOrderProcess(order_id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                window.location.reload();
            } else if (t == "Order is canceled!") {
                alert("Order is canceled!");
            } else if (t == "You Can not cancel Order!") {
                alert("You Can not cancel Order!");
            }
        }
    };

    r.open("GET", "UserOrderActiveProcess.php?id=" + order_id, true);
    r.send();

}

function order(wemail) {

    var we = wemail.getAttribute("data-name");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "orderprocess.php?wemail=" + we, true);
    r.send();
}


function handleOrdersViewClick(worker, email, user) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {

        }
    };

    r.open("GET", "notificationProcess.php?worker=" + worker + "&email=" + email + "&user=" + user + "&email=" + email, true);
    r.send();
}

function AdWorkerOrdersearch() {
    var search = document.getElementById("SearcOrderhworker").value;

    if (search == "") {
        alert("please Enter Worker Email");
    } else {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                var t = r.responseText;

                if (t == "Invalid Email") {
                    alert("Invalid Email");
                } else {
                    document.getElementById("orderTableBody").innerHTML = "";
                    document.getElementById("orderTableBody").innerHTML = r.responseText;
                }
            }
        }
        r.open("GET", "orderEmailSearch.php?se=" + search, true);
        r.send();
    }

}

function userLike(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "AddLike") {
                window.location.reload();
            } else if (t == "RemoveLike") {
                window.location.reload();
            }
        }
    }

    r.open("GET", "likeProcess.php?likeemail=" + email, true);
    r.send();
}

document.addEventListener("DOMContentLoaded", function () {
    const heartIcon = document.getElementById("heart-icon");
    const savedProfile = document.getElementById("saved-profile");

    savedProfile.style.display = "none";

    heartIcon.addEventListener("mouseenter", function () {
        savedProfile.style.display = "block";
    });

    heartIcon.addEventListener("mouseleave", function () {
        savedProfile.style.display = "none";
    });
});

function userSave(email) {
    console.log(email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "Addsave") {
                window.location.reload();
            } else if (t == "Removesave") {
                window.location.reload();
            }
        }
    }

    r.open("GET", "profileSaveProcess.php?saveemail=" + email, true);
    r.send();
}


function contactUs() {
    console.log("Function called");
    var Name = document.getElementById("cName");
    var Email = document.getElementById("cEmail");
    var Message = document.getElementById("cMessage");

    console.log(Name.value);
    console.log(Email.value);
    console.log(Message.value);

    var r = new XMLHttpRequest();
    var f = new FormData();

    f.append("cName", Name.value);
    f.append("cEmail", Email.value);
    f.append("cMessage", Message.value);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {

            }
        }
    };

    r.open("POST", "contactUsProcess.php", true);
    r.send(f);
}

document.addEventListener("DOMContentLoaded", function () {
    const chatIcon = document.getElementById("chatIcon");
    const chatContainer = document.getElementById("chatBotContent");

    chatIcon.addEventListener("click", function () {
        chatContainer.style.display = (chatContainer.style.display === "none" || chatContainer.style.display === "") ? "block" : "none";
    });

    document.getElementById("cancelIcon").addEventListener("click", function () {
        console.log("Chat canceled!");

        var chatBox = document.getElementById('chatBox');
        chatBox.innerHTML = '';

        var chatBotContent = document.getElementById("chatBotContent");
        chatBotContent.style.display = "none";
    });
});


/*-------------chatBot-------------------------*/

function sendMessage() {
    var userInput = document.getElementById('userInput').value;
    if (userInput.trim() === '') return;

    appendMessage('user', userInput);
    var lowerCaseInput = userInput.toLowerCase();

    var botResponse = '';

    if (lowerCaseInput === 'hi') {
        var botResponses = [
            "I am Happy to assist you. Please enter the number for your question",
            "1. I am unable to log in to the website",
            "2. Why can't I hire a specific worker ?",
            "3. What is the purpose of the order code provided after hiring a worker ?",
            "4. Is there a mobile app available ?",
            "5. How does the star system on workers' profiles work ?",
            "6. Other"
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    } else if (lowerCaseInput === '1') {
        var botResponses = [
            "If there is a message as <b>Prohibited</b>. You have violated our policies and the admin panel has banned you from the website"
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    } else if (lowerCaseInput === '2') {
        var botResponses = [
            "If the worker's profile displays <b>Hired</b>, that specific worker has been hired. He cannot be hired until that order has been completed.",
            "There is a limit to the number of workers you can hire simultaneously. You can only hire one worker at a time."
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    } else if (lowerCaseInput === '3') {
        var botResponses = [
            "It is the way to confirm the work has been done. Do not give the payment to the worker until the work has been done 100%."
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    } else if (lowerCaseInput === '4') {
        var botResponses = [
            "Currently, we only offer a web-based platform. However, our website is optimized for mobile devices, allowing you to access it conveniently on your smartphone or tablet."
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    } else if (lowerCaseInput === '5') {
        var botResponses = [
            "It depends on the number of likes that the worker gets. If he has 1 star, that means he has likes 5-20. For 2 stars, that means he has likes 20-40. For 3 stars, that means he has likes 40-60. For 4 stars, that means he has likes 60-80. For 5 stars, that means he has likes more than 80."
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    } else if (lowerCaseInput === '6') {
        var botResponses = [
            "Furthermore, for questions and information, contact us via WhatsApp or email."
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    } else {
        var botResponses = [
            "1. I am unable to log in to the website",
            "2. Why can't I hire a specific worker ?",
            "3. What is the purpose of the order code provided after hiring a worker ?",
            "4. Is there a mobile app available ?",
            "5. How does the star system on workers' profiles work ?",
            "6. Other"
        ];
        botResponses.forEach(response => appendMessage('Admin', response));
        return;
    }

    document.getElementById('userInput').value = '';
}


function appendMessage(sender, message) {
    var chatBox = document.getElementById('chatBox');
    var messageDiv = document.createElement('div');
    messageDiv.className = sender;
    messageDiv.innerHTML = `<strong>${sender}:</strong> ${message}`;
    chatBox.appendChild(messageDiv);

    chatBox.scrollTop = chatBox.scrollHeight;
}

/*-------------chatBot-------------------------*/


function order1(){
    alert('Worker Hired....!');
}

function adminLogout(){
    location.replace("AdminsignIn.php");
}

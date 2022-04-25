<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jessie Eoff and Rachel Zhao">
    <meta name="description" content="myTheater Login Page">  
    <title>myTheater Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
    <link rel="stylesheet" type="text/css" href="templates/login.css">
</head>

<body>
    <!-- HEADER / NAV -->
    <header class = "row">
        <div class = "header col-12">
            <nav class="navbar navbar-light bg-light fixed-top mytheater-nav">
                <div class = "container-fluid">
                    <a class = "navbar-brand">
                        <img src="templates/home/style/imgs/logo.png" alt="Profile Icon" class="d-inline-block align-text-top logoicon">
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- LOGIN FORM -->
    <div class = "container-fluid">
        <!-- INFORMATIONAL GREETING -->
        <div class = "row">
            <div class = "col-1 col-sm-2"></div>
            <div class = "col-10 col-sm-8">
                <h1>Welcome to myTheater</h1>
                <p> Login below to access your movie ratings.</p>
            </div>
            <div class = "col-1 col-sm-2"> </div>
        </div>

        <!-- ERROR MSG -->
        <div class = 'row'>
            <div class = 'col-lg-4 col-sm-3 col-1'></div>
            <div class = 'col-lg-4 col-sm-6 col-10' id = "error_msg">
            </div>
            <div class = 'col-lg-4 col-sm-3 col-1'></div>
        </div>

        <?php
        if (!empty($error_msg)){
        ?>
            <div class = 'row'>
                <div class = 'col-lg-4 col-sm-3 col-1'></div>
                <div class = 'col-lg-4 col-sm-6 col-10'>
                    <div class='alert alert-danger'><?=$error_msg?></div>
                </div>
                <div class = 'col-lg-4 col-sm-3 col-1'></div>
            </div>
        <?php
        }
        ?>

        <!-- LOGIN FORM -->
        <form action = "?command=login" method = "post">
            <div class = "row">
                <div class = "col-lg-4 col-sm-3 col-1"></div>
                <div class = "col-lg-4 col-sm-6 col-10 login-card">
                    <div class = "row login-top form-col">
                        <div class = "col">                                
                            <div class="mb-3">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="name" name="name"/>
                            </div>
                        </div>
                        <div class = "col">                                
                            <div class="mb-3">
                                <label for = "lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control " id = "lname" name = "lname"/>
                            </div>
                        </div>
                    </div>
                    <div class = "row form-col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"/>
                        </div>
                    </div>
                    <div class = "row form-col">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" placeholder = "###-###-####" class="form-control" id="phone" name="phone"/>
                        </div>
                    </div>
                    <div class = "row form-col">                            
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                            <div class = "password-text">
                                Password must be at least 8 characters containing !,&,# or %. 
                            </div>
                        </div>
                    </div>
                    <!-- FORM SUBMISSION -->
                    <div class = "login-row">
                        <button type = "submit" class="btn btn-dark" id = "login-btn" disabled>Login</button>
                    </div>
                </div>
                <div class = "col-lg-4 col-sm-3 col-1"></div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

    <script type = "text/javascript">

        //function to ensure that password is at least 8 characters long with one special character
        function passwordValidate() {
            var pass = document.getElementById("password");

            var passval = pass.value;

            var passRegex = new RegExp('^[A-za-z0-9!#&%]*[!#%&]+[A-za-z0-9!#&%]*$');

            if(passval.length < 8){
                pass.classList.add("is-invalid");
                return false;
            } else if (!passRegex.test(passval)){
                pass.classList.add("is-invalid");
                return false;
            }
            else {
                pass.classList.remove("is-invalid");
                return true;
            }
        }

        //function to validate an email address
        function emailValidate() {
            var email = document.getElementById("email");
            var emailval = email.value;
            var emailRegex = new RegExp('^[A-Za-z0-9\+\-_][A-Za-z0-9\+\-_\.]*[A-Za-z0-9\+\-_]+[@][A-Za-z0-9\-]+[\.][A-Za-z0-9\-\.]*[A-Za-z0-9\-]+$');

            if (!emailRegex.test(emailval)){
                email.classList.add("is-invalid");
                return false;
            } else {
                email.classList.remove("is-invalid");
                return true;
            }

        }

        //function to validate phone number -- form can be 123-123-1234 or 1231231234
        function phoneValidate(){
            var phone = document.getElementById("phone");
            var phoneval = phone.value;

            var phoneRegex = new RegExp('^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$');

            if (!phoneRegex.test(phoneval)){
                phone.classList.add("is-invalid");
                return false;
            } else {
                phone.classList.remove("is-invalid");
                return true;
            }
        }

        //checks email, phone, and password to disable/enable button
        function validate(){
            var loginbtn = document.getElementById("login-btn");
            if (emailValidate() && passwordValidate() && phoneValidate()){
                loginbtn.disabled = false;
            } else {
                loginbtn.disabled = true;
            }
        }

        //adding all the event listeners
        document.getElementById("password").addEventListener("keyup", passwordValidate);
        document.getElementById("email").addEventListener("keyup", emailValidate);
        document.getElementById("phone").addEventListener("keyup", phoneValidate);
        document.getElementById("phone").addEventListener("keyup", validate);
        document.getElementById("password").addEventListener("keyup", validate);
        document.getElementById("email").addEventListener("keyup", validate);
    </script>
</body>
</html>
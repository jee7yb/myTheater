<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jessie Eoff and Rachel Zhao">
        <meta name="description" content="myTheater Login Page">  
        <title>myTheater Login</title>
        <link rel="stylesheet" type="text/css" href="templates/login.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
    </head>
    <body>
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
        <div calss = "container-fluid">
            <div class = "row">
                <div class = "col-2">
                </div>
                <div class = "col-8">
                    <h1>Welcome to myTheater</h1>
                    <p> Login below to access your movie ratings.</p>
                </div>
                <div class = "col-2">
                </div>
            </div>
            <?php
            if (!empty($error_msg)){
                echo "<div class = 'row'>
                    <div class = 'col-4'>
                    </div>
                    <div class = 'col-4'>
                    <div class='alert alert-danger'>$error_msg</div>
                    </div>
                    <div class = 'col-4'>
                    </div>
                </div>";
            }
            ?>
            <form action="?command=login" method="post">
                <div class = "row">
                    <div class = "col-lg-4 col-sm-3 col-2">
                    </div>
                    <div class = "col-lg-4 col-sm-6 col-8">
                        <div class = "row form-col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"/>
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
                                <label for="phone" class="form-label">Phone Number (no dashes)</label>
                                <input type="text" class="form-control" id="phone" name="phone"/>
                            </div>
                        </div>
                        <div class = "row form-col">                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"/>
                            </div>
                        </div>
                        <div class = "login-row">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </div>
                    <div class = "col-lg-4 col-sm-3 col-2">
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>
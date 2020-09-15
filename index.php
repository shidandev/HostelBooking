<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery.js"></script>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://use.fontawesome.com/4fcce2dec9.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row" class="border border-primary">
            <?php include("component/header.php"); ?>
        </div>
        <div class="row" style="height:100vh; display:flex;">
            <div class="col-3 card d-none">
                <?php include("component/sidebar.php"); ?>
            </div>
            <div class="col-12 card">
                <div class="row" style="height: 10vh;"></div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card shadow">
                            <div class="card-title h3 text-center">
                                Login
                            </div>
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Username</span>
                                    </div>
                                    <input type="text" id="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Password</span>
                                    </div>
                                    <input type="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button id="btn_signup" class="btn btn-info btn-block">Sign Up</button>

                                    </div>
                                    <div class="col-6">
                                        <button id="btn_login" class="btn btn-success btn-block">Login</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-2"></div>

                </div>
                <div class="row" style="height: 10vh;"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.post("backend/session.php", function(res) {
                console.log(res);
            }, "json");

            $("#btn_signup").click(function() {

            });

            $("#btn_login").click(function() {
                let username = $("#username").val();
                let password = $("#password").val();
                let proceed = true;

                if (username.trim() == '') {
                    proceed = false;
                }
                if (password.trim() == '') {
                    proceed = false;
                }

                if (proceed) {
                    $.post("backend/login.php", {
                        username: username,
                        password: password
                    }, function(res) {
                        console.log(res);
                        if (res.status == 'ok') {
                            if (res.data.type == "admin") {
                                window.location.href = "admin";
                            } else if (res.data.type == "user") {
                                window.location.href = "user";
                            }
                        }
                    }, "json");
                } else {
                    if (username.trim() == '') {
                        alert("Username not valid");
                    }
                    if (password.trim() == '') {
                        alert("Wrong password");
                    }
                }

            });
        });

        function validate() {

        }
    </script>
</body>

</html>
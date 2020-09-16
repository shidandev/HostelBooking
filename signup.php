<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="js/jquery.js"></script>
    <script src="js/datatables.js"></script>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/datatables.css">
    <script src="https://use.fontawesome.com/4fcce2dec9.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row" class="border border-primary">
            <?php include("component/header.php"); ?>
        </div>
        <div class="row" style="height:100vh; display:flex;">

            <div class="col-12 card">
                <div class="row text-center">
                    <div class="col-12">
                        <text class="h4">Student Signup</text>
                        <div class="row w-100 mt-3">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Matric No/ Username</span>
                                    </div>
                                    <input type="text" id="mat_no" class="form-control" placeholder="Matric No" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Password</span>
                                    </div>
                                    <input type="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Confirm Password</span>
                                    </div>
                                    <input type="password" id="password2" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">First Name</span>
                                    </div>
                                    <input type="text" id="fname" class="form-control" placeholder="First Name" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Last Name</span>
                                    </div>
                                    <input type="text" id="lname" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Address</span>
                                    </div>
                                    <textarea class="form-control" id="address"></textarea>
                                    <!-- <input type="text"  id="address" class="form-control" placeholder="Address" aria-describedby="basic-addon1"> -->
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">E - mail</span>
                                    </div>
                                    <input type="text" id="email" class="form-control" placeholder="E - mail" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Phone No</span>
                                    </div>
                                    <input type="number" id="phoneno" class="form-control" placeholder="Phone No" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Faculty</span>
                                    </div>

                                    <select class="form-control" id="faculty">
                                        <option value="FTMK">FTMK</option>
                                        <option value="FKM">FKM</option>
                                        <option value="FKEKK">FKEKK</option>
                                        <option value="FKP">FKP</option>
                                        <option value="FKE">FKE</option>
                                        <option value="FPTT">FPTT</option>
                                        <option value="FTKMP">FTKMP</option>
                                        <option value="FTKEE">FTKEE</option>
                                    </select>
                                    <!-- <input type="text"  id="faculty" class="form-control" placeholder="Faculty" aria-describedby="basic-addon1"> -->
                                </div>
                                <div class="row changing">
                                    <div class="col-6"></div>
                                    <div class="col-6 ">
                                        <button id="btn_signup" class="btn btn-info btn-block">Sign up</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#btn_signup").click(function() {


                let mat_no = $("#mat_no").val().trim();
                let fname = $("#fname").val().trim();
                let lname = $("#lname").val().trim();
                let address = $("#address").val().trim();
                let email = $("#email").val().trim();
                let phoneno = $("#phoneno").val().trim();
                let faculty = $("#faculty").val();
                let password = $("#password").val().trim();
                let password2 = $("#password2").val().trim();
                
                if(password !== password2)
                {
                    alert("Password are not match");
                    return;
                }
                if (
                    mat_no != '' &&
                    fname != '' &&
                    lname != '' &&
                    address != '' &&
                    email != '' &&
                    phoneno != '' && !isNaN(phoneno) &&
                    faculty != '' 
                ){
                    $.post("backend/signup.php", {
                        matric_no: mat_no,
                        fname: fname,
                        lname: lname,
                        address: address,
                        email: email,
                        phoneno: phoneno,
                        faculty: faculty,
                        password:password
                    }, function(res) {
                        if (res.status == "ok") {
                            alert("Successfully Registered");
                            window.location.href = "index.php";
                        } else {
                            alert("Error, please check connection");
                        }
                    }, "json")
                }
                else{
                    if(mat_no == '')
                    {
                        alert("Please Check Matric No");
                        return;
                    }
                    if(fname == '')
                    {
                        alert("Please Check First Name");
                        return;
                    }
                    if(lname == '')
                    {
                        alert("Please Check Last Name");
                        return;
                    }
                    if(address == '')
                    {
                        alert("Please Check Address");
                        return;
                    }
                    if(email == '')
                    {
                        alert("Please Check E-mail");
                        return;
                    }
                    if(phoneno == '')
                    {
                        alert("Please Check Phone No");
                        return;
                    }
                    if(faculty == '')
                    {
                        alert("Please Check Faculty");
                        return;
                    }
                    if(password == password2)
                    {
                        alert("Password are not match");
                        return;
                    }
                }
                    

            })
        });
    </script>
</body>

</html>
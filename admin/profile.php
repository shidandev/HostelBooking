<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="../js/jquery.js"></script>
    <script src="../js/datatables.js"></script>

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css"> -->
    <link rel="stylesheet" href="../css/bootstrap-social.css">
    <link rel="stylesheet" href="../css/bootstrap-select.css">
    <link rel="stylesheet" href="../css/fileinput.min.css">
    <link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/datatables.css">
    <script src="https://use.fontawesome.com/4fcce2dec9.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row" class="border border-primary">
            <?php include("../component/header-chill.php"); ?>
        </div>
        <div class="row" style="height:100vh; display:flex;">
            <div class="col-2 card">
                <?php include("../component/sidebar.php"); ?>
            </div>
            <div class="col-10 card">
                <div class="row text-center">
                    <div class="col-12">
                        <text class="h4">User Profile</text>
                        <div class="row w-100 mt-3">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Matric No</span>
                                    </div>
                                    <input type="text" readonly id="mat_no" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">First Name</span>
                                    </div>
                                    <input type="text" readonly id="fname" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Last Name</span>
                                    </div>
                                    <input type="text" readonly id="lname" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Address</span>
                                    </div>
                                    <input type="text" readonly id="address" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">E - mail</span>
                                    </div>
                                    <input type="text" readonly id="email" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Phone No</span>
                                    </div>
                                    <input type="text" readonly id="phoneno" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Faculty</span>
                                    </div>
                                    <input type="text" readonly id="faculty" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="row changing">
                                    <div class="col-6"></div>
                                    <div class="col-6 ">
                                        <button id="btn_change" class="btn btn-info btn-block">Change</button>
                                    </div>
                                </div>
                                <div class="row updating d-none">
                                    <div class="col-6">
                                        <button id="btn_cancel" class="btn btn-secondary btn-block">Cancel</button>
                                    </div>
                                    <div class="col-6 ">
                                        <button id="btn_confirm_update_profile" class="btn btn-success btn-block">Confirm</button>
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
            let session = {};

            $.post("../backend/session.php", function(res) {
                    console.log(res);
                    session = res;
                }, "json")
                .then(function(res) {
                    $.post("../backend/user_profile_get.php", {
                        user_id: session.user_data.user_id
                    }, function(res) {
                        console.log(res);
                        if (res.status === "ok") {
                            let node = res.data;
                            $("#mat_no").val(node.matric_no);
                            $("#fname").val(node.fname);
                            $("#lname").val(node.lname);
                            $("#address").val(node.addClass);
                            $("#email").val(node.email);
                            $("#phoneno").val(node.phoneno);
                            $("#faculty").val(node.faculty);
                        }
                    }, "json");
                });

            $("#btn_change").click(function() {
                $(".changing").addClass("d-none");
                $(".updating").removeClass("d-none");
                $("input").attr("readonly", false);
            });

            $("#btn_confirm_update_profile").click(function() {
              
                if (confirm("Are you sure to update profile information?")) {
                    let mat_no = $("#mat_no").val();
                    let fname = $("#fname").val();
                    let lname = $("#lname").val();
                    let address = $("#address").val();
                    let email = $("#email").val();
                    let phoneno = $("#phoneno").val();
                    let faculty = $("#faculty").val();

                    $.post("../backend/user_profile_update.php", {
                        user_id: session.user_data.user_id,
                        matric_no: mat_no,
                        fname: fname,
                        lname: lname,
                        address: address,
                        email: email,
                        phoneno: phoneno,
                        faculty: faculty
                    }, function(res) {
                        if (res.status == "ok") {
                            alert("Successfully update");
                            window.location.reload();
                        } else {
                            alert("Error, please check connection");
                        }
                    }, "json")
                }
            })
        });
    </script>
</body>

</html>
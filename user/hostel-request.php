<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="../js/jquery.js"></script>
    <script src="../js/qrious.js"></script>
    <script src="../js/barcode.js"></script>
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
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center">
                            <text class="h4">Hostel Booking</text>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Block</span>
                            </div>
                            <input type="text" readonly id="block" class="form-control" placeholder="Block" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Level</span>
                            </div>
                            <input type="text" readonly id="level" class="form-control" placeholder="Level" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">House</span>
                            </div>
                            <input type="text" readonly id="house" class="form-control" placeholder="House" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Room</span>
                            </div>
                            <input type="text" readonly id="room" class="form-control" placeholder="Room" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Start Date</span>
                            </div>
                            <input type="text" readonly id="sdate" class="form-control" placeholder="Start Date" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">End Date</span>
                            </div>
                            <input type="text" readonly id="edate" class="form-control" placeholder="End Date" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Status</span>
                            </div>
                            <input type="text" readonly id="status" class="form-control" placeholder="Status" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row approved_div d-none">
                        <div class="col-12 text-center">
                            <text class="h4">Please scan this as room password</text>
                        </div>
                    </div>
                    <div class="row approved_div d-none card my-3">
                        <div class="col-12 text-center h5 mt-2">QR CODE</div>
                        <div class="col-12 text-center">
                            <canvas id="qr"></canvas>

                        </div>
                    </div>

                    <div class="row approved_div d-none card my-3">
                        <div class="col-12 text-center h5 mt-2">BARCODE</div>
                        <div class="col-12 text-center">
                            <svg id="barcode"></svg>

                        </div>
                    </div>
                    <!-- <div class="row text-center">
                        <div class="col-12">
                            <text class="h4">Hostel Request List</text>
                        </div>
                    </div>
                    <div class="">
                        <table class="table" id="hostel_request_table">
                            <thead>
                                <td>No</td>
                                <td>Place</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Status</td>
                            </thead>
                            <tbody id="hostel_request_body">
                                <tr>
                                    <td>No Request has been made</td>
                                    

                                </tr>
                               


                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#block").val("");
            $("#level").val("");
            $("#house").val("");
            $("#room").val("");
            $("#sdate").val("");
            $("#edate").val("");
            $("#status").val("");
            // var qr = new QRious({
            //     element: document.getElementById('qr'),
            //     value: ""
            // })

            // JsBarcode("#barcode", "", {
            //     // displayValue:false
            // });
            let session = {};

            $.post("../backend/session.php", function(res) {
                    console.log(res);
                    session = res;

                    $.post("../backend/check_request.php", {
                        user_id: session.user_data.user_id
                    }, function(res2) {

                        if (res2.status === "ok") {
                            if (res2.data[0].count == 0) {
                                alert("You not booking any hostel room yet");
                                window.location.href = "index.php";
                            } else {


                            }
                        }
                    }, "json");
                }, "json")
                .done(function() {
                    $.post("../backend/hostel_request.php", {
                        user_id: session.user_data.user_id
                    }, function(res) {
                        console.log("masuk", res);
                        if (res.status === "ok") {

                            $("#block").val(res.data[0].block);
                            $("#level").val(res.data[0].level);
                            $("#house").val(res.data[0].house);
                            $("#room").val(res.data[0].room);
                            $("#sdate").val(res.data[0].sdate);
                            $("#edate").val(res.data[0].edate);
                            $("#status").val(res.data[0].status.toUpperCase());

                            if (res.data[0].status == 'booking') {
                                $(".approved_div").addClass("d-none");
                            } else {
                                $(".approved_div").removeClass("d-none");
                            }
                            var qr = new QRious({
                                element: document.getElementById('qr'),
                                value: res.data[0].password
                            })

                            JsBarcode("#barcode", res.data[0].password, {
                                // displayValue:false
                            });
                            // let html = "";
                            // for (let i = 0; i < res.data.length; i++) {
                            //     html += '    <tr>';
                            //     html += '        <td>' + (i + 1) + '</td>';
                            //     html += '        <td>' + res.data[i].name + '</td>';
                            //     html += '        <td>' + res.data[i].sdate + '</td>';
                            //     html += '        <td>' + res.data[i].edate + '</td>';
                            //     html += '        <td>' + (res.data[i].status).toUpperCase() + '</td>';
                            //     html += '    </tr>';

                            // }

                            // $("#hostel_request_body").empty().append(html);
                        }
                    }, "json").
                    done(function() {
                        // $("#hostel_request_table").dataTable();
                    });
                });



        });
    </script>
</body>

</html>
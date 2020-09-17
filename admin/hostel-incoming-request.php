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
                <div class="col-12">
                    <div class="row text-center">
                        <div class="col-12">
                            <text class="h4">Hostel Request List</text>
                        </div>
                    </div>
                    <div class="">
                        <table class="table" id="hostel_request_table">
                            <thead>
                                <td>No</td>
                                <td>Student Name</td>
                                <td>Place</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Status</td>
                                <td>Action</td>
                            </thead>
                            <tbody id="hostel_request_body">
                                <tr>
                                    <td>No Request has been made</td>
                                    

                                </tr>
                               


                            </tbody>
                        </table>
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
                .done(function() {
                    $.post("../backend/hostel_incoming_request.php", {
                        user_id: session.user_data.user_id
                    }, function(res) {
                        console.log("masuk",res);
                        if (res.status === "ok") {
                            
                            let html = "";
                            for (let i = 0; i < res.data.length; i++) {
                                html +='    <tr>';
                                html +='        <td>'+(i+1)+'</td>';
                                html +='        <td>'+res.data[i].fname+'</td>';
                                html +='        <td>'+res.data[i].name+'</td>';
                                html +='        <td>'+res.data[i].sdate+'</td>';
                                html +='        <td>'+res.data[i].edate+'</td>';
                                html +='        <td>'+(res.data[i].status).toUpperCase()+'</td>';
                                html +='        <td>';
                                html +='            <div class="row">';
                                html +='                <button class="btn btn-block btn-warning btn_approve room_pass_fx">Approve</button>';
                                html +='                <button class="btn btn-block btn-warning btn_submit_approve room_pass_fx d-none"><input type="hidden" value="'+res.data[i].b_id+'">Submit</button>';
                                html +='                <input type="text" placeholder="Room Password" class="d-none form-control room_pass room_pass_fx" >';
                                html +='                <button class="btn btn-block btn-danger btn_disapprove"><input type="hidden" value="'+res.data[i].b_id+'">Disapprove</button>';
                                
                                html +='            </div>';
                                
                                html +='        </td>';
                                html +='    </tr>';

                            }

                            $("#hostel_request_body").empty().append(html);
                        }
                    },"json").
                    done(function(){
                        $("#hostel_request_table").dataTable();

                        $(".btn_approve").click(function(){
                            $(this).addClass("d-none");
                            $(this).parent().find(".room_pass_fx").removeClass("d-none");
                        });

                        $(".btn_submit_approve").click(function(){
                            
                           
                            if(confirm("Are you sure to approve this request?"))
                            {
                                let b_id = $(this).find("input").val();
                                let room_password = $(this).next().val();

                                $.post("../backend/hostel_request_approve.php",{
                                    b_id:b_id,
                                    password:room_password,
                                    type: 'approved'
                                }, function(res){
                                    if(res.status === "ok")
                                    {
                                        alert("Succesfully approve this request");
                                        window.location.reload();
                                    }
                                    else{
                                        alert("Unsuccesfully to approve this request, please try again");
                                    }
                                },"json");
                            }
                        });
                        $(".btn_disapprove").click(function(){
                            if(confirm("Are you sure to disapprove this request?"))
                            {
                                let b_id = $(this).find("input").val();

                                $.post("../backend/hostel_request_approve.php",{
                                    b_id:b_id,
                                    type: 'disapproved'
                                }, function(res){
                                    if(res.status === "ok")
                                    {
                                        alert("Succesfully to approve this request, please try again");
                                        window.location.reload();
                                    }
                                    else{
                                        alert("Unsuccesfully to approve this request, please try again");
                                    }
                                },"json");
                            }
                        })
                    });
                });


            
        });
    </script>
</body>

</html>
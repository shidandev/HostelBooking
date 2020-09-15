<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/jquery.js"></script>

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-social.css">
    <link rel="stylesheet" href="../css/bootstrap-select.css">
    <link rel="stylesheet" href="../css/fileinput.min.css">
    <link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- <script src="https://use.fontawesome.com/4fcce2dec9.js"></script> -->

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
            <div class="col-7 card">
                Block
                <div class="row p-2" id="block_row">

                </div>
                Level
                <div class="row p-2" id="level_row">

                </div>
                House
                <div class="row p-2" id="house_row">

                </div>
                Room
                <div class="row p-2" id="room_row">

                </div>
            </div>
            <div class="col-3 card">
                <text class="h4 text-center">Current Selection</text>

                <div class="card p-2">
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Block</span>
                            </div>
                            <input type="text" id="cur_block" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Level</span>
                            </div>
                            <input type="text" id="cur_level" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">House</span>
                            </div>
                            <input type="text" id="cur_house" class="form-control" aria-describedby="basic-addon1">
                        </div>

                    </div>
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Room</span>
                            </div>
                            <input type="text" id="cur_room" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Price</span>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text">RM</span>
                            </div>
                            <input type="text" id="cur_price" class="form-control" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Day</span>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Start Date</span>
                            </div>
                            <input type="date" id="sdate" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">End Date</span>
                            </div>
                            <input type="date" id="edate" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Total Day</span>
                            </div>
                            <input readonly type="number" id="total_day" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Total Price</span>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text">RM</span>
                            </div>
                            <input readonly type="text" id="total_price" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row text-cente pt-3 pb-2">
                        <div class="col-6">
                            <button class="btn btn-danger btn-block">Reset</button>

                        </div>
                        <div class="col-6">

                            <button class="btn btn-success btn-block " id="btn_request">Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let session;
            let cur_block = 0;
            let cur_level = 0;
            let cur_house = 0;
            let cur_room = 0;
            let cur_price = 0;

            let cur_block_disp = $("#cur_block").val("");
            let cur_level_disp = $("#cur_level").val("");
            let cur_house_disp = $("#cur_house").val("");
            let cur_room_disp = $("#cur_room").val("");
            let cur_price_disp = $("#cur_price").val("");
            let cur_total_day_disp = $("#total_day").val("");
            let cur_total_price_disp = $("#total_price").val("");
            let sdate = $("#sdate").val("");
            let edate = $("#edate").val("");

            $("#edate").change(function() {

                const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
                const firstDate = new Date(sdate.val());
                const secondDate = new Date(edate.val());

                const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

                console.log(diffDays);
                cur_total_day_disp.val(diffDays);

                if(cur_price != 0)
                {
                    cur_total_price_disp.val(((cur_price * diffDays)/100).toFixed(2));
                }
            });
            $.post("../backend/session.php", function(res) {
                console.log(res);
                session = res;
            }, "json");

            $.post("../backend/block.php", function(res) {

                    if (res.status == "ok") {
                        let html = "";

                        for (let i = 0; i < res.data.length; i++) {
                            html += '<div class="card text-center block_btn btn btn-outline-info" style="width: 20%;">';
                            html += '<input type="hidden"  value="' + res.data[i].block_id + '"> ' + res.data[i].name;
                            html += '</div>';
                        }

                        $("#block_row").empty().append(html);
                    }
                }, "json")
                .done(function() {
                    $(".block_btn").click(function() {
                        let node = $(this);
                        let block_id = node.find("input").val();
                        cur_block_disp.val(node[0].innerText);
                        $(".block_btn").removeClass("active");
                        node.addClass("active");
                        cur_block = block_id;
                        loadLevel(block_id);
                    });
                });

            
            
            $("#btn_request").click(function() {
                console.log(session);

                $.post("../backend/request_room.php", {
                    user_id:session.user_data.user_id,
                    room_id: cur_room,
                    sdate:sdate.val(),
                    edate:edate.val()
                }, function(res) {
                    if (res.status == "ok") {
                        window.location.href = "hostel-request.php";
                    }
                }, "json");
            });


            function loadLevel(block_id) {
                $.post("../backend/level.php", {
                        block_id: block_id
                    }, function(res) {

                        if (res.status == "ok") {
                            let html = "";

                            for (let i = 0; i < res.data.length; i++) {
                                html += '<div class="card text-center level_btn btn btn-outline-info" >';
                                html += '<input type="hidden" value="' + res.data[i].level_id + '"> ' + res.data[i].name;
                                html += '</div>';
                            }

                            $("#level_row").empty().append(html);
                        }
                    }, "json")
                    .done(function() {
                        $(".level_btn").click(function() {
                            let node = $(this);
                            let level_id = node.find("input").val();
                            cur_level_disp.val(node[0].innerText);
                            $(".level_btn").removeClass("active");
                            node.addClass("active");
                            cur_level = level_id;
                            loadHouse(level_id);
                        });
                    });
            }

            function loadHouse(level_id) {
                $.post("../backend/house.php", {
                        level_id: level_id
                    }, function(res) {

                        if (res.status == "ok") {
                            let html = "";

                            for (let i = 0; i < res.data.length; i++) {
                                html += '<div class="card text-center house_btn btn btn-outline-info" >';
                                html += '<input type="hidden" value="' + res.data[i].house_id + '"> ' + res.data[i].name;
                                html += '</div>';
                            }

                            $("#house_row").empty().append(html);
                        }
                    }, "json")
                    .done(function() {
                        $(".house_btn").click(function() {
                            let node = $(this);
                            let house_id = node.find("input").val();
                            cur_house_disp.val(node[0].innerText);
                            $(".house_btn").removeClass("active");
                            node.addClass("active");
                            cur_house = house_id;
                            loadRoom(house_id);
                        });
                    });
            }

            function loadRoom(house_id) {
                $.post("../backend/room.php", {
                        house_id: house_id
                    }, function(res) {

                        if (res.status == "ok") {
                            let html = "";

                            for (let i = 0; i < res.data.length; i++) {
                                html += '<div ';
                                html += (res.data[i].stat !== 'empty') ? 'style="pointer-events:none"' : '';
                                html += ' class="card text-center room_btn btn ';
                                html += (res.data[i].stat === 'empty') ? ' btn-outline-info' : ' bg-warning ';
                                html += '" >';
                                html += '<input class="price" type="hidden" value="' + res.data[i].price + '"><input class="name" type="hidden" value="' + res.data[i].name + '"><input class="id" type="hidden" value="' + res.data[i].room_id + '"> ' + res.data[i].name;
                                html += '<br>Status: ';
                                html += (res.data[i].stat === 'empty') ? 'Empty' : 'Occupy';
                                html += '</div>';
                            }

                            $("#room_row").empty().append(html);
                        }
                    }, "json")
                    .done(function() {
                        $(".room_btn").click(function() {
                            let node = $(this);
                            let house_id = node.find(".id").val();
                            cur_price = node.find(".price").val();
                            cur_room_disp.val(node.find(".name").val());
                            $(".room_btn").removeClass("active");
                            node.addClass("active");
                            cur_room = house_id;
                            cur_price_disp.val((cur_price / 100).toFixed(2));

                            if(cur_total_day_disp.val() != 0)
                            {
                                cur_total_price_disp.val(((cur_price* cur_total_day_disp.val())/100).toFixed(2));
                            }
                        });
                    });
            }
        });
    </script>
</body>

</html>
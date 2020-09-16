<div>


    <h3 class="text-center">Menu</h3>

    <button class="btn user-btn btn-block btn-outline-primary text-center btn-nav"><i class="fa fa-desktop"></i> <input value="index" type="hidden"> Dashboard</a></button>
    <button class="btn user-btn btn-block btn-outline-primary btn-nav"><i class="fa fa-user"></i> <input value="profile" type="hidden"> My Profile</a></button>
    <button class="btn user-btn btn-block btn-outline-primary btn-nav"><i class="fa fa-file-o"></i> <input value="hostel-request" type="hidden"> Hostel Request</a></button>
    
    <button class="btn admin-btn btn-block btn-outline-primary text-center btn-nav"><i class="fa fa-desktop"></i> <input value="index" type="hidden"> Dashboard</a></button>
    <button class="btn admin-btn btn-block btn-outline-primary btn-nav"><i class="fa fa-user"></i> <input value="profile" type="hidden"> My Profile</a></button>
    <button class="btn admin-btn btn-block btn-outline-primary btn-nav"><i class="fa fa-file-o"></i> <input value="hostel-incoming-request" type="hidden"> Hostel Incoming Request</a></button>
    
    <button class="btn btn-block btn-outline-primary btn-logout"><i class="fa fa-sign-out" aria-hidden="true"></i>
        Log out
    </button>

</div>

<script>
    let session = {};
    let privilege = "";
    $.post("../backend/session.php", function(res) {
        console.log(res);
        session = res;
        if(res.login)
        {
            privilege = res.user_data.type;
            if(privilege === 'admin')
            {
                $(".user-btn").addClass("d-none");
            }
            else{
                $(".admin-btn").addClass("d-none");
            }
            
        }
        else{
            console.log("x login");
            window.location.href="../../hostelBooking/index.php";
        }
    }, "json")
    .done(function(){
        
    });
    $(".btn-nav").click(function() {
        let route = $(this).find("input").val();
        console.log(route);

        window.location.href = route + '.php';
    });

    $(".btn-logout").click(function() {
        $.post("../backend/logout.php", function(res) {
            if (res.status == "ok") {
                window.location.href = "../../hostelBooking/index.php";
            }
        }, "json");
    });
</script>
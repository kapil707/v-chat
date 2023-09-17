<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Login Form | CodingLab </title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
        <div class="form">
        <div class="title">Login</div>
        <div class="input-box underline">
          <input type="text" placeholder="Enter Your Email" required id="username">
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Enter Your Password" required id="password">
          <div class="underline"></div>
        </div>
        <label class="main_theme_gray_text">
            <input type="checkbox" checked id="checkbox" style="width:auto;"> I agree to the
        </label>
        <h5 class="text-center main_theme_gray_text submit_div" style="margin-top:10px;">&nbsp;</h5>
        <div class="input-box button">
          <input type="submit" value="Continue" class="mainbutton" name="Submit" onclick="submitbtn()" id="submitbtn">
        </div>
      </div>
        <div class="option">or Connect With Social Media</div>
        <div class="twitter">
          <a href="#"><i class="fab fa-twitter"></i>Sign in With Twitter</a>
        </div>
        <div class="facebook">
          <a href="#"><i class="fab fa-facebook-f"></i>Sign in With Facebook</a>
        </div>
    </div>
  </body>
</html>
<script>
function showpassword()
{
    $("#eyes1").hide();
    $("#eyes").show();
    document.getElementById("password1").type = 'text';
}
function hidepassword()
{
    $("#eyes1").show();
    $("#eyes").hide();
    document.getElementById("password1").type = 'password';
}
$('#username').on("keypress", function(e) {
    if (e.keyCode == 13) {
        submitbtn()
        return false; // prevent the button click from happening
    }
});
$('#password').on("keypress", function(e) {
    if (e.keyCode == 13) {
        submitbtn()
        return false; // prevent the button click from happening
    }
});
function submitbtn()
{
    username 	= $('#username').val();
    password	= $('#password').val();
    checkbox	= $('#checkbox').val();
    if(username=="")
    {
        swal("Enter username");
        $(".submit_div").html("<p class='text-danger'>Enter username</p>");
        $('#username').focus();
        return false;
    }
    if(password=="")
    {
        swal("Enter password");
        $(".submit_div").html("<p class='text-danger'>Enter password</p>");
        $('#password').focus();
        return false;
    }
    if($('#checkbox').is(':checked'))
    {
    }
    else
    {
        swal("Check terms of service");
        $(".submit_div").html("<p class='text-danger'>Check terms of service</p>");
        $('#checkbox').focus();
        return false;
    }

    $("#submitbtn").hide();
    $("#submitbtn_disable").show();
    $(".submit_div").html("Loading....");

    $.ajax({
        type       : "POST",
        data       : {username:username,password:password},
        url        : "{{URL::to('api/login_api')}}",
        cache	   : false,
        error:function(data){
            swal("Error")
            $(".submit_div").html("<p class='text-danger'>Error</p>");
            $("#submitbtn").show();
            $("#submitbtn_disable").hide();
        },
        success:function(data){
            if(data.status=="200" && data.islogin==true){
                $.each(data.items, function(i,item){
                    if (item)
                    {
                        $(".submit_div").html("<p class='text-success'>"+data.message+"</p>");
                        window.location.href = "<?php echo URL::to('home') ?>";
                    }
                });
            }

            if(data.status=="200" && data.islogin==false) {
                swal(data.message)
                $(".submit_div").html("<p class='text-danger'>"+data.message+"</p>");
                $("#submitbtn").show();
                $("#submitbtn_disable").hide();
            }
        },
        timeout: 10000
    });
}
</script>

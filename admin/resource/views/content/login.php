<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/custom.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/owl.carousel.css">
    <link rel="stylesheet" href="public/css/owl.theme.css">
    <link rel="stylesheet" href="public/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="public/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="public/css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="public/css/responsive.css">
    <title>Document</title>
</head>

<body class="login-body">
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-12 offset-md-5">
                <h2 class="text-center text-dark mt-5">Login Form</h2>
                <div class="text-center mb-5 text-dark">Made with bootstrap</div>
                <div class="card my-12">

                    <form class="card-body cardbody-color p-lg-5">

                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="Username" aria-describedby="emailHelp" placeholder="User Name">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" placeholder="password">
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                            Registered? <a href="#" class="text-dark fw-bold"> Create an
                                Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
			<form class="form-signin" method="post" action="">
				<div class="form-signin-heading text-center">
					<h1 class="sign-title"> Sign In </h1>
					<img class="disable" src="../public/assets/images/favicon/loginBackEnd.png" alt="" style="height: 126px;"/>
				</div>
				<div class="login-wrap">
					<input name="username" type="email" class="form-control" placeholder="Email ID" >
					<input name="password" type="password" class="form-control" placeholder="Password" >
					<button name="try_login" class="btn btn-lg btn-login btn-block" type="submit">
						<i class="fa fa-check"></i>
					</button>
					<div class="registration"> Not a member yet? <a href="registration.php"> Signup </a></div>
				</div>
			</form>
		</div>	
		
		<!--=*= JS FILES SOURCE START =*=-->
		<script src="./public/js/jquery-3.5.1.min.js"></script>
		<script src="./public/js/bootstrap.min.js"></script>
		<script src="./public/js/modernizr.min.js"></script>
</body>

</html>
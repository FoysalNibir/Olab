<!DOCTYPE html>
<html lang="en">
<head>
  <title>OPORAJEO</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="firstpage/images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="firstpage/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="firstpage/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="firstpage/vendor/animate/animate.css">
  <!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="firstpage/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="firstpage/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="firstpage/css/util.css">
  <link rel="stylesheet" type="text/css" href="firstpage/css/main.css">
  <style type="text/css">
  #infoi {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
  }
  #infoi {
    z-index: 10;
  }
</style>
<!--===============================================================================================-->
</head>
<body>

  <div class="limiter">
    <div class="container-login100">

      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="firstpage/images/img-01.png" alt="IMG">
        </div>

        <form class="login100-form validate-form" action="{{route('signup.post')}}" method="post">
          <span class="login100-form-title">
            Register Here
          </span>

          {{csrf_field()}}

          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="name" placeholder="Name">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="phone" placeholder="Phone">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-mobile" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">

            <button class="login100-form-btn">
              Register
            </button>
          </div>

          <div class="text-center p-t-12">
            <a class="txt2" href="{{route('login')}}">
              Have Account? Login
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a><br>
            <span class="txt1">
              Forgot
            </span>
            <a class="txt2" href="{{route('forgotpassword')}}">
              Password?
            </a>
          </div>

          
        </form>
      </div>
    </div>
  </div>
  
  

  
  <!--===============================================================================================-->  
  <script src="firstpage/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="firstpage/vendor/bootstrap/js/popper.js"></script>
  <script src="firstpage/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="firstpage/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="firstpage/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>
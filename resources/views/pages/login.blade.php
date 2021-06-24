<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FOCSystem | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>FOCS</b>ystem</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <h3 class="login-box-msg">Sign in</h3>
      
      <form action='{{ route("attempt") }}' method='POST'>
        
        @csrf
        
        <x-input name='username' type='text' placeholder='username' icon='fas fa-user'/>
        <x-input name='password' type='password' placeholder='password' icon='fas fa-lock'/>
        
        <div class="row">
          <div class="col-8"></div>
          <div class="col-4">
            <button name='submit' type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>CRUD</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="public/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/components.css">
 
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand"> 
                <img src="public/assets/img/health.svg" alt="logo" width="90"> 
            </div>

            <div class="card card-primary">
              

              <div class="card-body">
                <br><center><h4>SAMPLE CRUD</h4></center><br>

                @if (session('status'))
                    <div class="alert alert-danger" style="text-align:center;">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form class="form-horizontal" method="POST" action="{{ route('auth') }}">
                    {{ csrf_field() }}
                    

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="form-group">
                            <label for="email">Username</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                            Please fill in your username
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            <!-- <div class="float-right">
                                <a href="auth-forgot-password.html" class="text-small">
                                Forgot Password?
                                </a>
                            </div> -->
                            </div>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                            please fill in your password
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                        </button>
                    </div>

                </form>

              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Register One</a>
            </div> -->
            <div class="simple-footer">
              Copyright &copy; 2020
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


</body>
</html>
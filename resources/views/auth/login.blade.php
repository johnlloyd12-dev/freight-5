<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./assets/css/login.css" />
    <title>Sign in & Sign up Form</title>
  </head>
<body>

     <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <input type="submit" value="Login" class="btn solid" />
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
                Ready to ship with ease? Sign up now and experience seamless freight management!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign In
            </button>
          </div>
          <img src="./assets/img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
                Welcome aboard the kargada freight services! Join us and experience seamless shipping like never before.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="./assets/img/log.svg" class="image" alt="" />
        </div>
      </div>
    </div>

           
        </div>
       
            </div>
        </div>
    </div>
    <script src="./assets/js/login.js"></script>
</body>

</html>
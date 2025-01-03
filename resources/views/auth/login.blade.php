<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page | {{config('app.name')}}</title>
    <!-- plugins:css -->
    @include('auth.includes.css')

    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{Vite::asset('resources/assets/images/favicon.png')}}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3 text-center">Login</h3>
                            <form method="post" action="{{route('login')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control p_input">
                                    @error('email')
                                    <p class="text-danger">{{ $message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control p_input">
                                    @error('password')
                                    <p class="text-danger">{{ $message}}</p>
                                    @enderror
                                </div>
                            
                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="remember" class="form-check-input"> Remember me </label>
                                        @error('remember')
                                        <p class="text-danger">{{ $message}}</p>
                                        @enderror
                                    </div>
                                    <a href="#" class="forgot-pass">Forgot password</a>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-facebook col mr-2">
                                        <i class="mdi mdi-facebook"></i> Facebook </button>
                                    <button class="btn btn-google col">
                                        <i class="mdi mdi-google-plus"></i> Google plus </button>
                                </div>
                                <p class="sign-up text-center">Don't have an Account?<a href="{{route('register')}}"> Sign In</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    @include('auth.includes.js')
</body>

</html>
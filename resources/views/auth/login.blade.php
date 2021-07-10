
<!DOCTYPE html>
<html lang="en" >
    <!--begin::Head-->
    <head>
        <meta charset="utf-8"/>
        <title>Admin | Login Page</title>
        <meta name="description" content="Login page example"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <link href="/adm/css/login-5.css?v=7.0.6" rel="stylesheet" type="text/css"/>
        <link href="/adm/css/plugins.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
        <link href="/adm/css/prismjs.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
        <link href="/adm/css/style.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>

        <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>

            </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="header-fixed subheader-enabled page-loading"  >

    	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
<div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
	<div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(/images/bg-5.jpg);">
		<div class="login-form text-center text-white p-7 position-relative overflow-hidden">

			<!--begin::Login Sign in form-->
			<div class="login-signin">
				<div class="mb-20">
					<h3 class="font-weight-normal">Login Admin</h3>
				</div>
				<form class="form" id="kt_login_signin_form" method="POST" action="{{ route('login') }}">
                    @csrf
					<div class="form-group">
						<input class="form-control @error('email') is-invalid @enderror h-auto text-white bg-white-o-5 rounded-pill border-3 py-4 px-8" type="email" placeholder="Email" name="email" autocomplete="off"/>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
					<div class="form-group">
						<input class="form-control @error('password') is-invalid @enderror h-auto text-white bg-white-o-5 rounded-pill border-3 py-4 px-8" type="password" placeholder="Password" name="password"/>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
					<div class="form-group text-center mt-10">
						<button type="submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Masuk</button>
					</div>
				</form>
				<div class="mt-10">
					<a href="javascript:;" id="kt_login_signup" class="text-white font-weight-normal">Sign Up</a>
				</div>
			</div>
			<!--end::Login Sign in form-->

			<!--begin::Login Sign up form-->
			<div class="login-signup">
				<div class="mb-20">
					<h3 class="font-weight-normal">Daftar Akun</h3>
				</div>
				<form class="form text-center" id="kt_login_signup_form" method="POST" action="{{ route('register') }}">
                    @csrf
					<div class="form-group ">
						<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-3 py-4 px-8 @error('name') is-invalid @enderror" type="text" placeholder="name"  name="name" value="{{ old('name') }}" required/>

                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>
					<div class="form-group">
						<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-3 py-4 px-8 @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" required/>

                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>
					<div class="form-group">
						<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-3 py-4 px-8 @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" autocomplete="new-password" required/>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
					</div>
					<div class="form-group">
						<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-3 py-4 px-8" type="password" placeholder="Confirm Password" name="password_confirmation" autocomplete="new-password" required/>

                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
					</div>
					<div class="form-group text-left px-8">
						<div class="form-text text-muted text-center"></div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Sign Up</button>
						<button id="kt_login_signup_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Cancel</button>
					</div>
				</form>
			</div>
			<!--end::Login Sign up form-->
		</div>
	</div>
</div>
<!--end::Login-->
	</div>
<!--end::Main-->
        <!--end::Global Config-->

    	<!--begin::Global Theme Bundle(used by all pages)-->
        <script src="/adm/js/plugins.bundle.js?v=7.0.6"></script>
        <script href="/adm/js/prismjs.bundle.js?v=7.0.6"></script>
        <script src="/adm/js/scripts.bundle.js?v=7.0.6"></script>
				<!--end::Global Theme Bundle-->


                    <!--begin::Page Scripts(used by this page)-->
                            <script src="/adm/js/login-general.js?v=7.0.6"></script>
                        <!--end::Page Scripts-->

    
            </body>
    <!--end::Body-->
</html>

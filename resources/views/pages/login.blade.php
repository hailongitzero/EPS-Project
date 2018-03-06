<?php
/**

 */?>
        <!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        EPS - Thư viện điện tử
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <!--begin::Web font -->
    <script src="/resources/assets/js/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Roboto:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="/resources/assets/css/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/resources/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="/resources/assets/images/logo/favicon%20(2).ico" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(/resources/assets/images/bg/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo" style="margin-bottom: 30px">
                    <a href=#">
                        <img src="/resources/assets/images/logo/logo.png">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title" style="font-family:'Roboto';color: #1D4589;font-weight: bold;font-size: 35px">
                            ĐĂNG NHẬP
                        </h3>
                        <div class="error">
                            @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <form class="m-login__form m-form"   method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group m-form__group {{ $errors->has('username') ? ' has-error' : '' }}">
                            <input class="form-control m-input"   type="text" placeholder="Tên đăng nhập" name="username" autocomplete="off" value="{{ old('username') }}" required autofocus>
                        </div>
                        <div class="form-group m-form__group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Mật khẩu" name="password">
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--focus" style="font-family: Roboto">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Ghi nhớ
                                    <span></span>
                                </label>
                            </div>
                            <div class="col m--align-right m-login__form-right" style="font-family: Roboto">
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                    Quên mật khẩu ?
                                </a>
                            </div>
                        </div>
                        <div class="m-login__form-action" style="margin-top: 10px">
                            <button id="m_login_signin_submit" style="font-family: Roboto" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
                <div class="m-login__signup">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Đăng ký
                        </h3>
                        <div class="m-login__desc">
                            Enter your details to create your account:
                        </div>
                    </div>
                    <form class="m-login__form m-form" action="login-3.html">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname" >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                        </div>
                        <div class="row form-group m-form__group m-login__form-sub">
                            <div class="col m--align-left">
                                <label class="m-checkbox m-checkbox--focus">
                                    <input type="checkbox" name="agree">
                                    I Agree the
                                    <a href="login-3.html#" class="m-link m-link--focus">
                                        terms and conditions
                                    </a>
                                    .
                                    <span></span>
                                </label>
                                <span class="m-form__help"></span>
                            </div>
                        </div>
                        <div class="m-login__form-action" style="margin-top: 10px">
                            <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
                                Sign Up
                            </button>
                            &nbsp;&nbsp;
                            <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
                <div class="m-login__forget-password">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Forgotten Password ?
                        </h3>
                        <div class="m-login__desc">
                            Enter your email to reset your password:
                        </div>
                    </div>
                    <form class="m-login__form m-form" action="login-3.html">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                        </div>
                        <div class="m-login__form-action" style="margin-top: 10px">
                            <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">
                                Request
                            </button>
                            &nbsp;&nbsp;
                            <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
                {{--<div class="m-login__account" style="font-family: Roboto">--}}
							{{--<span class="m-login__account-msg">--}}
								{{--Bạn chưa có tài khoản ?--}}
							{{--</span>--}}
                    {{--&nbsp;&nbsp;--}}
                    {{--<a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">--}}
                        {{--Đăng ký--}}
                    {{--</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="/resources/assets/js/vendors.bundle.js" type="text/javascript"></script>
<script src="/resources/assets/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Snippets -->
{{--<script src="http://keenthemes.com/metronic/preview/default/html/assets/snippets/pages/user/login.js" type="text/javascript"></script>--}}
<!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>


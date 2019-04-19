<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Aplikasi Keuangan Badan usaha milik Ohoi (Bumo) kabupaten maluku tenggara">
<meta itemprop="description" content="Aplikasi Keuangan Badan usaha milik Ohoi (Bumo) kabupaten maluku tenggara">
<title>Login | Quick</title>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toast') }}r.min.css">

<script src="{{ asset('assets/js/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fill.box.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

</head>

<body>

<div id="main">

    <section class="main-login--page">
        <div class="login-wrapper left-content">
            <div class="login-logo">
                QuickCount
            </div>
            <div class="login-content--wrapper">
                <h1 class="login-title">
                    <b>Quick</b><br>Monitor Data Pemilihan<br>Cepat,Mudah,Realtime
                </h1>
            </div><!-- login-content--wrapper -->
            {{-- <footer class="login-footer">
                Lorem Ipsum is simply dummy text ofthe printing<br>and typesetting industry.
            </footer> --}}
        </div>
        <div class="login-wrapper right-content">
            <div class="login-content--wrapper">
                <h2>Sign In</h2>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <span class="icon ti-email"></span>
                        <input class="form-control login-form" type="email" placeholder="Email" required name="email" value="{{ old("email") }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <span class="icon ti-lock"></span>
                        <input class="form-control login-form" type="password" placeholder="Password" required name="password">
                    </div>
                    <button type="submit" class="btn btn-primary login-btn">Sign In</button>
                </form>
            </div>
        </div>
    </section>
    
</div><!-- main -->

</body>
@if(count($errors->all()) > 0)
<script>
    toastr.error('<h5>Maaf</h5><span>Email atau Password yang anda masukan salah</span>');
    toastr.options = {
        "timeOut": "6000",
        "positionClass": "toast-bottom-right",
        "closeButton": true,    
    }
    toastr.options.closeHtml = '<button><i class="ti-close"></i></button>';
</script>
@endif
</html>

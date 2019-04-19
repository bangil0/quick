<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Aplikasi Keuangan Badan usaha milik Ohoi (Bumo) kabupaten maluku tenggara">
<meta itemprop="description" content="Aplikasi Keuangan Badan usaha milik Ohoi (Bumo) kabupaten maluku tenggara">
<title>Daftar | Quick</title>

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
            </div>
        </div>
        <div class="login-wrapper right-content">
            <div class="login-content--wrapper">
                <h2>Daftar</h2>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <span class="icon ti-credit-card"></span>
                        <input class="form-control login-form" type="nip" placeholder="NIP" required name="nip" value="{{ old("nip") }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <span class="icon ti-user"></span>
                        <input class="form-control login-form" type="name" placeholder="Nama Lengkap" required name="name" value="{{ old("name") }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <span class="icon ti-calendar"></span>
                        <input class="form-control login-form" type="date" placeholder="Tanggal Lahir" required name="date_of_birth" value="{{ old("date_of_birth") }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <span class="icon ti-email"></span>
                        <input class="form-control login-form" type="email" placeholder="Email" required name="email" value="{{ old("email") }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <span class="icon ti-lock"></span>
                        <input class="form-control login-form" type="password" placeholder="Kata Sandi" required name="password">
                    </div>
                    <div class="form-group">
                        <span class="icon ti-lock"></span>
                        <input class="form-control login-form" type="password" placeholder="Konfirmasi Kata Sandi" required name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <span class="icon ti-map-alt"></span>
                        <input class="form-control login-form" type="text" placeholder="Alamat" required name="address" value="{{ old('address') }}">
                    </div>
                    <button type="submit" class="btn btn-primary login-btn">Daftar Sekarang</button>
                </form>
            </div>
        </div>
    </section>
    
    
</div><!-- main -->

</body>
@if(count($errors->all()) > 0)
@foreach($errors->all() as $error)
<script>
    toastr.error("{{ $error }}");
    toastr.options = {
        "timeOut": "6000",
        "positionClass": "toast-bottom-right",
        "closeButton": true,    
    }
    toastr.options.closeHtml = '<button><i class="ti-close"></i></button>';
</script>
@endforeach
@endif
</html>

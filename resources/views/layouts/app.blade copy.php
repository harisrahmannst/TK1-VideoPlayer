<!DOCTYPE html>
<html>

<head>
  <title>@yield('title')</title>
  <link href="{{ asset('css/fa.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <link rel="shortcut icon" href="{{asset('image/icon.png')}}" type="image/x-icon">
</head>

<body data-spy="scroll" data-target="#navbar">
  <header>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <img src="{{asset('image/logo.png')}}" class="img-fluid" alt="logo" style="height: 42px;"">
        <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#jadwal">Jadwal Belajar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#paket">Paket Jasa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Trainer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Kendaraan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Lokasi dan Kontak</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  @yield('content')
  <div class="container-fluid footer-section">
    <div class="container text-center">
      <div class="col-xs-12 col-md-12">
        &copy; 2023 CDT - Car Driving Training. All Rights Reserved.
      </div>
    </div>
  </div>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
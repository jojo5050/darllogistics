<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{route('home.index')}}"><img src="{{asset('images/logo-white.png')}}" style="width: 50px" alt="Darl Transport"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="{{route('home.index')}}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('home.about')}}">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('home.dispatch')}}">Dispatch</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Compliance</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Training</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('home.contact')}}">Contact</a></li>
      </ul>
      <a href="#" class="btn btn-primary ms-lg-3">Get Started</a>
    </div>
  </div>
</nav>

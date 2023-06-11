
<style>

body {
	background-color: #14171c !important;
	font-family: colaborate-thinregular,sans-serif;
	letter-spacing: 2px;
	text-transform: uppercase;
	width: 100vw;
	overflow-y: scroll;
	overflow-x: hidden !important;
	height: 100vh; 
}

.bg-dark-custom {
  background-color: #0d1017;
}

nav {
  border-bottom: 1px solid #333;
}

.dropdown-dark {
	background-color: #14171c !important;
  border: 1px solid #333;
}

.dropdown-dark a {
  color: #6f6f6f;
}

.dropdown-menu > a:hover {
  background-image: none;
  background-color: #1a1e25;
  color: #bbbaba;
}
@media (min-width: 1300px) {
	.container {
		min-width: 1250px !important;
	}
}

@media (min-width: 1500px) {
	.container {
		min-width: 1450px !important;
	}
}
</style>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark-custom">
  <div class="container">
  <!-- <a class="navbar-brand" href="#">Navbar w/ text</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a href="/cod4/serverlist" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none navbar-text">
      <img src="/Images/rextrus_avatar.png" width="32px" height="32px" alt="Rextrus" style="margin-right: 15px;">
      Rextrus.com
    </a>

    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav ml-auto">
        {{-- <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link" href="/aboutme/timeline">about me</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            CJ  
          </a>
          <div class="dropdown-menu dropdown-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/cod4/serverlist">servers</a>
            <a class="dropdown-item" href="/cod4/map">maps</a>
            <a class="dropdown-item" href="/cod4/player">players</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

{{-- <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark" role="navigation">
  <div class="container">

  </div>
</nav> --}}
<style>

body {
	/* background-color: #14171c !important; */
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

.padding-0{
    padding-right:0;
    /* padding-left:0; */
}

.rextrus-dark {
  background: #1a1c28;
}

.invert-color {
  filter: invert(80%);
}
.nav-pills .nav-link.active {
  background-color: rgba(15, 17, 28, 0.6);
}
</style>

{{-- <div class="container-fluid"> --}}
  <div class="row" > 
    {{-- <div class=""> --}}
      <div class="col-1 d-flex flex-column flex-shrink-0 rextrus-dark padding-0" style="max-width:90px;  overflow-y: scoll; top:0; bottom:0; position: fixed;border-right: solid 1px #bbbaba;">
        <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
          <img width="40" height="40" src="/Images/rextrus_avatar.png" alt="rextrus_avatar">
          {{-- <svg class="bi" width="40" height="32"><use xlink:href="#bootstrap"></use></svg> --}}
          <span class="visually-hidden">Icon-only</span>
        </a>
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
          <li class="nav-item">
            <a href="/cod4/serverlist" class="nav-link py-3 border-bottom {{ (request()->is('cod4/serverlist*')) ? 'active' : '' }}" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
              {{-- <svg class="bi" width="24" height="24" role="img" aria-label="Home"><use xlink:href="#home"></use></svg> --}}
              <img class="invert-color" width="30" height="30" src="/Images/icons/server.png" alt="Serverlist">
            </a>
          </li>
          <li>
            <a href="/cod4/map" class="nav-link py-3 border-bottom {{ (request()->is('cod4/map*')) ? 'active' : '' }}" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
              {{-- <svg class="bi" width="24" height="24" role="img" aria-label="Dashboard"><use xlink:href="#speedometer2"></use></svg> --}}
              <img class="invert-color" width="24" height="24" src="/Images/icons/map.png" alt="Maps">
            </a>
          </li>
          <li>
            <a href="/cod4/player" class="nav-link py-3 border-bottom {{ (request()->is('cod4/player*')) ? 'active' : '' }}" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
              {{-- <svg class="bi" width="24" height="24" role="img" aria-label="Orders"><use xlink:href="#table"></use></svg> --}}
              <img class="invert-color" width="28" height="28" src="/Images/icons/runner.png" alt="Player">
            </a>
          </li>
          <li>
            <a href="/cod4/leaderboard" class="nav-link py-3 border-bottom {{ (request()->is('cod4/leaderboard*')) ? 'active' : '' }}" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
              {{-- <svg class="bi" width="24" height="24" role="img" aria-label="Orders"><use xlink:href="#table"></use></svg> --}}
              <img class="invert-color" width="24" height="24" src="/Images/icons/leaderboard.png" alt="leaderboard">
            </a>
          </li>
        </ul>
        {{-- <div class="dropdown border-top">
          <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div> --}}
      {{-- </div> --}}
    </div>

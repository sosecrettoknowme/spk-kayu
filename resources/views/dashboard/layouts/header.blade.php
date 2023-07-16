<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color: rgb(44, 44, 24)">
  <img src="https://th.bing.com/th/id/OIP.huXPH2TskDVx0YGMzIDWTgHaEP?w=292&h=180&c=7&r=0&o=5&dpr=1.2&pid=1.7" alt="" width="50px" class="ms-4">
  <a class="navbar-brand col-md-3 col-lg-2 ms-0 px-3" href="#">SPK-MOORA</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="nav-link px-3 border-0" style="background-color:darkred; color:white">Logout <span data-feather="log-out"></span></button>
        </form>
      </div>
    </div>
  </header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('home')}}">Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{route('info.create')}}">Thông tin</a>
      </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('category.create')}}">Danh mục phim</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('genre.create')}}">Thể loại</a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" href="{{route('country.create')}}">Quốc gia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('movie.index')}}">Phim</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('episode.create')}}">Tập phim</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('leech-movie')}}">Leech phim</a>
      </li>
     
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm phim</button>
    </form>
  </div>
</nav>
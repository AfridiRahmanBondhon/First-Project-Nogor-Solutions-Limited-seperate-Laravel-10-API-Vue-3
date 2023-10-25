<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Menu Bar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">View Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('add')}}">Add Data</a>
            </li>
            <li class="nav-item float-end">
                <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logOutForm').submit()">Log Out</a>
                <form action="{{ route('logout')  }}" method="post" id="logOutForm">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary-color">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navToggler" aria-controls="navToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navToggler">
        <ul class="navbar-nav text-uppercase font-weight-bold">
            <li class="nav-item {{ Route::current()->getName() == 'new-paint.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('new-paint.index') }}">New Paint Job</a>
            </li>
            <li class="nav-item {{ Route::current()->getName() == 'paint.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('paint.index') }}">Paint Jobs</a>
            </li>
        </ul>
    </div>
</nav>
<nav class="main-header navbar navbar-expand navbar-light" style="border: none;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="https://thumbs.dreamstime.com/b/icon-profile-circle-not-shadow-color-dark-blue-icon-profile-circle-not-shadow-color-dark-blue-background-194699290.jpg"
                    class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ \Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header">
                    <img src="https://thumbs.dreamstime.com/b/icon-profile-circle-not-shadow-color-dark-blue-icon-profile-circle-not-shadow-color-dark-blue-background-194699290.jpg"
                        class="img-circle elevation-2" alt="User Image"><br>
                    <p>{{ \Auth::user()->email }}</p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('student.profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

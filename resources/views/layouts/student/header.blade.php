<nav class="main-header navbar navbar-expand navbar-light" style="border: none; border-radius: 5px">
    {{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light"> --}}
    <ul class="navbar-nav" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
    {{-- <ul class="navbar-nav"> --}}
        <li class="nav-item">
            {{-- <a class="nav-link" id="pushMenuToggle" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> --}}
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
        <li class="nav-item dropdown user-menu" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="https://thumbs.dreamstime.com/b/icon-profile-circle-not-shadow-color-dark-blue-icon-profile-circle-not-shadow-color-dark-blue-background-194699290.jpg"
                    class="user-image img-circle elevation-2" alt="User Image">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                    <img src="https://uploads-ssl.webflow.com/618858d8887e82559e959825/6219fed92de7e6b72f4db7af_profile%20pic.jpg"
                        class="img-circle elevation-2 custom-size-img" alt="User Image" style="margin-top: 5%"><br>
                    <p class="text-center" style="font-size: 12px">
                        @isset(\Auth::user()->name)
                            {{ \Auth::user()->name }}<br>
                        @endisset
                        <span class="email">
                            <span>{{ \Auth::user()->email }}</span>
                        </span>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer text-center" style="border-radius: 5px; display: inline-block; width: 100%;">
                    <div class="mb-2">
                        <a href="#" class="btn btn-default btn-flat change-pass"
                            style="border-radius: 5px; width: 100%;"><i class="fa-solid fa-lock"></i> Change
                            Password</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-default btn-flat logout-link"
                            style="border-radius: 5px; width: 100%;"><i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>

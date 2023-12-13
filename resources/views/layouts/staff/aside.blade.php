<aside class="main-sidebar elevation-4">
    <a href="#" class="pn-logo brand-link">
        <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt="IOMS Logo" class="brand-image"
            style="max-height: 100px; width: auto; margin:auto; max-width: 100%;">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false" style="color: #ffff;">
                <li class="nav-item">
                    <a href="{{ route('students.index') }}"
                        class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}" style="text-decoration: none;">
                        <i class="nav-icon fas fa-home" style="color: #ffff"></i>
                        <p style="color: #ffff">Students</p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('rpt.*') ? 'active' : '' }}" href="#" id="report-dropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration:none;">
                        <i class="nav-icon fa fa-file-text" style="color: #ffff;"></i>
                        <p style="color: #ffff;"> Reports</p>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="report-dropdown">
                        <li><a class="dropdown-item" href="{{ route('rpt.acd.index') }}">Academic</a></li>
                        <li><a class="dropdown-item" href="{{ route('rpt.dcpl.index') }}">Disciplinary</a></li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('staff.closingOfAccounts') }}" class="nav-link {{ request()->routeIs('staff.closingOfAccounts') ? 'active' : '' }}" style="text-decoration: none">
                        <i class="nav-icon fas fa-briefcase" style="color:#fff"></i>
                        <p style="color:#fff">COA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link logout-link" style="color: #ffff; text-decoration:none;">
                        <i class="nav-icon fa-solid fa-right-from-bracket" style="color: #ffff;"></i>
                        <p style="color: #ffff;">Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<div id="sidebar-overlay"></div>

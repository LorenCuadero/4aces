<aside class="main-sidebar elevation-4">
    <a href="#" class="pn-logo brand-link">
        <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt="IOMS Logo" class="brand-image"
            style="max-height: 100px; width: auto; margin:auto; max-width: 100%;">
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" style="text-decoration: none">
                        <i class="nav-icon fas fa-home" style="color:#fff"></i>
                        <p style="color:#fff">Dashboard</p>
                    </a>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('admin.financialReports') }}" class="nav-link {{ request()->routeIs('admin.financialReports') ? 'active' : '' }}" style="text-decoration: none">
                        <i class="nav-icon fa fa-file-text" style="color:#fff"></i>
                        <p style="color:#fff">Reports</p>
                    </a>
                </li>
                <li class=" nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.records.*') ? 'active' : ''}}" href="#" id="report-dropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="text-decoration: none; color:#fff">
                        <i class="nav-icon fa-solid fa-folder"></i>
                        <p style="color:#fff">Records</p>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="report-dropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.records.counterpartRecords') }}">Counterpart</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.records.medicalShare') }}">Medical</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.records.personalCA') }}">Personal CA</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.records.graduationFees') }}">Graduation Fees</a></li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('admin.closingOfAccounts') }}" class="nav-link {{ request()->routeIs('admin.closingOfAccounts') ? 'active' : '' }}" style="text-decoration: none">
                        <i class="nav-icon fas fa-briefcase" style="color:#fff"></i>
                        <p style="color:#fff">COA</p>
                    </a>
                </li>
                <li class=" nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.mail.*') ? 'active' : '' }}" href="#" id="report-dropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="text-decoration: none; color:#fff">
                        <i class="nav-icon fa-solid fa-envelope"></i>
                        <p style="color:#fff">Email</p>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="report-dropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.mail.email') }}">SOA</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.mail.coa') }}">COA</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.mail.customizedEmail') }}">Customize</a></li>
                    </ul>
                </li>
                <li class=" nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}" href="#" id="report-dropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="text-decoration: none; color:#fff">
                        <i class="nav-icon 	fas fa-users"></i>
                        <p>Accounts</p>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="report-dropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.accounts.admin-accounts') }}">Admin</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.accounts.staff-accounts') }}">Staff</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.accounts.student-accounts') }}">Students</a></li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a href="{{ route('admin.logs') }}" class="nav-link {{ request()->routeIs('admin.logs') ? 'active' : '' }}" style="text-decoration: none">
                        <i class="nav-icon fa-solid fa-clock-rotate-left" style="color:#fff"></i>
                        <p style="color: #fff">Logs</p>
                    </a>
                </li>
                <li class=" nav-item">
                    <a href="#" class="nav-link logout-link" style="text-decoration: none; color: #ffff">
                        <i class="nav-icon fa-solid fa-right-from-bracket" style="color: #ffff;"></i>
                        <p style="color: #fff">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<div id="sidebar-overlay"></div>

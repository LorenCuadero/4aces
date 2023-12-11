<aside class="main-sidebar elevation-4">
    {{-- <aside class="main-sidebar sidebar sidebar-dark-primary elevation-4">
    <a href="#"><i class="fas fa-times custom-close" id="closeSidebarIcon"></i></a> --}}
    <a href="#" class="pn-logo brand-link">
        <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt="IOMS Logo" class="brand-image"
            style="max-height: 100px; width: auto; margin:auto; max-width: 100%;">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('payable.index') }}" style="text-decoration: none" class="nav-link">
                        <i class="fas fa-coins" style="color: #ffff"></i>
                        <p style="color:#ffff">Payable</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.payments.index') }}" style="text-decoration: none" class="nav-link">
                        <i class="fas fa-money-bill-wave" style="color: #ffff"></i>
                        <p style="color:#ffff">Payment</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.profile.index') }}" style="text-decoration: none" class="nav-link">
                        <i class="fa-solid fa-folder" style="color: #ffff"></i>
                        <p style="color:#ffff">Profile & Reports</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link logout-link" tyle="text-decoration: none">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ffff"></i>
                        <p style="color:#ffff">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<div id="sidebar-overlay"></div>

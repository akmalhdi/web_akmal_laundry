<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="?page=dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <div>
            <span class="text-secondary opacity-75">-- Admin --</span>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?page=user">
                            <i class="bi bi-circle"></i><span>Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="?page=level">
                            <i class="bi bi-circle"></i><span>Levels</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="?page=customer">
                            <i class="bi bi-circle"></i><span>Customers</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="?page=service">
                            <i class="bi bi-circle"></i><span>Services</span>
                        </a>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Master Data Nav -->

        <div>
            <span class="text-secondary opacity-75">-- Operator --</span>
            <a class="nav-link collapsed" href="?page=transaction">
                <i class="bi bi-journal-text"></i><span>Transactions</span>
            </a>
        </div>
        <!-- End Transaction Nav -->
        <div>
            <span class="text-secondary opacity-75">-- Pimpinan --</span>
            <li class="nav-item">
                <a class="nav-link collapsed" href="?page=report">
                    <i class="bi bi-journal-text"></i><span>Reports</span>
                </a>
            </li>
        </div>
        <!-- End Transaction Nav -->
    </ul>

</aside>
<!-- End Sidebar-->
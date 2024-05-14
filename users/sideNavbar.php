<aside id="sidebar">
        <div class="d-flex">
            <button id="toggle-btn" type="button">
                <i class="fa-brands fa-windows"></i>
            </button>
            <div class="sidebar-logo">
                <a href="dashboard.php">PhilFutureLife</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="dashboard.php" class="sidebar-link">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="profile.php" class="sidebar-link">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="attendance.php" class="sidebar-link">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <span>Attendance</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#record" aria-expanded="false" aria-controls="record">
                    <i class="fa-solid fa-clipboard"></i>
                    <span>Records</span>
                </a>
                <ul id="record" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Attendance Log</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Tardiness</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Leaves</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                    <i class="fa-solid fa-bars"></i>
                    <span>Request</span>
                </a>
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                            Category
                        </a>
                        <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Leave Request</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Office Supplies</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-award"></i>
                    <span>HR Manual</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Task</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fa-regular fa-message"></i>
                    <span>Document Tracker</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
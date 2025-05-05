<aside class="app-sidebar bg-body-secondary shadow"  data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="https://img.freepik.com/premium-vector/modern-digital-futuristic-hexagon-world-globe-link-network-internet-logo-design_358185-214.jpg"
                alt="Digital World"
                class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Digital World</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item menu-open">
                    <a href='{{ route('dashboard') }}' class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(auth()->user()->user_type === "purchase")
                    <li class="nav-item">
                        <a href="{{ route('purchase-coins') }}" class="nav-link">
                            <i class="nav-icon bi bi-grip-horizontal"></i>
                            <p>Purchase coins</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('purchase-coins') }}" class="nav-link">
                            <i class="nav-icon bi bi-grip-horizontal"></i>
                            <p>Purchase history</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('apply-video') }}" class="nav-link">
                            <i class="nav-icon bi bi-star-half"></i>
                            <p>Apply coins</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('video-history') }}" class="nav-link">
                            <i class="nav-icon bi bi-star-half"></i>
                            <p>Apply history</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-in-right"></i>
                            <p>
                                Profile setting
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('see.video') }}" class="nav-link">
                            <i class="nav-icon bi bi-grip-horizontal"></i>
                            <p>View video</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('viewer.video.history') }}" class="nav-link">
                            <i class="nav-icon bi bi-grip-horizontal"></i>
                            <p>View history</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-grip-horizontal"></i>
                            <p>Balance Details</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-in-right"></i>
                            <p>
                                Profile setting
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                @endif

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>

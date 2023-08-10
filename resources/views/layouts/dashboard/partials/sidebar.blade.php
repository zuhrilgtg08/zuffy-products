<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ url('/admin/manage_dashboard') }}">
                        <i class="fas fa-fw fa-tasks text-primary"></i>
                        Dashboard
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div> 
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ isset($sbActive) && $sbActive === 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/admin/manage_dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title">Data</li>

                <li class="sidebar-item {{ isset($sbMaster) && $sbMaster === true ? 'active' : ''}} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-archive-fill"></i>
                        <span>Master</span>
                    </a>
                    <ul class="submenu {{ isset($sbMasterSubMenu) && $sbMasterSubMenu === true ? 'active' : '' }}">
                        <li class="submenu-item {{ isset($sbList) && $sbList === 'data.product' ? 'active' : '' }}">
                            <a href="{{ route('admin.products.index') }}">Products</a>
                        </li>
                        <li class="submenu-item {{ isset($sbList) && $sbList === 'data.category' ? 'active' : '' }}">
                            <a href="{{ route('admin.categories.index') }}">Categories</a>
                        </li>
                        <li class="submenu-item {{ isset($sbList) && $sbList === 'data.worker' ? 'active' : '' }}">
                            <a href="{{ route('admin.workers.index') }}">Workers</a>
                        </li>
                        <li class="submenu-item {{ isset($sbList) && $sbList === 'data.review' ? 'active' : '' }}">
                            <a href="{{ route('admin.reviews.index') }}">Reviews</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Orders</li>
                
                <li class="sidebar-item {{ isset($sbCheckout) && $sbCheckout === true ? 'active' : ''}} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Customers</span>
                    </a>
                    <ul class="submenu {{ isset($sbSubMenuCheckout) && $sbSubMenuCheckout === true ? 'active' : '' }}">
                        <li class="submenu-item {{ isset($sbListCheckout) && $sbListCheckout === 'data.checkout' ? 'active' : '' }}">
                            <a href="{{ route('admin.checkout.list') }}">Checkouts</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
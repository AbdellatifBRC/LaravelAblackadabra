<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('homepage')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Homepage</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
             <!-- Heading -->
             <div class="sidebar-heading">
                Boutique
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Management Product</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.categories.index') }}">Category</a>
                        <a class="collapse-item" href="{{ route('admin.tags.index') }}">Tag</a>
                        <a class="collapse-item" href="{{ route('admin.products.index') }}">Product</a>
                        <a class="collapse-item" href="{{ route('admin.orders.index') }}">Orders</a>
                    </div>
                </div>
            </li>

             <!-- Divider -->
             <hr class="sidebar-divider">

             <!-- Nav Item - Utilities Collapse Menu -->
              <!-- Heading -->
            <div class="sidebar-heading">
                 Vitrine
            </div>
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Parametres Vitrine</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Utilities:</h6>
                        <a class="collapse-item" href="{{route('admin.vitrine.index')}}">E-vitrine</a>
                        <a class="collapse-item" href="utilities-border.html">Messages</a>
                        <a class="collapse-item" href="utilities-animation.html">Taches</a>
                        <a class="collapse-item" href="utilities-other.html">Utilisateurs</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

             <!-- Sidebar Toggler (Sidebar) -->
             <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('admin')}}">
      <div class="sidebar-brand-icon rotate-n-15">
         <i class="fas fa-paw"></i>
      </div>
      <div class="sidebar-brand-text mx-3">PeTopia</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ isset($active) && in_array('dashboard', $active) ? 'active' : '' }}">
      <a class="nav-link" href="{{url('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ isset($active) && in_array('products', $active) ? 'active' : '' }}">
      <a class="nav-link {{ isset($active) && in_array('products', $active) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
        <i class="fas fa-cat"></i>
        <span>Products</span>
      </a>
      <div id="collapseProducts" class="collapse {{ isset($active) && in_array('products', $active) ? 'show' : '' }}" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ isset($active) && in_array('pets', $active) ? 'active' : '' }}" href="{{url('/admin/pets')}}">Pets</a>
          <a class="collapse-item {{ isset($active) && in_array('foods', $active) ? 'active' : '' }}" href="{{url('/admin/foods')}}">Foods</a>
          <a class="collapse-item {{ isset($active) && in_array('drugs', $active) ? 'active' : '' }}" href="{{url('/admin/drugs')}}">Drugs</a>
          <a class="collapse-item {{ isset($active) && in_array('supplies', $active) ? 'active' : '' }}" href="{{url('/admin/supplies')}}">Supplies</a>
        </div>
      </div>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ isset($active) && in_array('system_setup', $active) ? 'active' : '' }}">
      <a class="nav-link {{ isset($active) && in_array('system_setup', $active) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseSystemSetup" aria-expanded="true" aria-controls="collapseSystemSetup">
        <i class="fas fa-cog"></i>
        <span>System Setup</span>
      </a>
      <div id="collapseSystemSetup" class="collapse {{ isset($active) && in_array('system_setup', $active) ? 'show' : '' }}" aria-labelledby="headingSystemSetup" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ isset($active) && in_array('pet_types', $active) ? 'active' : '' }}" href="{{url('/admin/pet_types')}}">Pet Types</a>
          <a class="collapse-item {{ isset($active) && in_array('food_types', $active) ? 'active' : '' }}" href="{{url('/admin/food_types')}}">Food Types</a>
          <a class="collapse-item {{ isset($active) && in_array('medical_vaccinations', $active) ? 'active' : '' }}" href="{{url('/admin/medical_vaccinations')}}">Vaccinations</a>
        </div>
      </div>
    </li>


    <!-- Nav Item - Services Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices">
        <i class="fas fa-concierge-bell"></i>
        <span>Services</span>
      </a>
      <div id="collapseServices" class="collapse" aria-labelledby="headingServices" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Custom Services:</h6>
          <a class="collapse-item" href="#">Transportation</a>
          <a class="collapse-item" href="#">Shelter finder</a>
          <a class="collapse-item" href="#">Housing</a>
          <a class="collapse-item" href="#">Aquarium</a>
          <a class="collapse-item" href="#">Grooming</a>
          <a class="collapse-item" href="#">Training</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Orders Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true" aria-controls="collapseOrders">
        <i class="fas fa-truck-moving"></i>
        <span>Orders</span>
      </a>
      <div id="collapseOrders" class="collapse" aria-labelledby="headingOrders" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Orders</h6>
          <a class="collapse-item" href="#">Pending Orders</a>
          <a class="collapse-item" href="#">Done Orders</a>

        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
        <i class="fas fa-user"></i>
        <span>Users</span>
      </a>
      <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Login Screens:</h6>
          <a class="collapse-item" href="#">Registed Users</a>
          <a class="collapse-item" href="#">Pending Users</a>
        
        </div>
      </div>
    </li>

    <!-- Nav Item - Charts 
    <li class="nav-item">
      <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
    </li>-->

    <!-- Nav Item - Tables 
    <li class="nav-item">
      <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
    </li>
  -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
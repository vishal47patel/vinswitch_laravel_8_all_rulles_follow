<!--- Sidemenu -->
<div id="sidebar-menu">

    <ul id="side-menu">

    <li>
        <a href="#sidebarConfiguration" data-bs-toggle="collapse" >
            <i data-feather="settings"></i>
            <span> Configuration </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarConfiguration">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('gateways.index') }}">Gateways</a>
                </li>
                <li>
                    <a href="{{ route('sofiaRateplan.index') }}">Termination Rate Plan</a>
                </li>
                <li>
                    <a href="{{ route('billPlan.index') }}">Termination Bill Plan</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-paste"></i><span> NPA/NXX </span></a>
                </li>
                <li>
                    <a href="{{ route('services.index') }}"><i class="fa fa-wrench"></i><span> DID Service Type </span></a>
                </li>
                <li>
                    <a href="#">Origination Rate Plan</a>
                </li>
                <li>
                    <a href="{{ route('originationBillPlan.index') }}">Origination Bill Plan</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="#sidebarSetting" data-bs-toggle="collapse">
            <i data-feather="user"></i>
            <span> Users Management </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarSetting">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('roles.index') }}">Role</a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">User</a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <a href="{{ route('numbers.index') }}">
            <i data-feather="user"></i>
            <span> Number </span>
        </a>
    </li>
    <li>
        <a href="{{ route('vendors.index') }}">
            <i data-feather="user"></i>
            <span> Did api </span>
        </a>
    </li>

   <!--  <li>
        <a href="{{ route('leads.index') }}">
            <i data-feather="user"></i>
            <span> Lead </span>
        </a>
    </li> -->

    </ul>

</div>
<!-- End Sidebar -->
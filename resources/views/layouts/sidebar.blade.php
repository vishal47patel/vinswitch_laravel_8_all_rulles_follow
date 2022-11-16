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
                    <a href="{{ route('gateways.index') }}"><i class="far fa-dot-circle"></i> Gateways</a>
                </li>
                <li>
                    <a href="{{ route('sofiaRateplan.index') }}"><i class="fa fa-object-group"></i> Termination Rate Plan</a>
                </li>
                <li>
                    <a href="{{ route('billPlan.index') }}">Termination Bill Plan</a>
                </li>
                <li >
                    <a href="{{ route('npaNxxMaster.index') }}"><i class="fa fa-paste"></i><span> NPA/NXX </span></a>
                </li>
                <li>
                    <a href="{{ route('origination_rateplan.index') }}"><i class="fa fa-object-group"></i> Origination Rate Plan </a>
                </li>
                <li>
                    <a href="{{ route('origination_rateplan.index') }}"><i class="fa fa-object-group"></i><spna> Origination Rate Plan </span></a>
                </li>
                <li>
                    <a href="{{ route('originationBillPlan.index') }}">Origination Bill Plan</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="{{ route('agent.index') }}">
            <i data-feather="users"></i>
            <span> Agent </span>
        </a>
    </li>
    <li>
        <a href="{{ route('aclnodes.index') }}" >
            <i data-feather="settings"></i>
            <span> ACL </span>
        </a>
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
                    <a href="{{ route('roles.index') }}"><i class="fa fa-user" aria-hidden="true"></i> Role</a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> User</a>
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
        <a href="{{ route('tenant.index') }}">
            <i data-feather="users"></i>
            <span> Customers </span>
        </a>
    </li>
    <li>
        <a href="{{ route('vendors.index') }}">
            <i data-feather="user"></i>
            <span> Did api </span>
        </a>
    </li>
    <li>
        <a href="#switchmenu" data-bs-toggle="collapse">
            <i data-feather="bar-chart-2"></i>
            <span> Switch </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="switchmenu">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('sip.status.index') }}">Sip Profiles</a>
                </li>
                <li>
                    <a href="{{ route('freeswitchServer.index') }}">FreeSwitch Servers</a>
                </li>
                <li>
                    <a href="{{ route('cdr.activecall') }}">Live Call</a>
                </li>
                <li>
                    <a href="{{ route('registrations.index') }}">Registered SIP Devices</a>
                </li>
                <li>
                    <a href="{{ route('registeredgatewey.index') }}">Registered Gateways</a>
                </li>
                <li>
                    <a href="{{ route('switchcli.index') }}">Switch CLI</a>
                </li>
        </div>
    </li>
    <li>
        <a href="#billingmenu" data-bs-toggle="collapse">
            <i data-feather="credit-card"></i>
            <span> Billing </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="billingmenu">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('order.index') }}">Customers Orders</a>
                </li>
                <li>
                    <a href="{{ route('payments.index') }}">Customers Payment Log</a>
                </li>
                <li>
                    <a href="{{ route('taxation.index') }}">Taxation Details</a>
                </li>
              
            </ul>
        </div>
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
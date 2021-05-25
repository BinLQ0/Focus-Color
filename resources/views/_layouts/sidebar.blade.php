<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="#" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">FOCSystem</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src='https://ui-avatars.com/api/?name={{ Auth::user()->username }}&background=0D8ABC&color=fff'
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <x-sidebar-menu label='Home' :url="route('home')" icon='fas fa-home' />

                <li class="nav-header">MANUFACTURE</li>
                <x-sidebar-menu label='Release Material' :url="route('release.index')" icon='fas fa-box-open' />
                <x-sidebar-menu label='Product Result' :url="route('result.index')" icon='fas fa-box' />

                <x-sidebar-menu label='Job Cost' :url="route('jobcost.index')" icon='fas fa-drafting-compass' />

                <li class="nav-header">WAREHOUSE</li>
                <x-sidebar-menu label='Receive item' :url="route('receive.index')" icon='fas fa-truck-loading' />
                <x-sidebar-menu label='Delivery Order' :url="route('delivery.index')" icon='fas fa-truck' />

                <x-sidebar-menu label='Adjustment' :url="route('adjustment.index')" icon='fas fa-pencil-ruler' />

                <li class="nav-header"></li>
                <x-sidebar-menu label='Product' :url="route('products.index')" icon='fas fa-boxes' />
                
                <li class="nav-header">ADMINISTRATION</li>
                
                @can('admin module')
                <x-sidebar-menu label='Users Management' :url="route('users.index')" icon='fas fa-users' />
                @endcan

                <x-sidebar-menu label='Relation Company' :url="route('relations.index')" icon='far fa-building' />

                <li class="nav-header">MASTER</li>
                <x-sidebar-menu label='Warehouse' :url="route('warehouses.index')" icon='far fa-circle' />

                <li class="nav-header">PROFILE</li>
                <x-sidebar-menu label='Logout' :url="route('logout')" icon='fas fa-sign-out-alt' />
            </ul>
        </nav>
    </div>
</aside>

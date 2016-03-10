<!-- Left panel : Navigation area -->
    <!-- Note: This width of the aside area can be adjusted through LESS variables -->
    <aside id="left-panel">

        <!-- User info -->
        <div class="login-info">
            <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

                <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                    <i class="fa fa-user fa-2x"></i>
                    <span>
                        &nbsp;&nbsp;&nbsp;{!! \Auth::guest() ? '<a href="'.URL::to('login').'">Log In</a>' : \Auth::user()->name !!}
                    </span>
                </a>



            </span>
        </div>
        <!-- end user info -->

        <!-- NAVIGATION : This navigation is also responsive-->
        <nav>
            <ul>
                <li>
                    <a href="{{ URL::to('/') }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Users</span></a>
                    <ul>

                        <li>
                            <a href="{!! url('users') !!}">Users</a>
                        </li>
                        <li>
                            <a href="{!! url('users/create') !!}">Add New User</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-hospital-o "></i> <span class="menu-item-parent">Hospitals</span></a>
                    <ul>

                        <li>
                            <a href="{!! url('hospitals') !!}">Hospitals</a>
                        </li>
                        <li>
                            <a href="{!! url('hospitals/create') !!}">Add New Hospital</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-barcode "></i> <span class="menu-item-parent">Items</span></a>
                    <ul>

                        <li>
                            <a href="{!! url('items') !!}">Items</a>
                        </li>
                        <li>
                            <a href="{!! url('items/create') !!}">Add New Item</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="/categories">Categories</a>
                        </li>
                        <li>
                            <a href="/categories/create">Add New Category</a>
                        </li>


                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-file-text-o "></i> <span class="menu-item-parent">Transfers</span></a>
                    <ul>
                        <li>
                            <a href="{!! url('transfers') !!}">Transfers</a>
                        </li>
                        <li><a href="{!! url('transfers/newtransfer') !!}">New Transfer</a></li>

                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-file-text-o"></i> <span class="menu-item-parent">Requests</span></a>
                    <ul>
                        <li>
                            <a href="{!! url('orders') !!}">All Request</a>
                        </li>
                    </ul>
                </li>



                <li>
                    <a href="#"><i class="fa fa-lg fa-fw fa-files-o"></i> <span class="menu-item-parent">Reports</span></a>
                    <ul>
                        <li>
                            <a href="{!! url('reports/usages') !!}">Usages</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <span class="minifyme" data-action="minifyMenu">
            <i class="fa fa-arrow-circle-left hit"></i>
        </span>

    </aside>
<!-- END NAVIGATION -->
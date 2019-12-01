<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
    <li class="{{set_active('backoffice.dashboard')}}"><a href="{{route('backoffice.dashboard')}}"><i class="icon-home3"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
    </li>
    <li class="{{set_active(['backoffice.user_index','backoffice.user_create','backoffice.user_show'])}}"><a href="{{route('backoffice.user_index')}}"><i class="icon-users3"></i><span data-i18n="" class="menu-title">Users</span></a>
    </li>
    <li class="{{set_active(['backoffice.pcategory_index','backoffice.pcategory_create','backoffice.pcategory_show'])}}"><a href="{{route('backoffice.pcategory_index')}}"><i class="icon-tags"></i><span data-i18n="" class="menu-title">Product Category</span></a>
    </li>
    <li class="{{set_active(['backoffice.courier'])}}"><a href="{{route('backoffice.courier')}}"><i class="icon-tags"></i><span data-i18n="" class="menu-title">Courier</span></a>
    </li>
    <li class="{{set_active(['backoffice.store','backoffice.store_create','backoffice.store_edit'])}}"><a href="{{route('backoffice.store')}}"><i class="icon-shop2"></i><span data-i18n="" class="menu-title">Store</span></a>
    </li>
  
    
  </ul>
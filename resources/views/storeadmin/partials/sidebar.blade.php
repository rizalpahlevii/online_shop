<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
    <li class="{{set_active('admin.dashboard')}}"><a href="{{route('admin.dashboard')}}"><i class="icon-home3"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
    </li>
    <li class="{{set_active(['admin.product_index','admin.product_create','admin.product_show'])}}"><a href="{{route('admin.product_index')}}"><i class="icon-stack"></i><span data-i18n="" class="menu-title">Product</span></a>
    </li>
    <li class="{{set_active(['admin.transaction_index','admin.transaction_detail'])}}"><a href="{{route('admin.transaction_index')}}"><i class="icon-shopping-basket"></i><span data-i18n="" class="menu-title">Transaction</span></a>
    </li>

    <li class="nav-item"><a href="#"><i class="icon-gear"></i><span data-i18n="nav.google_charts.main" class="menu-title">Setting</span></a>
      <ul class="menu-content">
        <li class="{{set_active(['admin.setting_store'])}}"><a href="{{route('admin.setting_store')}}" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Store</a>
        </li>
        <li class="{{set_active(['admin.setting_courier'])}}"><a href="{{route('admin.setting_courier')}}" data-i18n="nav.google_charts.google_line_charts" class="menu-item">Courier</a>
        </li>
        <li class="{{set_active(['admin.setting_payment','admin.setting_payment_add','admin.setting_payment_edit'])}}"><a href="{{route('admin.setting_payment')}}" data-i18n="nav.google_charts.google_line_charts" class="menu-item">Payment</a>
        </li>
      </ul>
    </li>
    <li class="nav-item"><a href="#"><i class="icon-tasks"></i><span data-i18n="nav.google_charts.main" class="menu-title">Reports</span></a>
      <ul class="menu-content">
        <li class="{{set_active(['admin.report_transaction'])}}"><a href="{{route('admin.report_transaction')}}" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Transaction</a>
        </li>
        
      </ul>
    </li>
  </ul>
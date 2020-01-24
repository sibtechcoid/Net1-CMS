<li class="{{ Request::is('admin/products') ? 'active' : '' }}">
    <a href="{!! route('admin.products.index') !!}">
    <i class="livicon" data-c="#F89A14" data-hc="#F89A14" data-name="list" data-size="18"
               data-loop="true"></i>
               Products
    </a>
</li>

<li class="{{ Request::is('admin/customers') ? 'active' : '' }}">
    <a href="{!! route('admin.customers.index') !!}">
    <i class="livicon" data-c="#6CC66C" data-hc="#6CC66C" data-name="users" data-size="18"
               data-loop="true"></i>
               Customers
    </a>
</li>

<li class="{{ Request::is('admin/productNetOnes*') ? 'active' : '' }}">
    <a href="{!! route('admin.productNetOnes.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="list" data-size="18"
               data-loop="true"></i>
               ProductNet1
    </a>
</li>



<li class="{{ Request::is('admin/bannerNetones*') ? 'active' : '' }}">
    <a href="{!! route('admin.bannerNetones.index') !!}">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="desktop" data-size="18"
               data-loop="true"></i>
               BannerNet1
    </a>
</li>


<ul class="nav nav-treeview">
    <li class="nav-item">
      
      <a href="{{route('setting.accounts.view',['role' => \Auth::user()->role->slug])}}"  class="{{ request()->is(\Auth::user()->role->slug.'/accounts') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Accounts
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.currency.rate.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/currency-rate') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Currency
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.email.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/email-settings') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Email
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.application.links.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/application-links') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Mobile App Links
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.order.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/order-settings') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Orders
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.social.login.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/social-logins') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
          Social Logins
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.smtp.credentials.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/smtp-credentials') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        SMTP
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.social.links.view',['role' => \Auth::user()->role->slug])}}" class=" {{ request()->is(\Auth::user()->role->slug.'/social-links') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Socials Links
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.tax.vat.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/tax-vat') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Tax & Vat
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('setting.paypal.credentials.view',['role' => \Auth::user()->role->slug])}}" class="{{ request()->is(\Auth::user()->role->slug.'/paypal') ? 'active' : '' }} nav-link">
        <i class="far fa-circle nav-icon"></i>
        Paypal
      </a>
    </li>
  </ul>
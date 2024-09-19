{{-- <nav class="header-navbar navbar-expand-md navbar navbar-horizontal navbar-with-menu   navbar-light navbar-without-dd-arrow navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a href="{{ route('admin.dashboard') }}" class=" navbar-brand "><img src="{{ asset('theme/app-assets/images/DENTCRAFT%20Logo.png') }}"></a>
          </li>

          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <?php
    //   if ($_SESSION['customer_id']) {

    //     $notifications  = $this->customer_lib->get_notifications($_SESSION['customer_id']);
    //   }

      ?>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse float-right" id="navbar-mobile">
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-notification nav-item">
              <a onclick="seen_notifications()" class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                @if (count(auth()->user()->notifications) > 0)
                    <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">
                        {{ count(auth()->user()->notifications) }}
                    </span>
                @endif
              </a>

              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Notifications</span>
                  </h6>
                </li>
                <li class="scrollable-container media-list ps-container ps-theme-dark ps-active-y">
                    @forelse (auth()->user()->notifications as $notification)
                        <a href="{{ route('admin.quotation.quotation_summary', base64_encode($notification->quote->id)) }}?notification=seen">
                            <div class="media">
                                <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                                <div class="media-body">
                                    @switch($notification->type)
                                        @case('quote')
                                            <h6 class="media-heading">
                                                New quote added
                                            </h6>
                                            <p class="notification-text font-small-3 text-muted">
                                                Quote ({{ $notification->name }}) has been added.
                                            </p>
                                            @break
                                        @case('email')
                                            <h6 class="media-heading">
                                                Email sent
                                            </h6>
                                            <p class="notification-text font-small-3 text-muted">
                                                Email of quote ({{ $notification->name }}) sent to {{ $notification->to_email }}.
                                            </p>
                                            @break
                                        @case('email read')
                                            <h6 class="media-heading">
                                                Email read by customer
                                            </h6>
                                            <p class="notification-text font-small-3 text-muted">
                                                {{ $notification->to_email }} just read the email of quote ({{ $notification->name }}).
                                            </p>
                                            @break
                                        @case('summary viewed')
                                            <h6 class="media-heading">
                                                Summary Viewed  by customer
                                            </h6>
                                            <p class="notification-text font-small-3 text-muted">
                                                {{ $notification->to_email }} just viewed the quote summary ({{ $notification->name }}).
                                            </p>
                                            @break
                                        @case('summary read')
                                            <h6 class="media-heading">
                                                Summary read  by customer
                                            </h6>
                                            <p class="notification-text font-small-3 text-muted">
                                                {{ $notification->to_email }} just read the quote summary ({{ $notification->name }}).
                                            </p>
                                            @break
                                        @default

                                    @endswitch

                                    <small>
                                      <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{ $notification->created_at->format('d-m-Y') }}</time>
                                    </small>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p style="text-align:center">No notifications yet</p>
                    @endforelse
                </li>
              </ul>
            </li>
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Welcome,
                  <span class="user-name text-bold-700">{{ auth()->user()->name }} <i class="fas fa-caret-down"></i></span>
                </span>
                <span class="avatar">
                  <img src="{{ auth()->user()->profile_image_url }}" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="ft-user"></i>Profile Settings</a>
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="ft-home"></i>My Dashboard</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button id="btn_logout" class="dropdown-item" type="submit">
                        <i class="ft-power"></i> Logout
                    </button>
                </form>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow navbar-brand-center navbar-custom" role="navigation" data-menu="menu-wrapper" data-nav="brand-center">
    <div class="col-md-8">
      <div class="navbar-container main-menu-content" data-menu="menu-container">

        <ul class="nav navbar-nav text-center" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item">
            <a class=" nav-link
            @if (Route::is('admin.dashboard'))
                active
                @else
                not-active
            @endif"
            href="{{ route('admin.dashboard') }}"><i class="la la-home"></i><span>My Dashboard</span></a>
          </li>
          <li class="nav-item"><a class=" nav-link
            @if (Route::is('admin.quotation.my_quotations'))
                active
                @else
                not-active
            @endif"
            href="{{ route('admin.quotation.my_quotations') }}"><i class="la la-file-text" aria-hidden="true"></i><span>My Quotations</span></a>
          </li>
          <li class="nav-item"><a class=" nav-link
            @if (Route::is('admin.quotation.new_quotation'))
                active
                @else
                not-active
            @endif" href="{{ route('admin.quotation.new_quotation') }}"><i class="la la-plus-circle" aria-hidden="true"></i><span>New Quotation</span></a>
          </li>
          <li class="nav-item  has-sub dropdown-mb"><a class=" nav-link dropdown-toggle" data-toggle="dropdown"><i class="la la-reply" aria-hidden="true"></i><span>API <i class="fas fa-caret-down"></i></span></a>
            <ul class="dropdown-menu">
              <li data-menu=""><a class="dropdown-item" href="{{ route('admin.quotation.check_vehical_reg') }}" data-toggle=""><i class="la la-check-square"></i><span>Check Vehicle Registration</span></a>
              </li>
              <li data-menu=""><a class="dropdown-item" href="#" data-toggle=""><i class="fa fa-cogs"></i><span>Check for Parts</span></a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-4">
      <div class="search-container">
        <form id="search_quotations" action="{{ route('admin.quotation.my_quotations') }}" method="GET">
          <div class="input-group">
            <input id="search" type="text" class="form-control" placeholder="Customer/Technician/VIN/Registration/Quote no." name="search">
            <div class="input-group-btn">
              <button class="btn btn-default border-radius-0" type="submit"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div> --}}

<div class="header-title-search fix-height common-padding-lr">
    <div class="header-title-content">
        <h2>{{ $title }}</h2>
        <p>{{ $description }}</p>
    </div>
    @if ($show_search)
     @php
       $abc = '';
       
        if(request()->search != ""){
          $abc = "display : block;";
        }else{
          $abc = "display : none;";
        }
    @endphp
        <div class="header-search">
            <form id="search_quotations" action="{{ route('admin.dashboard') }}" method="get">
                <input name="search" id="search" type="text" placeholder="Customer/Technician/VIN/Registration/Quote no." value="{{ request()->search }}" autocomplete="off" />
                <button id="button-addon1" type="button" onclick="clearFields()" class="btn btn-link text-primary"style="top:9px !important; {{$abc}}"><i class="fa fa-close" style = "color:#938d8d ; font-size:15px;"></i></button>
            </form>
        </div>
    @endif
</div>


@push('scripts')
    <script>
    
    $(document).ready( function () {
  
    var c = $('#search').val();
    if(c != ''){
             $("#button-addon1").css("display", "block");
              }
});
    
     function clearFields() {

        var b =  $('#search').val()
        var a = document.getElementById("search").value=""
              if(b != ''){
            $('#search_quotations').submit()
             $("#button-addon1").css("display", "none");
              }


}
        var searchTimeout2
        $('#search').on('input', function() {
           
            clearTimeout(searchTimeout2)

            searchTimeout2 = setTimeout(function() {
                $('#search_quotations').submit()
            }, 1000);
             $("#button-addon1").css("display", "block");
        })
        // $('#search').on('keypress', function (e) {
        //     console.log($(this).val())
        //     if (e.keyCode === 13) {
        //         $('#search_quotations').submit()
        //     }
        //     return true
        // })
    </script>
@endpush

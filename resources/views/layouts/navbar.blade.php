<nav class="navbar navbar-default" style="margin-top: 5%;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div>
                <img class="img" src="/img/logo.png" width="150px" style="padding-top:15px;margin-top:-20px;margin-bottom:-30px;"/>&nbsp&nbsp&nbsp&nbsp
            </div>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-home"><a href="/{{app()->getLocale()}}"><i class="fa fa-home" aria-hidden="true"></i> {{trans('general.welcome')}} <span class="sr-only">current</span></a></li>
                <li class="nav-store {{$page['store']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['store']['inMaintenance'] ? '#' : '/' . app()->getLocale() . '/store/1'}}"><i class="fa {{$page['store']['inMaintenance'] ? 'fa-wrench' : 'fa-shopping-cart'}}" aria-hidden="true"></i> {{trans('general.store')}} <span class="sr-only">current</span></a></li>
                <li class="nav-privacy_policy {{$page['privacy_policy']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['privacy_policy']['inMaintenance'] ? '#' : '/' . app()->getLocale() . '/privacy_policy'}}"><i class="fa {{$page['privacy_policy']['inMaintenance'] ? 'fa-wrench' : 'fa-file-text'}}" aria-hidden="true"></i> {{trans('general.privacy_policy')}} <span class="sr-only">current</span></a></li>
                <li class="nav-contact {{$page['contact_us']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['privacy_policy']['inMaintenance'] ? '#' : '/' . app()->getLocale() . '/contact_us'}}"><i class="fa {{$page['contact_us']['inMaintenance'] ? 'fa-wrench' : 'fa-address-book'}}" aria-hidden="true"></i> {{trans('general.contact_us')}} <span class="sr-only">current</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-language" aria-hidden="true"></i> {{trans("general.language")}} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/language/set/en-ca"><i class="fa fa-language" aria-hidden="true"></i> English (Canada)</a>
                            <a href="/language/set/fr-ca"><i class="fa fa-language" aria-hidden="true"></i> Français (Canada)</a>
                        </li>
                    </ul>
                </li>
                @auth
                    @if(Auth::user()->isDev || Auth::user()->isAdmin)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <i class="fa fa-dashboard" aria-hidden="true"></i> {{trans('general.management')}} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->isDev)
                                    <li><a href="/{{app()->getLocale()}}/management/pages"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('management.pages')}}</a></li>    
                                @endif
                                <li class="{{$page['management.categories']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['management.categories']['inMaintenance'] ? '#' : '/'. app()->getLocale() .'/management/categories'}}"><i class="fa {{$page['management.categories']['inMaintenance'] ? 'fa-wrench' : 'fa-file-text-o'}}" aria-hidden="true"></i> {{trans('management.categories')}}</a></li>
                                <li class="{{$page['management.items']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['management.items']['inMaintenance'] ? '#' : '/'. app()->getLocale() .'/management/items'}}"><i class="fa {{$page['management.items']['inMaintenance'] ? 'fa-wrench' : 'fa-cubes'}}" aria-hidden="true"></i> {{trans('management.items')}}</a></li>
                                @if(Auth::user()->isDev)
                                    <li><a href="/{{app()->getLocale()}}/management/logs"><i class="fa fa-tasks" aria-hidden="true"></i> {{trans('management.logs')}}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                                <li class="{{$page['profile.edit']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['profile.edit']['inMaintenance'] ? '#' : '/' . app()->getLocale() . '/profile/edit'}}"><i class="fa {{$page['profile.edit']['inMaintenance'] ? 'fa-wrench' : 'fa-user'}}" aria-hidden="true"></i> {{trans('general.edit_profile')}}</a></li>
                                <li class="{{$page['logout']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['logout']['inMaintenance'] ? '#' : '/logout'}}"><i class="fa {{$page['logout']['inMaintenance'] ? 'fa-wrench' : 'fa-sign-out'}}" aria-hidden="true"></i> {{trans('general.logout')}}</a></li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{trans('general.my_profile')}} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('login', app()->getLocale()) }}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{trans("general.login")}}</a></li>
                            <li class="{{$page['register']['inMaintenance'] ? 'disabled' : ''}}"><a href="{{$page['register']['inMaintenance'] ? '#' : route('register', app()->getLocale())}}"><i class="fa {{$page['register']['inMaintenance'] ? 'fa-wrench' : 'fa-user-plus'}}" aria-hidden="true"></i> {{trans("general.register")}}</a></li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
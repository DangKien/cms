<nav id="mainnav-container">
    <div id="mainnav">
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="@if (Auth::check()) {{ url('') }}/{{Auth::user()->avatar}} @endif" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <p class="mnp-name">@if (Auth::check()) {!! Auth::user()->name !!} @endif</p>
                                <span class="mnp-desc">@if (Auth::check()) {!! Auth::user()->email !!} @endif</span>
                            </a>
                        </div>
                    </div>
                    <ul id="mainnav-menu" class="list-group">
                        <li class="list-divider"></li>
                        <li class="list-header">{!! trans('backend.menu.manager')  !!}</li> 

                        <li class="
                                {{ request()->is('admin/categories') || request()->is('admin/categories/*')
                                || request()->is('admin/tags') || request()->is('admin/tags/*')
                                || request()->is('admin/news') || request()->is('admin/news/*')
                                ? 'active-sub active': '' }}">
                            <a href="#">
                                <i class="ti-settings"></i>
                                <span class="menu-title">{!! trans('backend.menu.product')  !!}</span>
                                <i class="arrow"></i>
                            </a>                    
                            <ul class="collapse">
                                <li class="{{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active-link': '' }}">
                                    <a href="{{ route('categories.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.category')  !!}</a>
                                </li>
                            </ul>

                            <ul class="collapse">
                                <li class="{{ request()->is('admin/tags') || request()->is('admin/tags/*') ? 'active-link': '' }}">
                                    <a href="{{ route('tags.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.tag')  !!}</a>
                                </li>
                            </ul>

                            <ul class="collapse">
                                <li class="{{ request()->is('admin/news') || request()->is('admin/news/*') ? 'active-link': '' }}">
                                    <a href="{{ route('news.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.new')  !!}</a>
                                </li>
                            </ul>

                            <ul class="collapse">
                                <li class="{{ request()->is('admin/magazines') || request()->is('admin/magazines/*') ? 'active-link': '' }}">
                                    <a href="{{ route('magazines.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.magazine')  !!}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="
                                {{ request()->is('admin/menu') 
                                || request()->is('admin/menu/*')
                                ? 'active-sub active': '' }}">
                            <a href="#">
                                <i class="ti-settings"></i>
                                <span class="menu-title">{!! trans('backend.menu.layout')  !!}</span>
                                <i class="arrow"></i>
                            </a>                    
                            <ul class="collapse">
                                <li class="{{ request()->is('admin/menu') || request()->is('admin/menu/*') ? 'active-link': '' }}">
                                    <a href="{{ route('menu.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.menu')  !!}</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="
                                {{ request()->is('admin/users') 
                                || request()->is('admin/users/*')
                                || request()->is('admin/roles') 
                                || request()->is('admin/roles/*')
                                ? 'active-sub active': '' }}">
                            <a href="#">
                                <i class="demo-pli-male"></i>
                                <span class="menu-title">{!! trans('backend.menu.users')  !!}</span>
                                <i class="arrow"></i>
                            </a>                    
                            <ul class="collapse">
                                <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active-link': '' }}">
                                    <a href="{{ route('users.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.users')  !!}</a>
                                </li>
                                <li class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active-link': '' }}">
                                    <a href="{{ route('roles.index') }}"><i class="ti-angle-double-right"></i>{!! trans('backend.menu.role')  !!}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="
                                {{ request()->is('admin/languages') 
                                || request()->is('admin/languages/*')
                                || request()->is('admin/slides') 
                                || request()->is('admin/slides/*')
                                || request()->is('admin/setting') 
                                || request()->is('admin/setting/*')
                                ? 'active-sub active': '' }}">
                            <a href="#">
                                <i class="ti-settings"></i>
                                <span class="menu-title">{!! trans('backend.menu.setting')  !!}</span>
                                <i class="arrow"></i>
                            </a>                    
                            <ul class="collapse">
                                <!-- <li class="{{ request()->is('admin/languages') || request()->is('admin/languages/*') ? 'active-link': '' }}">
                                    <a href="{{ route('languages.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.language')  !!}</a>
                                </li> -->
                               <!--  <li class="{{ request()->is('admin/slides') || request()->is('admin/slides/*') ? 'active-link': '' }}">
                                    <a href="{{ route('slides.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.slide')  !!}</a>
                                </li> -->
                                <li class="{{ request()->is('admin/setting') || request()->is('admin/setting/*') ? 'active-link': '' }}">
                                    <a href="{{ route('setting.index') }}"><i class="ti-angle-double-right">
                                    </i>{!! trans('backend.menu.setting')  !!}</a>
                                </li>
                            </ul>
                        </li>

                        
                    </ul>
                    <div class="mainnav-widget">
                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="demo-pli-monitor-2"></i>
                            </a>
                        </div>
                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
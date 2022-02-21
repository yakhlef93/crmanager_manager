            <!--header menu start-->
            <div class="header d-print-none bg-white">
                <div class="header-menu">
                    <div class="title w-50">
                        <h3 class="text-success m-0"><span class="text-primary"><b>DOCTORS</b></span></h3>
                        {{-- <img width="135" src="/assets/images/g_stock_logo_white.png"> --}}
                    </div>
                    
                    @auth
                        <div class="sidebar-btn">
                            <i class="fas fa-bars text-primary"></i>
                        </div>
                        <ul class="navbar-ul">
                            {{-- <notifications></notifications> --}}
                            
                            <li class="text-primary mt-2 navbar-user-name mr-3"><span><i class="fa-solid fa-gear"></i> الإعدادات</span></li>
                            <li class="text-primary mt-2 navbar-user-name mr-3"><i class="fa-solid fa-bell"></i> تنبيهات</span></li>
                            <li class="text-primary mt-2 navbar-user-name mr-3"><span><i class="fa-solid fa-circle-question"></i> مساعدة</span></li>
                            {{-- <li>
                                <a class="navbar-user-avatar-link position-relative mb-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(Auth::user()->Avatar)
                                        <img class="navbar-user-avatar" src="{{Auth::user()->Avatar}}" alt="">
                                    @else
                                        <img class="navbar-user-avatar bg-primary p-2" src="{{asset('assets/images/user_without_avatar.svg') }}" alt="">
                                    @endif
                                    <div class="user-avatar-online position-absolute"></div>
                                </a>

                                <div class="dropdown-menu mt-1" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profil</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-settings"></i> Profil</a> --}}
                                    {{-- <a class="dropdown-item" href="{{route('user.profile')}}"><i class="fas fa-user"></i> Profil</a> --}}
                                    {{-- <a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Emails <span class="float-right mt-1 badge badge-danger">3</span></a> --}}
                                    {{-- <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('lock_screen')}}"><i class="fas fa-user-lock"></i> Verrouiller</a>
                                    <a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-power-off"></i> Déconnecter</a> --}}
                                {{-- </div>
                            </li> --}}
                        </ul>
                    @endauth
                </div>
            </div>
            <!--header menu end-->
@php
	$user = Auth('web')->user();
@endphp
<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <x-lucide-menu class="icon-lg" />
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <x-lucide-search class="icon-sm" />
                    </div>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-lucide-flag class="mt-1" title="us" />
                    <span class="ml-1 mr-1 font-weight-medium d-none d-md-inline-block">English</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a href="javascript:;" class="py-2 dropdown-item"><x-lucide-flag class="flag-icon flag-icon-us" title="us"
                            id="us"></x-lucide-flag> <span class="ml-1"> English </span></a>
                    <a href="javascript:;" class="py-2 dropdown-item"><x-lucide-flag class="flag-icon flag-icon-fr" title="fr"
                            id="fr"></x-lucide-flag> <span class="ml-1"> French </span></a>
                    <a href="javascript:;" class="py-2 dropdown-item"><x-lucide-flag class="flag-icon flag-icon-de" title="de"
                            id="de"></x-lucide-flag> <span class="ml-1"> German </span></a>
                    <a href="javascript:;" class="py-2 dropdown-item"><x-lucide-flag class="flag-icon flag-icon-pt" title="pt"
                            id="pt"></x-lucide-flag> <span class="ml-1"> Portuguese </span></a>
                    <a href="javascript:;" class="py-2 dropdown-item"><x-lucide-flag class="flag-icon flag-icon-es" title="es"
                            id="es"></x-lucide-flag> <span class="ml-1"> Spanish </span></a>
                </div>
            </li>
            <li class="nav-item dropdown nav-apps">
                <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-lucide-grid class="icon-lg" />
                </a>
                <div class="dropdown-menu" aria-labelledby="appsDropdown">
                    <div class="dropdown-header d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium">Web Apps</p>
                        <a href="javascript:;" class="text-muted">Edit</a>
                    </div>
                    <div class="dropdown-body">
                        <div class="d-flex align-items-center apps">
                            <a href="pages/apps/chat.html"><i data-feather="message-square" class="icon-lg"></i>
                                <p>Chat</p>
                            </a>
                            <a href="pages/apps/calendar.html"><i data-feather="calendar" class="icon-lg"></i>
                                <p>Calendar</p>
                            </a>
                            <a href="pages/email/inbox.html"><i data-feather="mail" class="icon-lg"></i>
                                <p>Email</p>
                            </a>
                            <a href="pages/general/profile.html"><i data-feather="instagram" class="icon-lg"></i>
                                <p>Profile</p>
                            </a>
                        </div>
                    </div>
                    <div class="dropdown-footer d-flex align-items-center justify-content-center">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown nav-messages">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-lucide-mail class="icon-lg" />
                </a>
                <div class="dropdown-menu" aria-labelledby="messageDropdown">
                    <div class="dropdown-header d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium">9 New Messages</p>
                        <a href="javascript:;" class="text-muted">Clear all</a>
                    </div>
                    <div class="dropdown-body">
                        <a href="javascript:;" class="dropdown-item">
                            <div class="figure">
                                <img src="https://via.placeholder.com/30x30" alt="userr">
                            </div>
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Leonardo Payne</p>
                                    <p class="sub-text text-muted">2 min ago</p>
                                </div>
                                <p class="sub-text text-muted">Project status</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="figure">
                                <img src="https://via.placeholder.com/30x30" alt="userr">
                            </div>
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Carl Henson</p>
                                    <p class="sub-text text-muted">30 min ago</p>
                                </div>
                                <p class="sub-text text-muted">Client meeting</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="figure">
                                <img src="https://via.placeholder.com/30x30" alt="userr">
                            </div>
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Jensen Combs</p>
                                    <p class="sub-text text-muted">1 hrs ago</p>
                                </div>
                                <p class="sub-text text-muted">Project updates</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="figure">
                                <img src="https://via.placeholder.com/30x30" alt="userr">
                            </div>
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Amiah Burton</p>
                                    <p class="sub-text text-muted">2 hrs ago</p>
                                </div>
                                <p class="sub-text text-muted">Project deadline</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="figure">
                                <img src="https://via.placeholder.com/30x30" alt="userr">
                            </div>
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Yaretzi Mayo</p>
                                    <p class="sub-text text-muted">5 hr ago</p>
                                </div>
                                <p class="sub-text text-muted">New record</p>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer d-flex align-items-center justify-content-center">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown nav-notifications">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-lucide-bell class="icon-lg" />
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                    <div class="dropdown-header d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium">6 New Notifications</p>
                        <a href="javascript:;" class="text-muted">Clear all</a>
                    </div>
                    <div class="dropdown-body">
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <x-lucide-user-plus class="icon-lg" />
                            </div>
                            <div class="content">
                                <p>New customer registered</p>
                                <p class="sub-text text-muted">2 sec ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <x-lucide-gift class="icon-lg" />
                            </div>
                            <div class="content">
                                <p>New Order Recieved</p>
                                <p class="sub-text text-muted">30 min ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <x-lucide-alert-circle class="icon-lg" />
                            </div>
                            <div class="content">
                                <p>Server Limit Reached!</p>
                                <p class="sub-text text-muted">1 hrs ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <x-lucide-layers class="icon-lg" />
                            </div>
                            <div class="content">
                                <p>Apps are ready for update</p>
                                <p class="sub-text text-muted">5 hrs ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <x-lucide-download class="icon-lg" />
                            </div>
                            <div class="content">
                                <p>Download completed</p>
                                <p class="sub-text text-muted">6 hrs ago</p>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer d-flex align-items-center justify-content-center">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ $user?->thumbnail }}" alt="{{ $user?->name }}">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="mb-3 figure">
                            <img src="{{ $user?->thumbnail }}" alt="{{ $user?->name }}">
                        </div>
                        <div class="text-center info">
                            <p class="mb-0 name font-weight-bold">{{ $user?->name }}</p>
                            <p class="mb-3 email text-muted">{{ $user?->email }}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="p-0 pt-3 profile-nav">
                            <li class="nav-item">
                                <a href="{{ route('user.view', $user?->id)}}" class="nav-link">
                                    <x-lucide-user class="icon-lg" />
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.edit', $user?->id) }}" class="nav-link">
                                    <x-lucide-edit class="icon-lg" />
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.logout') }}" class="nav-link">
                                    <x-lucide-log-out class="icon-lg" />
                                    <span>Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

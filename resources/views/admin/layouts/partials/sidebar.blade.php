<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            Noble<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <x-lucide-home class="link-icon" />
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <x-lucide-mail class="link-icon" />
                    <span class="link-title">Email</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="pages/apps/chat.html" class="nav-link">
                    <x-lucide-message-square class="link-icon" />
                    <span class="link-title">Chat</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/apps/calendar.html" class="nav-link">
                    <x-lucide-calendar class="link-icon" />
                    <span class="link-title">Calendar</span>
                </a>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#product_Attributes" role="button" aria-expanded="false"
                    aria-controls="product_Attributes">
                    <x-lucide-settings class="link-icon" />
                    <span class="link-title">Product Attributes</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="product_Attributes">
                    <ul class="nav sub-menu">
                        {{-- category menu --}}
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">Categories</a>
                        </li>
                        {{-- subcategory menu --}}
                        <li class="nav-item">
                            <a href="{{ route('subcategory.index') }}"
                                class="nav-link {{ request()->routeIs('subcategory.*') ? 'active' : '' }}">Sub
                                Categories</a>
                        </li>
                        {{-- brand menu --}}
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}"
                                class="nav-link {{ request()->routeIs('brand.*') ? 'active' : '' }}">Brands</a>
                        </li>
                        {{-- color menu --}}
                        <li class="nav-item">
                            <a href="{{ route('color.index') }}"
                                class="nav-link {{ request()->routeIs('color.*') ? 'active' : '' }}">Colors</a>
                        </li>
                        {{-- size menu --}}
                        <li class="nav-item">
                            <a href="{{ route('size.index') }}"
                                class="nav-link {{ request()->routeIs('size.*') ? 'active' : '' }}">Sizes</a>
                        </li>
                        {{-- tag menu --}}
                        <li class="nav-item">
                            <a href="{{ route('tag.index') }}"
                                class="nav-link {{ request()->routeIs('tag.*') ? 'active' : '' }}">Tags</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ request()->routeIs('product.*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#products" role="button" aria-expanded="false"
                    aria-controls="products">
                    <x-lucide-package class="link-icon" />
                    <span class="link-title">Products</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="products">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}"
                                class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}">All
                                Products</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}"
                                class="nav-link {{ request()->routeIs('product.create') ? 'active' : '' }}">Add
                                Product</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ request()->routeIs('coupon.*') ? 'active' : '' }}">
                <a href="{{ route('coupon.index') }}" class="nav-link">
                    <x-lucide-ticket class="link-icon" />
                    <span class="link-title">Coupons</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#orders" role="button" aria-expanded="false"
                    aria-controls="orders">
                    <x-lucide-inbox class="link-icon" />
                    <span class="link-title">Orders</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="orders">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->routeIs('admin.order.index') ? 'active' : '' }}">All Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/wizard.html" class="nav-link">Wizard</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#forms" role="button" aria-expanded="false"
                    aria-controls="forms">
                    <x-lucide-inbox class="link-icon" />
                    <span class="link-title">Forms</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/forms/basic-elements.html" class="nav-link">Basic Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced-elements.html" class="nav-link">Advanced Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">Editors</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/wizard.html" class="nav-link">Wizard</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#charts" role="button" aria-expanded="false"
                    aria-controls="charts">
                    <x-lucide-pie-chart class="link-icon" />
                    <span class="link-title">Charts</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/charts/apex.html" class="nav-link">Apex</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">ChartJs</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">Flot</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/morrisjs.html" class="nav-link">Morris</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/peity.html" class="nav-link">Peity</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/sparkline.html" class="nav-link">Sparkline</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tables" role="button" aria-expanded="false"
                    aria-controls="tables">
                    <x-lucide-layout class="link-icon" />
                    <span class="link-title">Table</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/tables/basic-table.html" class="nav-link">Basic Tables</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data-table.html" class="nav-link">Data Table</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">User Management</li>
            <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button"
                    aria-expanded="false" aria-controls="users">
                    <x-lucide-users class="link-icon" />
                    <span class="link-title">Users</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link {{ request()->routeIs('user.create') ? 'active' : '' }}">Add User</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Pages</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#general-pages" role="button"
                    aria-expanded="false" aria-controls="general-pages">
                    <x-lucide-book class="link-icon" />
                    <span class="link-title">Special pages</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/general/blank-page.html" class="nav-link">Blank page</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/general/faq.html" class="nav-link">Faq</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/general/invoice.html" class="nav-link">Invoice</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/general/profile.html" class="nav-link">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/general/pricing.html" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/general/timeline.html" class="nav-link">Timeline</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#authPages" role="button" aria-expanded="false"
                    aria-controls="authPages">
                    <x-lucide-unlock class="link-icon" />
                    <span class="link-title">Authentication</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="authPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/auth/login.html" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/auth/register.html" class="nav-link">Register</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#errorPages" role="button" aria-expanded="false"
                    aria-controls="errorPages">
                    <x-lucide-cloud-off class="link-icon" />
                    <span class="link-title">Error</span>
                    <x-lucide-chevron-down class="link-arrow" />
                </a>
                <div class="collapse" id="errorPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/error/404.html" class="nav-link">404</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/error/500.html" class="nav-link">500</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
@push('script')
    <script>
        function addShowToActiveCollapse() {
            const listItems = document.querySelectorAll('li');

            listItems.forEach(li => {
                if (li.classList.contains('active')) {
                    const collapseDev = li.querySelector('div.collapse');

                    if (collapseDev) {
                        collapseDev.classList.add('show');
                        const navLink = li.querySelector('a.nav-link[data-toggle="collapse"]');

                        if (navLink) {
                            navLink.setAttribute('aria-expanded', 'true');
                        }
                    }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', addShowToActiveCollapse);
    </script>
@endpush

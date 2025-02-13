<x-app-layout>
    <div class="container-fluid bg-light" style="min-height: 100vh;">
        <div class="row">
            <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 p-0 shadow-lg"
            style="background-color: #9aa1a1; position: fixed; top: 0; left: 0; height: 100vh; border-right: 1px solid #e0e0e0;">

            <a href="{{ route('dashboard') }}" class="d-block text-center fw-bold bg-white py-3 text-dark sidebar-link">
                <h4 class="mb-0" style="font-size: 22px;">📚 Library Menu</h4>
            </a>

            <ul class="nav flex-column px-3 mt-4">
                @php
                    $menuItems = [
                        ['route' => 'dashboard', 'icon' => 'bi-house-door', 'label' => 'Dashboard'],
                        ['route' => 'books', 'icon' => 'bi-book', 'label' => 'Books'],
                        ['route' => 'borrowers', 'icon' => 'bi-people', 'label' => 'Borrowers'],
                        ['route' => 'category', 'icon' => 'bi-folder', 'label' => 'Category']
                    ];
                @endphp

                @foreach($menuItems as $menuItem)
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center fw-bold {{ request()->routeIs($menuItem['route']) ? 'active bg-primary text-white' : 'text-white' }}"
                           href="{{ route($menuItem['route']) }}"
                           style="padding: 14px 18px; border-radius: 8px; font-size: 16px;">
                            <i class="bi {{ $menuItem['icon'] }} me-2 fs-5"></i>
                            <span>{{ $menuItem['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>



        </div>
    </div>
</x-app-layout>

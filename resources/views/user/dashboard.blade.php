<x-app-layout>
    <div class="container-fluid bg-light" style="min-height: 100vh;">

        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 p-0 shadow-lg"
            style="background-color: #9aa1a1; position: fixed; top: 0; left: 0; height: 100vh; border-right: 1px solid #e0e0e0;">

            <a href="{{ url('/home') }}" class="d-block text-center fw-bold bg-white py-3 text-dark sidebar-link">
                <h4 class="mb-0" style="font-size: 22px;">📚 Public Library</h4>
            </a>

            <ul class="nav flex-column px-3 mt-4">
                @php
                    $menuItems = [
                        ['url' => '/home', 'icon' => 'bi-house-door', 'label' => 'Dashboard'],
                        ['url' => '/book', 'icon' => 'bi-book', 'label' => 'Books'],

                    ];
                @endphp

                @foreach($menuItems as $menuItem)
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center fw-bold {{ request()->routeIs($menuItem['url']) ? 'active bg-primary text-white' : 'text-white' }}"
                           href="{{ url($menuItem['url']) }}"
                           style="padding: 14px 18px; border-radius: 8px; font-size: 16px;">
                            <i class="bi {{ $menuItem['icon'] }} me-2 fs-5"></i>
                            <span>{{ $menuItem['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

            <!-- Main Content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-left: 25%; padding-top: 20px;">
                <div class="py-1">

                    <div class="mt-5">
                        <div class="row g-4">
                            @foreach([
                                ['bgClass' => 'bg-white', 'icon' => 'bi-book-fill', 'title' => 'Total Books', 'count' => $bookCount, 'textClass' => 'text-primary'],
                                ['bgClass' => 'bg-white', 'icon' => 'bi-book-half', 'title' => 'Books Borrowed', 'count' => $borrowedBookCount, 'textClass' => 'text-info']
                            ] as $card)
                                <div class="col-md-4 col-sm-6">
                                    <div class="card {{ $card['bgClass'] }} shadow-lg hover-shadow-lg"
                                         style="border-radius: 15px; border: 1px solid #e0e0e0; transition: all 0.3s ease;">
                                        <div class="card-body text-center">
                                            <h6 class="{{ $card['textClass'] }} fw-bold mb-2">
                                                <i class="bi {{ $card['icon'] }} fs-4"></i> {{ $card['title'] }}
                                            </h6>
                                            <p class="fs-4 fw-bold mb-0">{{ $card['count'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>






                </div>
            </div>


        </div>
    </div>

    <style>
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #41607c; /* Change this to your desired hover background color */
            color: #ffffff; /* Change this to your desired text color */
        }

        .nav-link.active {
            background-color: #007bff; /* Active link background color */
            color: white;
        }
    </style>

</x-app-layout>

<x-app-layout>
    <div class="container-fluid bg-light" style="min-height: 100vh;">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 p-0 shadow-lg"
            style="background-color: #5f6469; position: fixed; top: 0; left: 0; height: 100vh; border-right: 1px solid #e0e0e0;">

            <a href="{{ route('dashboard') }}" class="d-block text-center fw-bold bg-white py-3 text-dark sidebar-link">
                <h4 class="mb-0" style="font-size: 22px;">📚 Library Menu</h4>
            </a>

            <ul class="nav flex-column px-3 mt-4">
                @foreach([
                    ['url' => 'dashboard', 'icon' => 'bi-house-door', 'label' => 'Dashboard'],
                    ['url' => 'books', 'icon' => 'bi-book', 'label' => 'Books'],
                    ['url' => 'borrowers', 'icon' => 'bi-people', 'label' => 'Borrowers'],
                    ['url' => 'category', 'icon' => 'bi-folder', 'label' => 'Category']
                ] as $menuItem)
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center fw-bold {{ request()->routeIs($menuItem['url']) ? 'active bg-primary text-white' : 'text-white' }}"
                           href="{{ route($menuItem['url']) }}"
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
                    <!-- Search Bar on Top -->
                    <div class="d-flex justify-content-center mb-4" style="position: fixed; top: 10px; left: 50%; transform: translateX(-50%); z-index: 999; width: 500px;">
                        <form action="{{ url('/search') }}" method="GET" class="w-100">
                            <div class="input-group">
                                <input type="text" name="query" class="form-control" placeholder="Search..." value="{{ request('query') }}" style="min-width: 200px;">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="bi bi-search fs-5"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Stats Cards -->
                    <div class="mt-5">
                        <div class="row g-4">
                            @foreach([
                                ['bgClass' => 'bg-white', 'icon' => 'bi-book-fill', 'title' => 'Total Books', 'count' => $bookCount, 'textClass' => 'text-primary'],
                                ['bgClass' => 'bg-white', 'icon' => 'bi-book-half', 'title' => 'Available Books', 'count' => $availableBookCount, 'textClass' => 'text-info'],
                                ['bgClass' => 'bg-white', 'icon' => 'bi-people-fill', 'title' => 'Borrowers', 'count' => $borrowerCount, 'textClass' => 'text-success']
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

                        <!-- Category-wise Books -->
                        <div class="row g-4 mt-4">
                            @foreach($categories as $category)
                                <div class="col-md-3 col-sm-6">
                                    <div class="card bg-white shadow-lg hover-shadow-lg"
                                         style="border-radius: 15px; border: 1px solid #e0e0e0; transition: all 0.3s ease;">
                                        <div class="card-body text-center">
                                            <h6 class="text-dark fw-bold mb-2">
                                                <i class="bi bi-folder-fill fs-5"></i> {{ $category->name }}
                                            </h6>
                                            <p class="fs-4 fw-bold mb-1">{{ $category->books_count ?? 0 }}</p>
                                            <small class="text-muted">Books in this category</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Search Results -->
                        @if(request('query'))
                            <div class="mt-4">
                                <h4>Search Results for "{{ request('query') }}"</h4>

                                @if($books->isEmpty() && $borrowers->isEmpty() && $categories->isEmpty())
                                    <p>No results found.</p>
                                @else
                                    <div class="row">
                                        @if($books->isNotEmpty())
                                            <div class="col-md-4">
                                                <h5>Books</h5>
                                                <ul>
                                                    @foreach($books as $book)
                                                        <li>{{ $book->title }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if($borrowers->isNotEmpty())
                                            <div class="col-md-4">
                                                <h5>Borrowers</h5>
                                                <ul>
                                                    @foreach($borrowers as $borrower)
                                                        <li>{{ $borrower->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if($categories->isNotEmpty())
                                            <div class="col-md-4">
                                                <h5>Categories</h5>
                                                <ul>
                                                    @foreach($categories as $category)
                                                        <li>{{ $category->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>

    <style>
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #4e555b; /* Change this to your desired hover background color */
            color: #ffffff; /* Change this to your desired text color */
        }

        .nav-link.active {
            background-color: #007bff; /* Active link background color */
            color: white;
        }
    </style>
    
</x-app-layout>

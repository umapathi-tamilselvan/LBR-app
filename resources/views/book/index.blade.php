<x-app-layout>
    <div class="container-fluid bg-light min-vh-100">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 p-0 shadow-lg"
            style="background-color: #9aa1a1; position: fixed; top: 0; left: 0; height: 100vh; border-right: 1px solid #e0e0e0;">

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
                <div class="card">
                    <!-- Search Bar -->
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

                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Books</h3>
                        <a href="{{ url('book/add') }}" class="btn btn-primary btn-sm">Add Book</a>
                    </div>

                    <!-- Books Grid -->
                    <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="booksGrid">
                        @forelse ($books as $book)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card shadow-lg border-0 rounded-3 hover-shadow-lg" style="transition: all 0.3s ease;">
                                <!-- Image with reduced size -->
                                <img src="{{ asset($book->image ? 'storage/' . $book->image : 'images/default-book.png') }}"
                                     class="card-img-top"
                                     alt="{{ $book->name }}"
                                     width="120" height="160"
                                     style="object-fit: cover; margin: 0 auto;">
                                <div class="card-body">
                                    <h5 class="card-title text-dark fs-6">{{ $book->name }}</h5>
                                    <p class="card-text text-muted"><strong>Author:</strong> {{ $book->author }}</p>
                                    <p class="card-text text-muted"><strong>Category:</strong> {{ $book->category->name }}</p>
                                    <p class="card-text text-muted"><strong>Total Copies:</strong> {{ $book->total_copies }}</p>
                                    <p class="card-text text-muted"><strong>Available Copies:</strong> {{ $book->available_copies }}</p>
                                    <div class="d-flex justify-content-between">
                                        <form action="{{ url('/book/delete', $book->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                            <div class="col-12">
                                <p class="text-center text-muted">No books found.</p>
                            </div>
                        @endforelse
                    </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {!! $books->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>

                <!-- Search Results -->
                @if(request('query'))
                    <div class="mt-4">
                        <h4>Search Results for "{{ request('query') }}"</h4>
                        @if($books->isEmpty() && $borrowers->isEmpty() && $categories->isEmpty())
                            <p>No results found.</p>
                        @else
                            <div class="row">
                                @foreach([
                                    ['title' => 'Books', 'items' => $books],
                                    ['title' => 'Borrowers', 'items' => $borrowers],
                                    ['title' => 'Categories', 'items' => $categories]
                                ] as $section)
                                    @if($section['items']->isNotEmpty())
                                        <div class="col-md-4">
                                            <h5>{{ $section['title'] }}</h5>
                                            <ul>
                                                @foreach($section['items'] as $item)
                                                    <li>{{ $item->name ?? $item->title }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

            </div>
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

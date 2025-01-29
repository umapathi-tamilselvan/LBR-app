<x-app-layout>
<div class="container-fluid bg-light" style="min-height: 100vh;">
    <div class="row">
        <!-- Sidebar -->
        <nav class="card-body col-md-3 col-lg-2 p-0 mt-0 shadow-lg" style="background-color: #f5f5f5; position: fixed; top: 0; left: 0; width: 300px; height: 100vh; border-right: 1px solid #e0e0e0;">
            <a href="{{ url('/home') }}" class="d-block text-center fw-bold mb-4" style="background-color: #ffffff; padding: 15px; border-bottom: 1px solid #ddd; text-decoration: none;">
                <h4 class="mb-0">Library Menu</h4>
            </a>

            <ul class="nav flex-column px-3">
                @foreach([
                    ['url' => '/home', 'icon' => 'bi-house-door', 'label' => 'Dashboard'],
                    ['url' => '/books', 'icon' => 'bi-book', 'label' => 'Books'],
                    ['url' => '/borrowers', 'icon' => 'bi-people', 'label' => 'Borrowers'],
                    ['url' => '/category', 'icon' => 'bi-folder', 'label' => 'Category']
                ] as $menuItem)
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center {{ request()->is(ltrim($menuItem['url'], '/')) ? 'active bg-primary text-white' : 'text-dark' }}"
                           href="{{ url($menuItem['url']) }}"
                           style="padding: 12px 15px; border-radius: 8px; font-size: 14px;">
                            <i class="bi {{ $menuItem['icon'] }} me-2 fs-5"></i>
                            <span>{{ $menuItem['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-left: 220px; padding-top: 20px;">
            <div class="py-4">
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
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        @if($book->image)
                                                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 10px;">
                                                        @else
                                                            <img src="{{ asset('images/default-book-image.jpg') }}" alt="Default Image" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 10px;">
                                                        @endif
                                                        {{ $book->name }}
                                                    </div>
                                                </li>
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
        </main>
    </div>
</div>
</x-app-layout>

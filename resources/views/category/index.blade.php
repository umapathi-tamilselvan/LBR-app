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

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-left: 25%; padding-top: 20px;">
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
                <div class="tab-pane fade show active" id="borrowers" role="tabpanel">
                    <div class="card shadow-lg mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Categories</h3>
                            <a href="{{ url('category/add') }}" class="btn btn-primary btn-sm">Add Category</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <form action="{{ url('category/delete', $category->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No categories available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
            background-color: #4e555b; /* Change this to your desired hover background color */
            color: #ffffff; /* Change this to your desired text color */
        }

        .nav-link.active {
            background-color: #007bff; /* Active link background color */
            color: white;
        }
    </style>

</x-app-layout>

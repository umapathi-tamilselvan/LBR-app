<x-app-layout>
    <div class="container-fluid bg-light" style="min-height: 100vh;">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 p-0 shadow-lg "
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

            < <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-left: 25%; padding-top: 20px;">

                <div class="py-4">
                    <div class="container" style="max-width: 600px;">
                        <div class="card shadow-lg mb-4">
                            <div class="card-header">
                                <h3 class="mb-0">Add New Category</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/category') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Category</label>
                                        <input type="text" class="form-control" id="name"  value="{{ old('name') }}"  name="name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

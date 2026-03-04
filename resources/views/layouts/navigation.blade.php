<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 mb-10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <!-- Left: Panel -->
            <div>
                <a href="{{ route('dashboard') }}" 
                   class="text-xl font-bold text-indigo-600 tracking-wide">
                    Admin Panel
                </a>
            </div>

            <!-- Right: Admin Dropdown -->
            <div class="relative" x-data="{ open: false }">

                <!-- Avatar Button -->
                <button @click="open = !open"
                        class="flex items-center gap-2 focus:outline-none">

                    <!-- Circle Avatar -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-500 text-dark text-2xl">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <!-- Down Arrow -->
                    <svg class="w-4 h-4 text-gray-500"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open"
                     @click.away="open = false"
                     x-transition
                     class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-lg border border-gray-100 py-3">

                    <!-- Admin Info -->
                    <div class="px-4 pb-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <!-- Companies -->
                    <div class="px-4 py-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-2">
                            Companies
                        </p>
                        <a href="{{ route('companies.create') }}"
                           class="block py-1 text-sm text-gray-700 hover:text-indigo-600">
                            + Create Company
                        </a>
                        <a href="{{ route('companies.index') }}"
                           class="block py-1 text-sm text-gray-700 hover:text-indigo-600">
                            View Companies
                        </a>
                    </div>

                    <!-- Employees -->
                    <div class="px-4 py-2 border-t border-gray-100">
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-2">
                            Employees
                        </p>
                        <a href="{{ route('employees.create') }}"
                           class="block py-1 text-sm text-gray-700 hover:text-indigo-600">
                            + Create Employee
                        </a>
                        <a href="{{ route('employees.index') }}"
                           class="block py-1 text-sm text-gray-700 hover:text-indigo-600">
                            View Employees
                        </a>
                    </div>

                    <!-- Logout -->
                    <div class="px-4 pt-3 border-t border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left text-sm text-red-500 hover:text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
</nav>
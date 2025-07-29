            <header class="km-header d-flex justify-content-between align-items-center px-4 py-3">
            <button class="btn btn-outline-light d-md-none mb-2" id="toggleSidebar">
                <i class="bi bi-list"></i> Menu
            </button>
                
            <h2 class="m-0 fw-bold">Knowledge Management Unit</h2>
                <!-- Logout Link -->
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-dark" title="Sign out">
                    <i class="fas fa-sign-out-alt fa-lg"></i>
                </a>

                <!-- Hidden Form -->
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </header>
            
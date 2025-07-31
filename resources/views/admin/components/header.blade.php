            <header class="km-header d-flex justify-content-between align-items-center py-3">
                <button class="btn btn-menu d-lg-none" id="sidebarToggle">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                
                <h2 class="m-0 fw-bold" >Knowledge Management Unit</h2>
                    <!-- Logout Link -->
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link" title="Sign out">
                        <i class="fas fa-sign-out-alt fa-lg px-2"></i>
                    </a>

                <!-- Hidden Form -->
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </header>
            
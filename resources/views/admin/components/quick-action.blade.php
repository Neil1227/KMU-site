
                    <div class="dashboard-card-quick mt-2">
                        <h5>Quick Actions</h5>
                        <div class="mt-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('admin.ictv') }}"
                                       class="btn w-100 {{ Route::currentRouteName() === 'admin.ictv' ? 'btn-primary text-white' : 'btn-outline-primary' }}">
                                        <i class="fa-solid fa-tv me-1"></i> Add ICTV
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.iec') }}"
                                       class="btn w-100 {{ Route::currentRouteName() === 'admin.iec' ? 'btn-danger text-white' : 'btn-outline-danger' }}">
                                        <i class="fa-solid fa-image me-1"></i> Add IEC Materials
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.modules') }}"
                                       class="btn w-100 {{ Route::currentRouteName() === 'admin.modules' ? 'btn-secondary text-white' : 'btn-outline-secondary' }}">
                                        <i class="fa fa-file-alt me-1"></i> Add Modules
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.newsletter') }}"
                                        class="btn w-100 {{ Route::currentRouteName() === 'admin.newsletter' ? 'btn-success text-white' : 'btn-outline-success' }}">
                                        <i class="fa-solid fa-book-open-reader me-1"></i> Add Newsletters
                                    </a>
                                </div>
                                <!-- changes this into promotional -->
                                <div class="col-6">
                                    <a href="#" class="btn btn-outline-warning w-100">
                                        <i class="fa fa-table me-1"></i> Promotional Ativities
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('index') }}" class="btn btn-outline-dark w-100">
                                        <i class="fa fa-eye me-1"></i> View Site
                                    </a>
                                </div>


                            </div>
                        </div>
@php
    $segments = request()->segments();
    $hasBreadcrumbsSection = View::hasSection('breadcrumbs');
    // We only show breadcrumbs if custom section exists OR more than 1 meaningful URL segment
    $showBreadcrumbs = $hasBreadcrumbsSection;
@endphp

@if ($showBreadcrumbs)
    <!-- Breadcrumb Section -->
    <section class="content-header py-2">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        {{-- Use provided title or fallback --}}
                        @yield('page-title', ucfirst(last($segments)))
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mb-0">
                        {{-- Home link --}}


                        {{-- Optional custom breadcrumbs --}}
                        @hasSection('breadcrumbs')
                            <li class="breadcrumb-item">
                                <a href="{{ route('tenant.dashboard', request()->route('tenant_domain')) }}">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                            @yield('breadcrumbs')
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endif
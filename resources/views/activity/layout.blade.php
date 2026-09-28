@include('layouts.partials.admin.dashboard')
<link rel="stylesheet" href="{{ asset('assets/css/activity-analytics.css') }}?v=1">
<main class="nxl-container activity-console">
    <div class="nxl-content">
        <div class="page-header"><h1 class="h4 mb-0">@yield('title', 'Admission Analytics')</h1></div>
        <div class="main-content">
            <nav class="activity-tabs" aria-label="Admission analytics">
                @foreach (['index' => 'Overview', 'leads' => 'Enquiries', 'events' => 'Activity', 'renewals' => 'Renewals'] as $key => $label)
                    <a href="{{ route('admin.activity.'.$key) }}" @if(request()->routeIs('admin.activity.'.$key)) aria-current="page" @endif>{{ $label }}</a>
                @endforeach
            </nav>
            @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if ($errors->any())<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>@endif
            @yield('activity-content')
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')

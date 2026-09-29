<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <meta name="theme-color" content="#fffdf8">

    <title>{{ !empty($sp['page']['title']) ? $sp['page']['title'] . ' · ' : '' }}Law Students</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/select2-theme.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}">

    <!-- Responsive (phone / tablet) fixes -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive-fixes.css') }}?v=6">

    <!-- Page loader (shown only when a page is slow to load) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/panel-loader.css') }}?v=1">

    <!-- Law Students brand: the website's fonts and gold palette; cream student identity -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/brand-panel.css') }}?v={{ @filemtime(public_path('assets/css/brand-panel.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/brand-panel-student.css') }}?v={{ @filemtime(public_path('assets/css/brand-panel-student.css')) }}">

    <!-- Panel suite: menu badges, search, page bar, phone navigation, display settings, wide screens -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/panel-suite.css') }}?v={{ @filemtime(public_path('assets/css/panel-suite.css')) }}">

    <!-- IE Support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        /* Saved display choices (text size, calm motion) apply before the first paint. */
        (function () {
            try {
                var d = document.documentElement, s = window.localStorage;
                ['density', 'fs', 'calm'].forEach(function (k) {
                    var v = s.getItem('ls.' + k);
                    if (v) { d.setAttribute('data-ls-' + k, v); }
                });
            } catch (e) { /* storage blocked: defaults apply */ }
        })();
    </script>
</head>


@php
    $sp = $sp ?? ['nav' => [], 'page' => [], 'index' => [], 'alerts' => ['count' => 0, 'items' => []], 'office' => []];
    $spPage = $sp['page'] ?? [];
    $spRoute = $spPage['route'] ?? null;
    $spAlerts = $sp['alerts'] ?? ['count' => 0, 'items' => []];
    $spOffice = $sp['office'] ?? [];
    $lsPayload = [
        'route' => $spRoute,
        'console' => 'Student Portal',
        'page' => [
            'title' => $spPage['title'] ?? null,
            'kind' => $spPage['kind'] ?? 'other',
            'crumbs' => $spPage['crumbs'] ?? [],
            'actions' => $spPage['actions'] ?? [],
            'related' => $spPage['related'] ?? [],
            'related_label' => $spPage['related_label'] ?? 'Related',
            'summary' => $spPage['summary'] ?? null,
        ],
        'index' => $sp['index'] ?? [],
        'endpoints' => new \stdClass(),
        'keys' => [
            'go' => ['d' => 'Dashboard', 'a' => 'Admission', 'f' => 'Fee Summary', 'c' => 'Courses', 'i' => 'ID Card', 'h' => 'Help & Support'],
            'create' => null,
            'jump' => ['Dashboard', 'Admission', 'Fee Summary', 'ID Card', 'Courses', 'Favourite Notes', 'Help & Support'],
        ],
        'site' => url('/'),
        'today' => now()->format('Y-m-d'),
    ];
@endphp
<body class="ls-student" data-ls-page="{{ $spRoute }}" data-ls-kind="{{ $spPage['kind'] ?? 'other' }}">
    <!-- Page loader: panel-loader.js shows it only when loading takes more than a moment. -->
    <div class="panel-loader" id="panelLoader" role="status" aria-live="polite" aria-hidden="true">
        <div class="panel-loader__icon">
            <div class="panel-loader__ring"></div>
            <div class="panel-loader__ring panel-loader__ring--outer"></div>
            <img src="{{ asset('assets/theme/images/preloader.svg') }}" alt="">
        </div>
        <div class="panel-loader__text">Law Students</div>
        <span class="visually-hidden">Loading, please wait…</span>
    </div>
    <script src="{{ asset('assets/js/panel-loader.js') }}?v=1"></script>

    <a class="ls-skip" href="#lsMain">Skip to content</a>

    <!--! ================================================================ !-->
    <!--! [Start] Navigation Manu !-->
    <!--! ================================================================ !-->
    <nav class="nxl-navigation" aria-label="Main menu">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('student.dashboard') }}" class="b-brand" style="display:flex; align-items:center; height:60px;">

                    <!-- Large Logo -->
                    <img src="{{ asset('assets/theme/images/logo-full-720.png') }}" alt="Law Students" class="logo logo-lg"
                        style="height:50px; width:auto; max-width:180px; object-fit:contain;">

                    <!-- Small Logo -->
                    <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="" class="logo logo-sm"
                        style="height:40px; width:auto; max-width:60px; object-fit:contain;">

                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar" id="lsNavbar">
                    @foreach ($sp['nav'] as $item)
                        @if (isset($item['caption']))
                            <li class="nxl-item nxl-caption">
                                <label>{{ $item['caption'] }}</label>
                            </li>
                        @elseif (empty($item['children']))
                            <li class="nxl-item {{ $item['active'] ? 'active' : '' }}" data-ls-key="{{ $item['key'] }}">
                                <a href="{{ $item['url'] }}" class="nxl-link" @if ($item['active']) aria-current="page" @endif>
                                    <span class="nxl-micon"><i class="feather-{{ $item['icon'] }}"></i></span>
                                    <span class="nxl-mtext">{{ $item['label'] }}</span>
                                    @if ($item['badge'])
                                        <span class="ls-nav-badge ls-nav-badge--{{ $item['badge_tone'] }}" title="{{ $item['badge_title'] }}">{{ $item['badge'] }}</span>
                                    @endif
                                </a>
                            </li>
                        @else
                            <li class="nxl-item nxl-hasmenu {{ $item['active'] ? 'active nxl-trigger' : '' }}" data-ls-key="{{ $item['key'] }}">
                                <a href="javascript:void(0);" class="nxl-link">
                                    <span class="nxl-micon"><i class="feather-{{ $item['icon'] }}"></i></span>
                                    <span class="nxl-mtext">{{ $item['label'] }}</span>
                                    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                                </a>
                                <ul class="nxl-submenu">
                                    @foreach ($item['children'] as $child)
                                        <li class="nxl-item {{ $child['active'] ? 'active' : '' }}">
                                            <a class="nxl-link" href="{{ $child['url'] }}" @if ($child['active']) aria-current="page" @endif>{{ $child['label'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <div class="ls-nav-foot">
                    <a href="{{ route('frontend.contact') }}" target="_blank" rel="noopener" class="ls-nav-foot__link">
                        <i class="feather-message-circle" aria-hidden="true"></i><span>Contact the office</span>
                    </a>
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="ls-nav-foot__link">
                        <i class="feather-external-link" aria-hidden="true"></i><span>Law Students website</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!--! ================================================================ !-->
    <!--! [End]  Navigation Manu !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Header !-->
    <!--! ================================================================ !-->
    <header class="nxl-header">
        <div class="header-wrapper">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler d-lg-none" id="mobile-collapse" aria-label="Open menu">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--! [End] Header Left !-->

            <div class="ls-header-search">
                <button type="button" class="ls-search-trigger" data-ls-open="palette" aria-label="Find a page">
                    <i class="feather-search" aria-hidden="true"></i>
                    <span class="ls-search-trigger__text">Find a page…</span>
                    <kbd class="ls-kbd" data-ls-kbd="K">Ctrl K</kbd>
                </button>
            </div>

            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">

                    <div class="nxl-h-item ls-h-search">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-ls-open="palette" role="button" aria-label="Find a page">
                            <i class="feather-search"></i>
                        </a>
                    </div>

                    <!-- what needs attention -->
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 ls-bell" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside"
                            aria-label="Notices{{ $spAlerts['count'] ? ': ' . $spAlerts['count'] . ' need attention' : '' }}">
                            <i class="feather-bell"></i>
                            @if ($spAlerts['count'] > 0)<span class="ls-bell__dot">{{ $spAlerts['count'] }}</span>@endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown ls-attention-menu">
                            <div class="ls-menu-title">Your notices</div>
                            @forelse ($spAlerts['items'] as $a)
                                <a href="{{ $a['url'] }}" class="dropdown-item ls-attention-item ls-state-{{ $a['state'] }}">
                                    <span class="ls-attention-item__icon"><i class="feather-{{ $a['icon'] }}"></i></span>
                                    <span class="ls-attention-item__text"><strong>{{ $a['label'] }}: {{ $a['text'] }}</strong><br><small class="text-muted">{{ $a['detail'] }}</small></span>
                                </a>
                            @empty
                                <div class="ls-attention-empty"><i class="feather-check-circle" aria-hidden="true"></i> You are all up to date.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0"
                                onclick="$('body').fullScreenHelper('toggle');" aria-label="Full screen">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button" aria-label="Dark mode">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none" aria-label="Light mode">
                            <i class="feather-sun"></i>
                        </a>
                    </div>

                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button"
                            data-bs-auto-close="outside" aria-label="Account and display settings">
                            <img src="{{ auth('student')->user()?->admission?->photo
                                ? asset('storage/app/public/' . auth('student')->user()->admission->photo)
                                : asset('assets/images/avatar/1.png') }}"
                                class="img-fluid user-avtar" alt="user-image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="{{ auth('student')->user()?->admission?->photo
                                        ? asset('storage/app/public/' . auth('student')->user()->admission->photo)
                                        : asset('assets/images/avatar/1.png') }}"
                                        class="img-fluid user-avtar" alt="user-image">
                                    <div>
                                        <h6 class="text-dark mb-0">{{ auth('student')->user()?->name }}</h6>
                                        <span
                                            class="fs-12 fw-medium text-muted" title="{{ auth('student')->user()?->email }}">{{ auth('student')->user()?->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="ls-prefs" aria-label="Display settings">
                                <div class="ls-prefs__row">
                                    <span class="ls-prefs__label">Text size</span>
                                    <div class="ls-seg" role="group" aria-label="Text size">
                                        <button type="button" data-ls-pref="fs" data-value="s" aria-label="Smaller text" style="font-size:11px">A</button>
                                        <button type="button" data-ls-pref="fs" data-value="m" aria-label="Normal text" style="font-size:14px">A</button>
                                        <button type="button" data-ls-pref="fs" data-value="l" aria-label="Larger text" style="font-size:17px">A</button>
                                        <button type="button" data-ls-pref="fs" data-value="xl" aria-label="Largest text" style="font-size:20px">A</button>
                                    </div>
                                </div>
                                <div class="ls-prefs__row">
                                    <span class="ls-prefs__label">Calm motion</span>
                                    <div class="ls-seg" role="group" aria-label="Calm motion">
                                        <button type="button" data-ls-pref="calm" data-value="off">Off</button>
                                        <button type="button" data-ls-pref="calm" data-value="on">On</button>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('student.viewstudent') }}" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Profile Details</span>
                            </a>
                            <a href="{{ route('student.help') }}" class="dropdown-item">
                                <i class="feather-help-circle"></i>
                                <span>Help &amp; Support</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item" data-ls-open="shortcuts">
                                <i class="feather-command"></i>
                                <span>Keyboard shortcuts</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="feather-log-out"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>
    <!--! ================================================================ !-->
    <!--! [End] Header !-->
    <!--! ================================================================ !-->

    <!--! ================================================================ !-->
    <!--! Panel suite: page finder, shortcuts, phone bottom bar !-->
    <!--! ================================================================ !-->
    <script type="application/json" id="lsPanelData">{!! json_encode($lsPayload, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    <div class="ls-palette" id="lsPalette" role="dialog" aria-modal="true" aria-label="Find a page" hidden>
        <div class="ls-palette__backdrop" data-ls-close></div>
        <div class="ls-palette__panel">
            <div class="ls-palette__field">
                <i class="feather-search" aria-hidden="true"></i>
                <input type="search" id="lsPaletteInput" placeholder="Find a page: fees, admission, ID card, courses…" autocomplete="off" spellcheck="false" enterkeyhint="search" aria-label="Find a page">
                <button type="button" class="ls-palette__close" data-ls-close aria-label="Close"><span class="ls-kbd">Esc</span><i class="feather-x"></i></button>
            </div>
            <div class="ls-palette__body" id="lsPaletteBody" role="listbox" aria-label="Results"></div>
            <div class="ls-palette__foot">
                <span><kbd class="ls-kbd">↑</kbd><kbd class="ls-kbd">↓</kbd> move</span>
                <span><kbd class="ls-kbd">Enter</kbd> open</span>
                <span><kbd class="ls-kbd">Esc</kbd> close</span>
            </div>
        </div>
    </div>

    <div class="ls-dialog" id="lsShortcuts" role="dialog" aria-modal="true" aria-labelledby="lsShortcutsTitle" hidden>
        <div class="ls-dialog__backdrop" data-ls-close></div>
        <div class="ls-dialog__panel">
            <div class="ls-dialog__head">
                <h2 id="lsShortcutsTitle">Keyboard shortcuts</h2>
                <button type="button" class="ls-dialog__x" data-ls-close aria-label="Close"><i class="feather-x"></i></button>
            </div>
            <div class="ls-dialog__body">
                <dl class="ls-keys">
                    <div><dt><kbd class="ls-kbd" data-ls-kbd="K">Ctrl K</kbd> or <kbd class="ls-kbd">/</kbd></dt><dd>Find a page</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">D</kbd></dt><dd>Go to Dashboard</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">A</kbd></dt><dd>Go to Admission</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">F</kbd></dt><dd>Go to Fee Summary</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">C</kbd></dt><dd>Go to Courses</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">I</kbd></dt><dd>Go to ID Card</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">H</kbd></dt><dd>Go to Help &amp; Support</dd></div>
                    <div><dt><kbd class="ls-kbd">?</kbd></dt><dd>Show this list</dd></div>
                </dl>
                <h3 class="ls-dialog__sub">Reading comfortably</h3>
                <ul class="ls-tips">
                    <li>Open your photo (top right) to make the text larger or turn animations off.</li>
                    <li>The moon button switches between light and dark.</li>
                    <li>Press the ☆ beside a page title to pin that page to the top of the menu.</li>
                </ul>
            </div>
        </div>
    </div>

    <nav class="ls-bottomnav ls-bottomnav--flat" aria-label="Quick navigation">
        <a href="{{ route('student.dashboard') }}" class="ls-bottomnav__item {{ $spRoute === 'student.dashboard' ? 'is-active' : '' }}">
            <i class="feather-home" aria-hidden="true"></i><span>Home</span>
        </a>
        <a href="{{ route('student.listcourse') }}" class="ls-bottomnav__item {{ in_array($spRoute, ['student.listcourse', 'student.viewcourse'], true) ? 'is-active' : '' }}">
            <i class="feather-book-open" aria-hidden="true"></i><span>Courses</span>
        </a>
        <a href="{{ route('student.fees') }}" class="ls-bottomnav__item {{ $spRoute === 'student.fees' ? 'is-active' : '' }}">
            <i class="feather-credit-card" aria-hidden="true"></i><span>Fees</span>
        </a>
        <a href="{{ route('student.viewidcard') }}" class="ls-bottomnav__item {{ $spRoute === 'student.viewidcard' ? 'is-active' : '' }}">
            <i class="feather-user-check" aria-hidden="true"></i><span>ID Card</span>
        </a>
        <button type="button" class="ls-bottomnav__item" data-ls-open="menu">
            <i class="feather-menu" aria-hidden="true"></i><span>Menu</span>
        </button>
    </nav>

    <!--! ================================================================ !-->
    <!--! [Start] Session Timeout Warning !-->
    <!--! ================================================================ !-->
    @include('layouts.partials.student.session-timeout-warning')
    <!--! ================================================================ !-->
    <!--! [End] Session Timeout Warning !-->
    <!--! ================================================================ !-->

    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->

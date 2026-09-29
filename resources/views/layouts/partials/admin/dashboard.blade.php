<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <meta name="theme-color" content="#16130e">

    <title>{{ !empty($ap['page']['title']) ? $ap['page']['title'] . ' · ' : '' }}Law Students Admin</title>

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

    <!-- Law Students brand: the website's fonts and gold palette; ink-black admin identity -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/brand-panel.css') }}?v={{ @filemtime(public_path('assets/css/brand-panel.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/brand-panel-admin.css') }}?v={{ @filemtime(public_path('assets/css/brand-panel-admin.css')) }}">

    <!-- Admin suite: menu groups, search, related-action bars, table tools, phone navigation, wide screens -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/panel-suite.css') }}?v={{ @filemtime(public_path('assets/css/panel-suite.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-workflows.css') }}?v={{ @filemtime(public_path('assets/css/admin-workflows.css')) }}">

    <!-- IE Support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        /* Saved display choices (density, text size, calm motion) apply before the first paint. */
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
    $ap = $ap ?? ['nav' => [], 'page' => [], 'create' => [], 'index' => [], 'badges' => []];
    $apPage = $ap['page'] ?? [];
    $apBadges = $ap['badges'] ?? [];
    $apRoute = $apPage['route'] ?? null;
    $lsPayload = [
        'route' => $apRoute,
        'page' => [
            'title' => $apPage['title'] ?? null,
            'subtitle' => $apPage['subtitle'] ?? null,
            'kind' => $apPage['kind'] ?? 'other',
            'crumbs' => $apPage['crumbs'] ?? [],
            'actions' => $apPage['actions'] ?? [],
            'related' => $apPage['related'] ?? [],
            'summary' => $apPage['summary'] ?? null,
        ],
        'index' => $ap['index'] ?? [],
        'endpoints' => [
            'search' => \Illuminate\Support\Facades\Route::has('admin.tools.search') ? route('admin.tools.search') : null,
            'related' => \Illuminate\Support\Facades\Route::has('admin.tools.related') ? route('admin.tools.related') : null,
        ],
        'site' => url('/'),
        'today' => now()->format('Y-m-d'),
    ];
    $bellCount = (int) ($apBadges['messages'] ?? 0) + (int) ($apBadges['leads'] ?? 0) + (int) ($apBadges['pending_payments'] ?? 0);
@endphp
<body class="ls-admin" data-ls-page="{{ $apRoute }}" data-ls-kind="{{ $apPage['kind'] ?? 'other' }}">
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
                <a href="{{ route('admin.dashboard') }}" class="b-brand" style="display:flex; align-items:center; height:60px;">

                    <!-- Large Logo -->
                    <img src="{{ asset('assets/theme/images/logo-full-720-light.png') }}" alt="Law Students" class="logo logo-lg"
                        style="height:50px; width:auto; max-width:180px; object-fit:contain;">

                    <!-- Small Logo -->
                    <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="" class="logo logo-sm"
                        style="height:40px; width:auto; max-width:60px; object-fit:contain;">

                </a>
            </div>
            <div class="navbar-content">
                <div class="ls-nav-search">
                    <i class="feather-search" aria-hidden="true"></i>
                    <input type="search" id="lsNavFilter" placeholder="Find a menu item" aria-label="Find a menu item" autocomplete="off" spellcheck="false">
                </div>

                <ul class="nxl-navbar" id="lsNavbar">
                    @foreach ($ap['nav'] as $item)
                        @if (isset($item['caption']))
                            <li class="nxl-item nxl-caption">
                                <label>{{ $item['caption'] }}</label>
                            </li>
                        @elseif (empty($item['children']))
                            <li class="nxl-item {{ $item['active'] ? 'active' : '' }}" data-ls-key="{{ $item['key'] }}">
                                <a href="{{ $item['url'] }}" class="nxl-link" @if ($item['active']) aria-current="page" @endif>
                                    <span class="nxl-micon"><i class="feather-{{ $item['icon'] }}"></i></span>
                                    <span class="nxl-mtext">{{ $item['label'] }}</span>
                                    @if ($item['badge'] > 0)
                                        <span class="ls-nav-badge ls-nav-badge--{{ $item['badge_tone'] }}" title="{{ $item['badge_title'] }}">{{ $item['badge'] > 99 ? '99+' : $item['badge'] }}</span>
                                    @endif
                                </a>
                            </li>
                        @else
                            <li class="nxl-item nxl-hasmenu {{ $item['active'] ? 'active nxl-trigger' : '' }}" data-ls-key="{{ $item['key'] }}">
                                <a href="javascript:void(0);" class="nxl-link">
                                    <span class="nxl-micon"><i class="feather-{{ $item['icon'] }}"></i></span>
                                    <span class="nxl-mtext">{{ $item['label'] }}</span>
                                    @if ($item['badge'] > 0)
                                        <span class="ls-nav-badge ls-nav-badge--{{ $item['badge_tone'] }}" title="{{ $item['badge_title'] }}">{{ $item['badge'] > 99 ? '99+' : $item['badge'] }}</span>
                                    @endif
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
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="ls-nav-foot__link">
                        <i class="feather-external-link" aria-hidden="true"></i><span>View website</span>
                    </a>
                    <button type="button" class="ls-nav-foot__link" data-ls-open="shortcuts">
                        <i class="feather-help-circle" aria-hidden="true"></i><span>Shortcuts &amp; help</span>
                    </button>
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

            <!--! [Start] Header Search !-->
            <div class="ls-header-search">
                <button type="button" class="ls-search-trigger" data-ls-open="palette" aria-label="Search students, payments and pages">
                    <i class="feather-search" aria-hidden="true"></i>
                    <span class="ls-search-trigger__text">Search students, payments, pages…</span>
                    <kbd class="ls-kbd" data-ls-kbd="K">Ctrl K</kbd>
                </button>
            </div>
            <!--! [End] Header Search !-->

            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">

                    <!-- search (phones) -->
                    <div class="nxl-h-item ls-h-search">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-ls-open="palette" role="button" aria-label="Search">
                            <i class="feather-search"></i>
                        </a>
                    </div>

                    <!-- quick create -->
                    <div class="dropdown nxl-h-item ls-h-create">
                        <a href="javascript:void(0);" class="ls-new-btn" data-bs-toggle="dropdown" role="button" data-bs-auto-close="true" aria-expanded="false" aria-label="Create new">
                            <i class="feather-plus" aria-hidden="true"></i><span>New</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown ls-create-menu">
                            <div class="ls-menu-title">Create</div>
                            @foreach ($ap['create'] as $c)
                                <a href="{{ $c['url'] }}" class="dropdown-item ls-create-item">
                                    <span class="ls-create-item__icon"><i class="feather-{{ $c['icon'] }}"></i></span>
                                    <span class="ls-create-item__text">
                                        <strong>{{ $c['label'] }}</strong>
                                        @if (!empty($c['hint']))<small>{{ $c['hint'] }}</small>@endif
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- view website -->
                    <div class="nxl-h-item d-none d-md-flex">
                        <a href="{{ url('/') }}" target="_blank" rel="noopener" class="nxl-head-link me-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Open the website" aria-label="Open the website">
                            <i class="feather-globe"></i>
                        </a>
                    </div>

                    <!-- attention -->
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 ls-bell" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside" aria-label="Needs attention{{ $bellCount ? ': ' . $bellCount : '' }}">
                            <i class="feather-bell"></i>
                            @if ($bellCount > 0)<span class="ls-bell__dot">{{ $bellCount > 99 ? '99+' : $bellCount }}</span>@endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown ls-attention-menu">
                            <div class="ls-menu-title">Needs attention</div>
                            <a href="{{ route('admin.listcontactform') }}" class="dropdown-item ls-attention-item">
                                <span class="ls-attention-item__icon"><i class="feather-inbox"></i></span>
                                <span class="ls-attention-item__text"><strong>{{ (int) ($apBadges['messages'] ?? 0) }}</strong> contact message{{ ($apBadges['messages'] ?? 0) == 1 ? '' : 's' }} in the last 7 days</span>
                            </a>
                            <a href="{{ route('admin.activity.leads') }}" class="dropdown-item ls-attention-item">
                                <span class="ls-attention-item__icon"><i class="feather-phone-call"></i></span>
                                <span class="ls-attention-item__text"><strong>{{ (int) ($apBadges['leads'] ?? 0) }}</strong> new admission enquir{{ ($apBadges['leads'] ?? 0) == 1 ? 'y' : 'ies' }}</span>
                            </a>
                            <a href="{{ route('admin.reports.dues', ['filter' => 'overdue']) }}" class="dropdown-item ls-attention-item">
                                <span class="ls-attention-item__icon"><i class="feather-alert-circle"></i></span>
                                <span class="ls-attention-item__text"><strong>{{ (int) ($apBadges['pending_payments'] ?? 0) }}</strong> overdue payment{{ ($apBadges['pending_payments'] ?? 0) == 1 ? '' : 's' }}</span>
                            </a>
                            <a href="{{ route('admin.listadmission') }}" class="dropdown-item ls-attention-item">
                                <span class="ls-attention-item__icon"><i class="feather-file-text"></i></span>
                                <span class="ls-attention-item__text"><strong>{{ (int) ($apBadges['approvals'] ?? 0) }}</strong> admission{{ ($apBadges['approvals'] ?? 0) == 1 ? '' : 's' }} waiting for approval</span>
                            </a>
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

                    @php
                    use App\Models\User;
                    $admin = User::first();
                    @endphp
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button"
                            data-bs-auto-close="outside" aria-label="Account and display settings">
                            <img src="{{ !empty($admin->image) && file_exists(public_path('storage/app/public/' . $admin->image))
                            ? asset('storage/app/public/' . $admin->image)
                            : asset('assets/images/avatar/1.png') }}"
                                alt="user-image" class="img-fluid user-avtar me-0">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="{{ !empty($admin->image) && file_exists(public_path('storage/app/public/' . $admin->image))
                                    ? asset('storage/app/public/' . $admin->image)
                                    : asset('assets/images/avatar/1.png') }}"
                                        alt="user-image" class="img-fluid user-avtar">

                                    <div>
                                        <h6 class="text-dark mb-0">{{ auth('admin')->user()?->name }}</h6>
                                        <span
                                            class="fs-12 fw-medium text-muted" title="{{ auth('admin')->user()?->email }}">{{ auth('admin')->user()?->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="ls-prefs" aria-label="Display settings">
                                <div class="ls-prefs__row">
                                    <span class="ls-prefs__label">Row spacing</span>
                                    <div class="ls-seg" role="group" aria-label="Row spacing">
                                        <button type="button" data-ls-pref="density" data-value="comfortable">Roomy</button>
                                        <button type="button" data-ls-pref="density" data-value="compact">Compact</button>
                                    </div>
                                </div>
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

                            <a href="{{ route('admin.admindetails') }}" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Profile Details</span>
                            </a>
                            <a href="{{ route('admin.help') }}" class="dropdown-item">
                                <i class="feather-help-circle"></i>
                                <span>Help &amp; Guide</span>
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
    <!--! Admin suite: search palette, shortcuts, create sheet, phone bottom bar !-->
    <!--! ================================================================ !-->
    <script type="application/json" id="lsPanelData">{!! json_encode($lsPayload, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    <div class="ls-palette" id="lsPalette" role="dialog" aria-modal="true" aria-label="Search" hidden>
        <div class="ls-palette__backdrop" data-ls-close></div>
        <div class="ls-palette__panel">
            <div class="ls-palette__field">
                <i class="feather-search" aria-hidden="true"></i>
                <input type="search" id="lsPaletteInput" placeholder="Search students, payments, courses, pages…" autocomplete="off" spellcheck="false" enterkeyhint="search" aria-label="Search">
                <button type="button" class="ls-palette__close" data-ls-close aria-label="Close search"><span class="ls-kbd">Esc</span><i class="feather-x"></i></button>
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
                <h2 id="lsShortcutsTitle">Shortcuts &amp; help</h2>
                <button type="button" class="ls-dialog__x" data-ls-close aria-label="Close"><i class="feather-x"></i></button>
            </div>
            <div class="ls-dialog__body">
                <dl class="ls-keys">
                    <div><dt><kbd class="ls-kbd" data-ls-kbd="K">Ctrl K</kbd> or <kbd class="ls-kbd">/</kbd></dt><dd>Search students, payments, courses and pages</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">D</kbd></dt><dd>Go to Dashboard</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">S</kbd></dt><dd>Go to Students</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">A</kbd></dt><dd>Go to Admissions</dd></div>
                    <div><dt><kbd class="ls-kbd">G</kbd> then <kbd class="ls-kbd">P</kbd></dt><dd>Go to Payments</dd></div>
                    <div><dt><kbd class="ls-kbd">N</kbd></dt><dd>Add a new student</dd></div>
                    <div><dt><kbd class="ls-kbd">?</kbd></dt><dd>Show this help</dd></div>
                </dl>
                <h3 class="ls-dialog__sub">In every list</h3>
                <ul class="ls-tips">
                    <li>Type in <strong>Filter this page</strong> to narrow the rows you can see. Use the search (<kbd class="ls-kbd" data-ls-kbd="K">Ctrl K</kbd>) to look through all records.</li>
                    <li>Click a column heading to sort. Use <strong>Columns</strong> to hide what you do not need.</li>
                    <li><strong>Export</strong> saves the rows on screen as a spreadsheet file, prints them, or copies them.</li>
                    <li>Use the <strong>⋯</strong> button on a row for the student's other records (admission, payment, ID card, activity) and to email, call or WhatsApp.</li>
                    <li>Star a page (☆ next to its title) to pin it to the top of the menu.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="ls-sheet" id="lsCreateSheet" role="dialog" aria-modal="true" aria-label="Create" hidden>
        <div class="ls-sheet__backdrop" data-ls-close></div>
        <div class="ls-sheet__panel">
            <div class="ls-sheet__grab" aria-hidden="true"></div>
            <div class="ls-menu-title">Create</div>
            <div class="ls-sheet__grid">
                @foreach ($ap['create'] as $c)
                    <a href="{{ $c['url'] }}" class="ls-sheet__item">
                        <span class="ls-create-item__icon"><i class="feather-{{ $c['icon'] }}"></i></span>
                        <span>{{ $c['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <nav class="ls-bottomnav" aria-label="Quick navigation">
        <a href="{{ route('admin.dashboard') }}" class="ls-bottomnav__item {{ $apRoute === 'admin.dashboard' ? 'is-active' : '' }}">
            <i class="feather-home" aria-hidden="true"></i><span>Home</span>
        </a>
        <a href="{{ route('admin.liststudent') }}" class="ls-bottomnav__item {{ in_array($apRoute, ['admin.liststudent', 'admin.viewstudent', 'admin.editstudent', 'admin.addstudent'], true) ? 'is-active' : '' }}">
            <i class="feather-users" aria-hidden="true"></i><span>Students</span>
        </a>
        <button type="button" class="ls-bottomnav__fab" data-ls-open="create" aria-label="Create new">
            <i class="feather-plus" aria-hidden="true"></i>
        </button>
        <a href="{{ route('admin.listpayment') }}" class="ls-bottomnav__item {{ in_array($apRoute, ['admin.listpayment', 'admin.editpayment'], true) ? 'is-active' : '' }}">
            <i class="feather-credit-card" aria-hidden="true"></i><span>Payments</span>
        </a>
        <button type="button" class="ls-bottomnav__item" data-ls-open="menu">
            <i class="feather-menu" aria-hidden="true"></i><span>Menu</span>
        </button>
    </nav>

    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">

    <title>Law Students</title>

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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive-fixes.css') }}?v=4">

    <!-- Page loader (shown only when a page is slow to load) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/panel-loader.css') }}?v=1">

    <!-- IE Support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body>
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
    <!--! ================================================================ !-->
    <!--! [Start] Navigation Manu !-->
    <!--! ================================================================ !-->
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('admin.dashboard') }}" class="b-brand" style="display:flex; align-items:center; height:60px;">

                    <!-- Large Logo -->
                    <img src="{{ asset('assets/images/logo-full.png') }}" alt="" class="logo logo-lg"
                        style="height:50px; width:auto; max-width:180px; object-fit:contain;">

                    <!-- Small Logo -->
                    <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="" class="logo logo-sm"
                        style="height:40px; width:auto; max-width:60px; object-fit:contain;">

                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>

                    <!-- Dashboard -->
                    <li class="nxl-item">
                        <a href="{{ route('admin.dashboard') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-home"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>

                    <!-- Applications -->
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-file-text"></i></span>
                            <span class="nxl-mtext">Applications</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.liststudent') }}">List
                                    Students</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.listadmission') }}">List
                                    Admissions</a></li>
                        </ul>
                    </li>

                    <!-- Payment -->
                    <li class="nxl-item">
                        <a href="{{ route('admin.listpayment') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-credit-card"></i></span>
                            <span class="nxl-mtext">Payments</span>
                        </a>
                    </li>

                    <!-- ID Card -->
                    <li class="nxl-item">
                        <a href="{{ route('admin.listidcard') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-user"></i></span>
                            <span class="nxl-mtext">ID Cards</span>
                        </a>
                    </li>

                    <!-- Course -->
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-book-open"></i></span>
                            <span class="nxl-mtext">Course</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.listcoursecategory') }}">List Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.listcoursesubcategory') }}">List Sub Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.listcourse') }}">List Courses</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.listnotes') }}">Notes</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.listsubjects') }}">Course Subjects</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Client -->

                    <li class="nxl-item">
                        <a href="{{ route('admin.listclientele') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-briefcase"></i></span>
                            <span class="nxl-mtext">Clients</span>
                        </a>
                    </li>

                    <!-- Acts -->

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-book"></i></span>
                            <span class="nxl-mtext">Acts</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listactcategories') }}">List Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listactsubcategories') }}">List Sub Categories</a>
                            </li>

                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listacts') }}">List Acts</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Rules -->

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-shield"></i></span>
                            <span class="nxl-mtext">Rules</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listrulescategories') }}">List Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listrulessubcategories') }}">List Sub Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listrules') }}">List</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Centre & State Govt. Examination -->

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-award"></i></span>
                            <span class="nxl-mtext">Govt. Examination</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listgovtexamcategories') }}">List Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listgovtexamsubcategories') }}">List Sub Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listgovtexams') }}">List</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Legal Knowledge (library) -->

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-book-open"></i></span>
                            <span class="nxl-mtext">Legal Knowledge</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listlegalknowledgelibrarycategories') }}">List Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listlegalknowledgelibrarysubcategories') }}">List Sub Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listlegalknowledgelibrary') }}">List</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Free Notes -->

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-edit"></i></span>
                            <span class="nxl-mtext">Free Notes</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listcopyscategories') }}">List Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listcopyssubcategories') }}">List Sub Categories</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listcopys') }}">List Free Notes</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nxl-item">
                        <a href="{{ route('admin.listcontactform') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Contact list</span>
                        </a>
                    </li>

                    <li class="nxl-item">
                        <a href="{{ route('admin.liststudentactivity') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-activity"></i></span>
                            <span class="nxl-mtext">Student Activity</span>
                        </a>
                    </li>


                    <!-- Frontend -->
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-layout"></i></span>
                            <span class="nxl-mtext">Frontend</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>

                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listbanner') }}">Banner</a></li>
                        </ul>

                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listgallery') }}">Gallery</a></li>
                        </ul>

                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.whatsapp') }}">Whatsapp</a></li>
                        </ul>

                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.listsitepages') }}">Site Pages</a></li>
                        </ul>
                    </li>

                    <!-- Setting -->
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-settings"></i></span>
                            <span class="nxl-mtext">Setting</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>

                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.mailsetting') }}">Mail</a></li>
                        </ul>

                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{ route('admin.admindetails') }}">Admin</a></li>
                        </ul>
                    </li>

                </ul>
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

                <a href="javascript:void(0);" class="nxl-head-mobile-toggler d-lg-none" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>


            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0"
                                onclick="$('body').fullScreenHelper('toggle');">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>

                    @php
                    use App\Models\User;
                    $admin = User::first();
                    @endphp
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button"
                            data-bs-auto-close="outside">
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
                                        alt="user-image" class="img-fluid user-avtar me-0">

                                    <div>
                                        <h6 class="text-dark mb-0">{{ auth('admin')->user()?->name }}</h6>
                                        <span
                                            class="fs-12 fw-medium text-muted">{{ auth('admin')->user()?->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.admindetails') }}" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Profile Details</span>
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
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
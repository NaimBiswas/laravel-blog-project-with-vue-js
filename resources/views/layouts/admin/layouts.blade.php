<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport"
            content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Blank Page</title>


        <link rel="stylesheet"
            href="{{ mix('css/app.css')
             }}">


        <style>
            a.nav-link.router-link-exact-active.router-link-active {
                background: #af0000;
            }

            .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
            .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
                background-color: #09b0a8bd;
                color: #fff;
            }

            .main-header {
                box-shadow: 4px 5px 18px 1px #151515c4;
            }

        </style>
    </head>

    <body class="hold-transition sidebar-mini sidebar-mini dark-mode">
        <!-- Site wrapper -->
        <div class="wrapper"
            id="app">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link"
                            data-widget="pushmenu"
                            href="#"
                            role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#"
                            class="nav-link">Contact</a>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar"
                            type="search"
                            placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar"
                                type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Right navbar links -->
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('dashboard') }}"
                    class="brand-link">
                    <img src="{{ asset('asset') }}/img/AdminLTELogo.png"
                        alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('asset') }}/img/user2-160x160.jpg"
                                class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#"
                                class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- SidebarSearch Form -->
                    <div class="form-inline">
                        <div class="input-group"
                            data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar"
                                type="search"
                                placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <router-link to="/dashboard"
                                    class="nav-link"
                                    active-class="active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard

                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/category"
                                    class="nav-link"
                                    active-class="active">
                                    <i class="nav-icon fas fa-feather-alt"></i>
                                    <p>
                                        Catgories

                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/tag"
                                    class="nav-link"
                                    active-class="active">
                                    <i class="nav-icon fas fa-at"></i>
                                    <p>
                                        Tags

                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/post"
                                    class="nav-link"
                                    active-class="active">
                                    <i class="nav-icon fas fa-clone"></i>
                                    <p>
                                        Posts

                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}"
                                    method="POST">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        class="nav-link"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">

                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>
                                            Log-Out
                                        </p>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->


                <!-- Main content -->
                <section class="content">

                    <router-view></router-view>
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.1.0-rc
                </div>
                <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <script text="text/javascript"
            src="{{ mix('js/app.js') }}"></script>

        <script type="text/javascript">
            //
	if ('WebSocket' in window) {
        (function () {
            function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
                    var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
                if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
        console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}

        </script>

    </body>

</html>

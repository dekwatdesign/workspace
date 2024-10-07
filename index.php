<?php
require './configs/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Switcher</title>

    <link rel="apple-touch-icon" sizes="180x180" href="./assets/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/logo/favicon-16x16.png">
    <link rel="manifest" href="./assets/logo/site.webmanifest">

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="./assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="./assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="./assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="./assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!-- Modified -->
    <link href="./assets/css/fontawesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./assets/css/fonts.css" rel="stylesheet" type="text/css" />
    <link href="./assets/css/custom.css" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --mm-shadow-1: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }
    </style>
</head>

<body>
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode =
                    document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ?
                    "dark" :
                    "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <style>
        .mnav {
            width: 100%;
            height: 6rem;
            padding: 1rem 1rem 0rem 1rem;
        }

        .mnav .mnav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 1rem;
            box-shadow: var(--mm-shadow-1);
            border-radius: 1.5rem;
        }

        .mnav-bar .mnav-logo,
        .mnav-bar .mnav-tool {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .mnav-bar .mnav-logo {
            align-items: start;
        }

        .mnav-bar .mnav-tool {
            align-items: end;
        }
    </style>

    <style>
        .sidebar {
            width: 300px;
            height: 100%;
            padding: 1rem;
        }

        .sidebar .sidebar-body {
            background-color: white;
            height: 100%;
            box-shadow: var(--mm-shadow-1);
            border-radius: 1.5rem;
        }

        .sidebar-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-profile,
        .sidebar-footer {
            height: 60px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .sidebar-profile {
            border-radius: 1.5rem 1.5rem 0 0;
            border-bottom: 1px solid var(--bs-secondary);
        }

        .sidebar-footer {
            border-radius: 0 0 1.5rem 1.5rem;
            border-top: 1px solid var(--bs-secondary);
        }

        .sidebar-menus {
            height: calc(100% - 120px);
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: start;
            padding: 1rem;
        }

        .menu-item {
            width: 100%;
            padding: 0.5rem 0;
            display: flex;
            flex-direction: row;
            gap: 0.3rem;
            justify-content: space-between;
        }

        .menu-title {
            width: 100%;
            color: var(--bs-text-muted) !important;
        }

        .menu-toolbar {
            width: fit-content;
            display: flex;
            flex-direction: row;
            align-items: end;
            justify-content: center;
            gap: 0.5rem;
        }

        .menu-toolbar a {
            width: 20px;
            height: 20px;
            justify-content: center;
            align-items: center;
        }

        .menu-toolbar:hover a {
            display: flex;
        }

        .menu-toolbar a {
            display: none;
        }

        .menu-item:hover .menu-toolbar a {
            display: flex;
        }
    </style>

    <div class="d-flex flex-column h-100">
        <div class="mnav">
            <div class="mnav-bar">
                <div class="mnav-logo">
                    <img alt="Logo" src="./assets/logo/logo_workspace.svg" class="h-25px">
                </div>
                <div class="mnav-tool">
                    <a href="#" class="btn btn-sm btn-icon btn-dark"><i class="fas fa-envelope-open-text"></i></a>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row h-100">
            <div class="sidebar">

                <div class="sidebar-body">
                    <div class="sidebar-profile">
                        <div class="w-100 d-flex flex-row align-items-center gap-3">
                            <div class="symbol symbol-40px">
                                <div class="symbol-label fs-2 fw-semibold text-success">N</div>
                            </div>
                            <div>
                                <span class="fs-5 fw-bold">Name of User</span>
                                <span class="badge badge-sm badge-secondary">admin@ycap.go.th</span>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menus">
                        <div class="menu-item">
                            <div class="menu-title fw-bold">Teamspace</div>
                            <div class="menu-toolbar">
                                <a href=""><i class="fa-solid fa-ellipsis fs-4"></i></a>
                                <a href=""><i class="fa-regular fa-square-plus fs-4"></i></a>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="" href="">
                                <span class="menu-title">Autosize</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <span class="text-muted mb-0 fs-7 fw-bold">Private</span>
                        </div>
                    </div>
                    <div class="sidebar-footer">
                        <span class="text-gray-600 text-center">Create by YUWA-IT</span>
                    </div>
                </div>

            </div>
        </div>
    </div>





</body>

</html>
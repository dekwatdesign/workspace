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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

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

            align-items: center;
            gap: 1rem;
        }

        .mnav-bar .mnav-logo {
            justify-content: start;
        }

        .mnav-bar .mnav-tool {
            justify-content: end;
        }
    </style>

    <style>
        .sidebar {
            bottom: 0;
            width: 100%;
            max-width: 350px;
            height: calc(100% - 6rem);
            padding: 1rem;
            position: fixed;
            z-index: 2;
        }

        .sidebar:not(.active) {
            left: -100%;
            transition: all 0.5s ease-out;
        }

        .sidebar.active {
            left: 0;
            transition: all 0.2s ease-out;
        }

        @media (min-width: 992px) {
            .sidebar {
                width: 350px;
                min-width: 350px;
                position: relative;
                height: 100%;
            }

            .sidebar:not(.active),
            .sidebar.active {
                left: 0;
            }

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
            gap: 0.5rem;
        }

        /* .menu-item {
            width: 100%;
            padding: 0.5rem;
            display: flex;
            flex-direction: row;
            gap: 0.3rem;
            justify-content: space-between;
            border-radius: 0.5rem;
            cursor: pointer;
        } */

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

        /* .menu-item:hover {
            background: var(--bs-gray-300);
        }

        .menu-item:hover .menu-toolbar a {
            display: flex;
        } */
    </style>

    <style>
        .content {
            width: 100%;
            height: 100%;
            padding: 1rem;
        }

        .content .content-body {
            background-color: white;
            height: 100%;
            box-shadow: var(--mm-shadow-1);
            border-radius: 1.5rem;
        }

        .content-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .btn-group-ssm>.btn.btn-icon,
        .btn.btn-icon.btn-ssm {
            height: calc(1em + 1rem + 2px);
            width: calc(1em + 1rem + 2px);
        }
    </style>

    <style>
        @media (min-width: 576px) {}

        @media (min-width: 768px) {}

        @media (min-width: 992px) {}

        @media (min-width: 1200px) {}

        @media (min-width: 1400px) {}
    </style>

    <div class="d-flex flex-column h-100">
        <div class="mnav" id="kt_header">
            <div class="mnav-bar">
                <div class="mnav-logo">
                    <button onclick="toggleMenu()" class="btn btn-sm btn-icon btn-light-primary d-block d-lg-none">
                        <i class="fa-solid fa-bars-sort fs-2"></i>
                    </button>
                    <img alt="Logo" src="./assets/logo/logo_workspace.svg" class="h-25px">
                </div>
                <div class="mnav-tool">
                    <a href="#" class="btn btn-sm btn-icon btn-secondary position-relative">
                        <i class="fa-solid fa-bell fa-shake fs-2"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge badge-sm badge-circle badge-danger">5</span>
                    </a>
                    <a href="#" class="btn btn-sm btn-icon btn-secondary">
                        <i class="fa-solid fa-gear fs-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row h-100">
            <div class="sidebar">

                <div class="sidebar-body">
                    <div class="sidebar-profile" id="kt_example_js_header">
                        <div class="w-100 d-flex flex-row justify-content-between align-items-center gap-3">
                            <div class="d-flex flex-row gap-2">
                                <div class="symbol symbol-40px">
                                    <div class="symbol-label fs-2 fw-semibold text-success">N</div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-5 fw-bold">Name of User</span>
                                    <span class="badge badge-sm badge-secondary">admin@ycap.go.th</span>
                                </div>
                            </div>
                            <div>
                                <button onclick="toggleMenu()" class="btn btn-sm btn-icon btn-light-danger d-block d-lg-none">
                                    <i class="fa-solid fa-xmark fs-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menus hover-scroll-y"
                        data-kt-scroll="true"
                        data-kt-scroll-height="auto"
                        data-kt-scroll-wrappers="#kt_example_js_content"
                        data-kt-scroll-dependencies="#kt_example_js_header, #kt_example_js_footer, #kt_header"
                        data-kt-scroll-offset="0px">

                        <div id="kt_example_js_content" class="menu menu-rounded menu-column menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 menu-arrow-gray-500 menu-state-bg fw-semibold" data-kt-menu="true">
                            <div class="menu-item menu-sub-indention menu-accordion" data-kt-menu-trigger="click">
                                <a href="#" class="menu-link py-3">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-briefcase fs-3"></i>
                                    </span>
                                    <span class="menu-title">Teamspace</span>
                                    <span>
                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                            <i class="fa-regular fa-ellipsis fs-3"></i>
                                        </button>
                                    </span>
                                    <span>
                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                            <i class="fa-solid fa-plus fs-3"></i>
                                        </button>
                                    </span>
                                    <span class="menu-arrow"></span>
                                </a>

                                <div class="menu-sub menu-sub-accordion pt-3">

                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">

                                        <a href="#" class="menu-link py-3">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Yuwa - IT</span>
                                            <span>
                                                <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                    <i class="fa-regular fa-ellipsis fs-3"></i>
                                                </button>
                                            </span>
                                            <span>
                                                <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                    <i class="fa-solid fa-plus fs-3"></i>
                                                </button>
                                            </span>
                                            <span class="menu-arrow"></span>
                                        </a>

                                        <div class="menu-sub menu-sub-accordion pt-3">

                                            <div class="menu-item">
                                                <a href="#" class="menu-link py-3">
                                                    <span class="menu-bullet fs-2">🚩</span>
                                                    <span class="menu-title">Ticket Cases</span>
                                                    <span>
                                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                            <i class="fa-regular fa-ellipsis fs-3"></i>
                                                        </button>
                                                    </span>
                                                </a>
                                            </div>

                                            <div class="menu-item">
                                                <a href="#" class="menu-link py-3">
                                                    <span class="menu-bullet fs-2">🤝</span>
                                                    <span class="menu-title">ประชุม/อบรม (IT เข้าร่วม)</span>
                                                    <span>
                                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                            <i class="fa-regular fa-ellipsis fs-3"></i>
                                                        </button>
                                                    </span>
                                                </a>
                                            </div>

                                            <div class="menu-item">
                                                <a href="#" class="menu-link py-3">
                                                    <span class="menu-bullet fs-2">🚀</span>
                                                    <span class="menu-title">Projects</span>
                                                    <span>
                                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                            <i class="fa-regular fa-ellipsis fs-3"></i>
                                                        </button>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a href="#" class="menu-link py-3">
                                                    <span class="menu-bullet fs-2">👮</span>
                                                    <span class="menu-title">เจ้าหน้าที่</span>
                                                    <span>
                                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                            <i class="fa-regular fa-ellipsis fs-3"></i>
                                                        </button>
                                                    </span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
                                        <a href="#" class="menu-link py-3">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Dekwatdesign</span>
                                            <span>
                                                <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                    <i class="fa-regular fa-ellipsis fs-3"></i>
                                                </button>
                                            </span>
                                            <span>
                                                <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                                    <i class="fa-solid fa-plus fs-3"></i>
                                                </button>
                                            </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="menu-sub menu-sub-accordion pt-3">
                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <a href="#" class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Example Link</span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <a href="#" class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Example Link</span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <a href="#" class="menu-link py-3">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Example Link</span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="menu-item menu-link-indention menu-accordion" data-kt-menu-trigger="click">
                                <!--begin::Menu link-->
                                <a href="#" class="menu-link py-3">
                                    <span class="menu-icon">
                                        <i class="fas fa-lock fs-3"></i>
                                    </span>
                                    <span class="menu-title">Private</span>
                                    <span>
                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                            <i class="fa-regular fa-ellipsis fs-3"></i>
                                        </button>
                                    </span>
                                    <span>
                                        <button class="btn btn-ssm btn-icon btn-secondary me-2">
                                            <i class="fa-solid fa-plus fs-3"></i>
                                        </button>
                                    </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu link-->

                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-accordion pt-3">
                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <a href="#" class="menu-link py-3 active">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Example Link</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <a href="#" class="menu-link py-3">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Example Link</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <a href="#" class="menu-link py-3">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Example Link</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>

                        </div>
                    </div>
                    <div class="sidebar-footer" id="kt_example_js_footer">
                        <span class="text-gray-600 text-center">Create by YUWA-IT</span>
                    </div>
                </div>

            </div>
            <div class="content">
                <div class="content-body">
                    <div id="table-container"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/scripts.bundle.js"></script>

    

    <script>
        $(document).ready(function() {
            $(".menu-link").accordion({
                active: false
            });

            const data = [{
                    firstName: 'John',
                    lastName: 'Doe',
                    age: 28
                },
                {
                    firstName: 'Jane',
                    lastName: 'Smith',
                    age: 34
                },
                {
                    firstName: 'Sara',
                    lastName: 'Brown',
                    age: 22
                }
            ];

            // กำหนด columns สำหรับ TanStack Table
            const columns = [{
                    accessorKey: 'firstName',
                    header: 'First Name',
                },
                {
                    accessorKey: 'lastName',
                    header: 'Last Name',
                },
                {
                    accessorKey: 'age',
                    header: 'Age',
                }
            ];
            // สร้างตารางโดยใช้ TanStack Table
            const table = new window["@tanstack/table-core"].Table({
                data,
                columns,
                getCoreRowModel: window["@tanstack/table-core"].getCoreRowModel(),
            });

            // ฟังก์ชันในการสร้าง HTML สำหรับแสดงผลตาราง
            function renderTable() {
                let tableHtml = '<table><thead><tr>';

                // สร้างหัวตาราง
                table.getHeaderGroups().forEach(headerGroup => {
                    headerGroup.headers.forEach(header => {
                        tableHtml += `<th>${header.column.columnDef.header}</th>`;
                    });
                });

                tableHtml += '</tr></thead><tbody>';

                // สร้างแถวข้อมูล
                table.getRowModel().rows.forEach(row => {
                    tableHtml += '<tr>';
                    row.getVisibleCells().forEach(cell => {
                        tableHtml += `<td>${cell.getValue()}</td>`;
                    });
                    tableHtml += '</tr>';
                });

                tableHtml += '</tbody></table>';

                // นำตารางไปแสดงใน div ที่กำหนด
                $('#table-container').html(tableHtml);
            }

            // เรียกฟังก์ชันเพื่อแสดงผลตาราง
            renderTable();


        });

        $(".menu-item button").off().on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

        function toggleMenu() {
            $('.sidebar').hasClass('active') ? $('.sidebar').removeClass('active') : $('.sidebar').addClass('active');
        }
    </script>

</body>

</html>
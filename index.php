<?php
require './configs/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Switcher</title>

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
</head>

<body id="kt_body" class="header-extended header-fixed header-tablet-and-mobile-fixed">
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
    <div class="container mt-5">
        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="viewTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="list-tab" 5 data-bs-target="#list" type="button"
                    role="tab">List</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="board-tab" data-bs-toggle="tab" data-bs-target="#board" type="button"
                    role="tab">Board</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar" type="button"
                    role="tab">Calendar</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="gantt-tab" data-bs-toggle="tab" data-bs-target="#gantt" type="button"
                    role="tab">Gantt</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="viewContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel">
                <h3>List View</h3>
                <!-- List content goes here -->
            </div>
            <div class="tab-pane fade" id="board" role="tabpanel">
                <h3>Board View</h3>
                <!-- Board content goes here -->
            </div>
            <div class="tab-pane fade" id="calendar" role="tabpanel">
                <h3>Calendar View</h3>
                <!-- Calendar content goes here -->
            </div>
            <div class="tab-pane fade" id="gantt" role="tabpanel">
                <h3>Gantt View</h3>
                <!-- Gantt content goes here -->
            </div>
        </div>
    </div>

</body>

</html>
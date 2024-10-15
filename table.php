<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple View Tabs</title>

    <link rel="apple-touch-icon" sizes="180x180" href="./assets/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/logo/favicon-16x16.png">
    <link rel="manifest" href="./assets/logo/site.webmanifest">

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link rel="stylesheet" type="text/css" href="./assets/plugins/global/plugins.bundle.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/style.bundle.css" />
    <script src="./assets/plugins/global/plugins.bundle.js"></script>
    <script src="./assets/js/scripts.bundle.js"></script>

    <!-- jquery -->
    <script src="./assets/js/jquery-3.7.1.min.js"></script>

    <!-- ag-grid -->
    <link rel="stylesheet" type="text/css" href="./node_modules/ag-grid-community/styles/ag-grid.min.css">
    <link rel="stylesheet" type="text/css" href="./node_modules/ag-grid-community/styles/ag-theme-alpine.min.css">
    <script src="./node_modules/ag-grid-community/dist/ag-grid-community.min.js"></script>

    <!-- jkanban -->
    <link rel="stylesheet" type="text/css" href="./assets/plugins/custom/jkanban/jkanban.bundle.css" />
    <script src="./assets/plugins/custom/jkanban/jkanban.bundle.js"></script>

    <!-- fullcalendar -->
    <link rel="stylesheet" type="text/css" href="./assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" />
    <script src="./assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>

    <!-- Modified -->
    <link rel="stylesheet" type="text/css" href="./assets/css/fontawesome.min.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/custom.css?version=4" />

    <style>
        .view-container {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <h1>ทดสอบ Multiple View</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="table-tab" data-bs-toggle="tab" data-bs-target="#table-view" type="button" role="tab">Table View</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kanban-tab" data-bs-toggle="tab" data-bs-target="#kanban-view" type="button" role="tab">Kanban View</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar-view" type="button" role="tab">Calendar View</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Table View -->
            <div class="tab-pane fade show active view-container" id="table-view" role="tabpanel">
                <div class="test-container">
                    <div class="test-header">
                        <div class="example-section">
                            <button onclick="saveState()">Save State</button>
                            <button onclick="restoreState()">Restore State</button>
                            <button onclick="resetState()">Reset State</button>
                        </div>
                    </div>
                    <div class="ag-theme-alpine" style="height: 400px;">
                        <!-- Your Data Grid container -->
                        <div id="myGrid" class="ag-theme-quartz" style="height: 500px"></div>
                    </div>
                </div>
            </div>
            <!-- Kanban View -->
            <div class="tab-pane fade view-container" id="kanban-view" role="tabpanel">
                <div id="myKanban"></div>
            </div>
            <!-- Calendar View -->
            <div class="tab-pane fade view-container" id="calendar-view" role="tabpanel">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <script>
        const columnDefs = [{
                field: "athlete"
            },
            {
                field: "age"
            },
            {
                field: "country"
            },
            {
                field: "sport"
            },
            {
                field: "year"
            },
            {
                field: "date"
            },
            {
                field: "gold"
            },
            {
                field: "silver"
            },
            {
                field: "bronze"
            },
            {
                field: "total"
            },
        ];

        let gridApi;

        const gridOptions = {
            pagination: true,
            paginationPageSize: 10,
            paginationPageSizeSelector: [10, 50, 100, 200],
            defaultColDef: {
                width: 100,
                enableRowGroup: true,
                enablePivot: true,
                enableValue: true,
            },
            autoGroupColumnDef: {
                minWidth: 200,
            },
            sideBar: {
                toolPanels: ["columns"],
            },
            rowGroupPanelShow: "always",
            pivotPanelShow: "always",
            // debug: true,
            columnDefs: columnDefs,
            rowData: null,
        };

        function saveState() {
            window.colState = gridApi.getColumnState();
            console.log("column state saved");
        }

        function restoreState() {
            if (!window.colState) {
                console.log("no columns state to restore by, you must save state first");
                return;
            }
            gridApi.applyColumnState({
                state: window.colState,
                applyOrder: true,
            });
            console.log("column state restored");
        }

        function resetState() {
            gridApi.resetColumnState();
            console.log("column state reset");
        }

        // setup the grid after the page has finished loading
        document.addEventListener("DOMContentLoaded", () => {
            const gridDiv = document.querySelector("#myGrid");
            gridApi = agGrid.createGrid(gridDiv, gridOptions);

            fetch("https://www.ag-grid.com/example-assets/olympic-winners.json")
                .then((response) => response.json())
                .then((data) => gridApi.setGridOption("rowData", data));
        });
    </script>

</body>

</html>
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

    <!-- tabulator-tables -->
    <link rel="stylesheet" href="./node_modules/tabulator-tables/dist/css/tabulator.min.css">
    <script src="./node_modules/tabulator-tables/dist/js/tabulator.min.js"></script>

    <!-- luxon -->
    <script src="./node_modules/luxon/build/global/luxon.min.js"></script>

    <!-- jquery -->
    <script src="./assets/js/jquery-3.7.1.min.js"></script>

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
        #example-table {
            width: 100%;
            margin: 20px 0;
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



                <div id="example-table"></div>

                <button id="add-row" class="btn btn-primary mt-3">Add Row</button>

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
        document.addEventListener("DOMContentLoaded", function() {
            var table = new Tabulator("#example-table", {
                height: "311px",
                movableColumns: true, // สามารถย้ายคอลัมน์
                layout: "fitColumns", // ปรับความกว้างของคอลัมน์ให้อัตโนมัติ
                columns: [{
                        title: "ID",
                        field: "id",
                        width: 50
                    },
                    {
                        title: "Name",
                        field: "name",
                        editor: "input"
                    }, // แก้ไขชื่อในคอลัมน์
                    {
                        title: "Gender",
                        field: "gender",
                        editor: "select", // ใช้ select ในการแก้ไข
                        editorParams: {
                            values: {
                                "male": "Male",
                                "female": "Female"
                            }
                        }
                    },
                    {
                        title: "Birthdate",
                        field: "birthdate",
                        formatter: "datetime", // ใช้ formatter ในการแสดงวันที่
                        formatterParams: {
                            outputFormat: "MM/dd/yyyy",
                            invalidPlaceholder: "Invalid Date",
                        },
                        editor: "input" // แก้ไขข้อมูลด้วย input
                    },
                    {
                        title: "Salary",
                        field: "salary",
                        formatter: "money", // จัดการฟอร์แมตตัวเลขให้เป็นเงิน
                        editor: "input"
                    }
                ]
            });

            // โหลดข้อมูลจากฐานข้อมูลผ่าน AJAX
            table.setData("data.php");

            fetch("data.php")
            .then(response => response.json())
            .then(data => {
                console.log(data); // ตรวจสอบข้อมูล JSON ที่ได้
                table.setData(data); // ตั้งค่าข้อมูลให้กับ Tabulator
            })
            .catch(error => console.error("Error fetching data:", error));
        });

        
    </script>
</body>

</html>
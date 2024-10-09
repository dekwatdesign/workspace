<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon and Emoji Selector Popup</title>
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="./assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="./assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!-- Modified -->
    <link href="./assets/css/fontawesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./assets/css/fonts.css" rel="stylesheet" type="text/css" />
    <link href="./assets/css/custom.css" rel="stylesheet" type="text/css" />
    <style>
        .modal-dialog {
            max-width: 800px;
        }

        .icon-grid,
        .emoji-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .icon-select,
        .icon-select i,
        .emoji-item {
            font-size: 2rem;
            cursor: pointer;
        }

        .emoji-search {
            margin-top: 15px;
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

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#iconSelectorModal">
        Select Icon or Emoji
    </button>

    <!-- Modal -->
    <div class="modal fade" id="iconSelectorModal" tabindex="-1" aria-labelledby="iconSelectorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iconSelectorModalLabel">Select Icon or Emoji</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="iconTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="fontawesome-tab" data-bs-toggle="tab" href="#fontawesome" role="tab" aria-controls="fontawesome" aria-selected="true">FontAwesome</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="emoji-tab" data-bs-toggle="tab" href="#emoji" role="tab" aria-controls="emoji" aria-selected="false">Emoji</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="uploads-tab" data-bs-toggle="tab" href="#uploads" role="tab" aria-controls="uploads" aria-selected="false">Uploads</a>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="iconTabContent">
                        <!-- FontAwesome Tab -->
                        <div class="tab-pane fade show active" id="fontawesome" role="tabpanel" aria-labelledby="fontawesome-tab">
                            <div class="emoji-search">
                                <input type="text" id="iconSearch" class="form-control" placeholder="Search Icon">
                            </div>
                            <div class="icon-grid mt-3" id="fontawesomeIcons">
                                <!-- FontAwesome icons will be loaded here dynamically -->
                            </div>
                        </div>

                        <!-- Emoji Tab -->
                        <div class="tab-pane fade" id="emoji" role="tabpanel" aria-labelledby="emoji-tab">
                            <div class="emoji-search">
                                <input type="text" id="emojiSearch" class="form-control" placeholder="Search Emoji">
                            </div>
                            <div class="emoji-grid" id="emojiList">
                                <!-- Emoji list will be loaded here dynamically -->
                            </div>
                        </div>

                        <!-- Uploads Tab -->
                        <div class="tab-pane fade" id="uploads" role="tabpanel" aria-labelledby="uploads-tab">
                            <form id="uploadForm" enctype="multipart/form-data" method="POST">
                                <div class="mb-3 mt-3">
                                    <label for="iconUpload" class="form-label">Upload Your Icon</label>
                                    <input class="form-control" type="file" id="iconUpload" name="iconUpload">
                                </div>
                                <button type="button" class="btn btn-primary" id="uploadIconBtn">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>

    <script>
        // Load FontAwesome icons from the provided JSON file
        function loadFontAwesomeIcons(searchTerm = '') {

            const iconPrefix = "fa-";
            const styleMap = {
                brands: "fab",
                regular: "far",
                solid: "fas"
            };

            $.getJSON('./data/fontawesome.json', function(data) {
                let html = '';
                for (let [iconName, iconData] of Object.entries(data)) {
                    for (let iconStyle of Object.values(iconData.styles)) {
                        if (iconData.label.toLowerCase().includes(searchTerm.toLowerCase())) {
                            html += `<span class="icon-select"><i class="${styleMap[iconStyle]} ${iconPrefix}${iconName}"></i></span>`;
                        }
                    }
                };
                $('#fontawesomeIcons').html(html);
                bindIconClick();
            }).fail(function() {
                alert('Failed to load FontAwesome icons.');
            });


        }

        // Load emojis from the provided JSON file
        function loadEmojiList(searchTerm = '') {
            $.getJSON('./data/emojibase.json', function(data) {
                let html = '';
                data.forEach(function(emoji) {
                    if (emoji.name.toLowerCase().includes(searchTerm.toLowerCase())) {
                        html += `<span class="emoji-item">${emoji.htmlCode[0]}</span>`;
                    }
                });
                $('#emojiList').html(html);
                bindEmojiClick();
            }).fail(function() {
                alert('Failed to load emoji data.');
            });
        }


        // Bind icon click event
        function bindIconClick() {
            $('.icon-select').on('click', function() {
                let selectedIcon = $(this).html(); // Get the inner HTML of the selected icon (SVG)
                navigator.clipboard.writeText(selectedIcon);
                alert('Selected Icon: ' + selectedIcon);
            });
        }

        // Handle search functionality for FontAwesome icons
        $('#iconSearch').on('input', function() {
            const searchTerm = $(this).val();
            loadFontAwesomeIcons(searchTerm);
        });

        // Bind emoji click event
        function bindEmojiClick() {
            $('.emoji-item').on('click', function() {
                let selectedEmoji = $(this).html();
                navigator.clipboard.writeText(selectedEmoji);
                alert('Selected Emoji: ' + selectedEmoji);
            });
        }

        // Handle emoji search
        $('#emojiSearch').on('input', function() {
            const searchTerm = $(this).val();
            loadEmojiList(searchTerm);
        });

        // Load FontAwesome icons and emojis when the modal is opened
        $('#iconSelectorModal').on('show.bs.modal', function() {
            loadFontAwesomeIcons();
            loadEmojiList();
        });

        // Handle file upload
        $('#uploadIconBtn').on('click', function() {
            let formData = new FormData($('#uploadForm')[0]);
            $.ajax({
                url: 'upload_icon.php', // PHP file for handling uploads
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('Icon uploaded successfully!');
                },
                error: function() {
                    alert('Failed to upload icon.');
                }
            });
        });
    </script>

</body>

</html>
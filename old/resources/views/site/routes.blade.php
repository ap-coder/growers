<!DOCTYPE html>
<html>
<head>
    <title>Routes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        body {padding-top: 30px; }
        .explanation {margin-bottom: 20px; }
        .panel-heading {cursor: pointer; }
        .search-input {margin-bottom: 20px; }
    </style>
    <script>
        $(document).ready(function() {
            function searchRoutes() {
                var searchTerm = $(".search-input").val().toLowerCase();
                var panelFound = false;

                // Iterate over each panel (section)
                $(".panel").each(function() {
                    var panel = $(this);
                    var hasVisibleRow = false;

                    // Iterate over each row in the current panel's table
                    panel.find(".routes-table tbody tr").each(function() {
                        var row = $(this);
                        if (row.text().toLowerCase().indexOf(searchTerm) > -1) {
                            row.show();
                            hasVisibleRow = true;
                        } else {
                            row.hide();
                        }
                    });

                    // If any row is visible in this panel, open the panel
                    if (hasVisibleRow) {
                        panel.find(".panel-collapse").collapse('show');
                        panelFound = true;
                    } else {
                        panel.find(".panel-collapse").collapse('hide');
                    }
                });

                // Check if search returned any results at all
                if (!panelFound) {
                    // Optionally display a message if no results are found
                    console.log('No matching routes found.');
                }
            }

            // Trigger search on keyup and on pressing Enter
            $(".search-input").on("keyup", function(event) {
                searchRoutes();
            });

            $(".search-input").on("keypress", function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault(); // Prevent form submission on Enter
                    searchRoutes();
                }
            });
        });
    </script>
</head>
<body>
<div class='container-fluid'>
    <div class="explanation">
        <p>Click on each section below to expand and view the routes. Sections are categorized into Development, API, Admin, and Non-Admin routes.</p>
    </div>

    <!-- Search input for filtering table -->
    <div class="row">
        <div class="col-md-12">
            <input type="text" class="form-control search-input" placeholder="Search routes...">
        </div>
    </div>

    @php
        $sections = [
            'Site Navigation' => [],
            'Admin' => ['admin'],
            'API' => ['api/'],
            'Development' => ['_debugbar', 'log-viewer', 'sanctum', '_ignition', 'wecodelaravel', 'horizon', 'telescope', 'userVerificatio'],
        ];
    @endphp

    <div class="col-12">
        @foreach ($sections as $section => $prefixes)
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-target="#collapse{{ $loop->index }}">
                    <h4 class="panel-title">
                        <a href="#collapse{{ $loop->index }}" class="collapsed" data-toggle="collapse">{{ $section }} Routes</a>
                    </h4>
                </div>
                <div id="collapse{{ $loop->index }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        @include('site.layouts.partials.routes_table', ['routes' => Route::getRoutes(), 'prefixes' => $prefixes, 'section' => strtolower($section)])
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>

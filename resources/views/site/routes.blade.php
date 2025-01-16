<!DOCTYPE html>
<html>
<head>
    <title>Routes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        body {
            padding-top: 30px;
        }
        .explanation {
            margin-bottom: 20px;
        }
        .panel-heading {
            cursor: pointer;
        }
        .search-input {
            margin-bottom: 20px;
        }
        #no-results-message {
            color: red;
            margin-top: 10px;
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            function searchRoutes() {
                var searchTerm = $(".search-input").val().toLowerCase();
                var panelFound = false; // Tracks if any panel contains a match

                // Iterate over each panel (section)
                $(".panel").each(function () {
                    var panel = $(this);
                    var hasVisibleRow = false; // Tracks if this panel has matching rows

                    // Check each row within this panel's table
                    panel.find(".routes-table tbody tr").each(function () {
                        var row = $(this);
                        if (row.text().toLowerCase().includes(searchTerm)) {
                            row.show(); // Show matching row
                            hasVisibleRow = true;
                        } else {
                            row.hide(); // Hide non-matching row
                        }
                    });

                    // Expand or collapse the panel based on whether it has visible rows
                    if (hasVisibleRow) {
                        panel.find(".panel-collapse").collapse('show'); // Expand the panel
                        panelFound = true;
                    } else {
                        panel.find(".panel-collapse").collapse('hide'); // Collapse the panel
                    }
                });

                // Show or hide the "No matching routes found" message
                if (!panelFound) {
                    $("#no-results-message").show();
                } else {
                    $("#no-results-message").hide();
                }
            }

            // Trigger search on input
            $(".search-input").on("input", function () {
                searchRoutes();
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="explanation">
        <p>Click on each section below to expand and view the routes. Sections are categorized into Development, API, Admin, and Non-Admin routes.</p>
    </div>

    <!-- Search input for filtering table -->
    <div class="row">
        <div class="col-md-12">
            <input type="text" class="form-control search-input" placeholder="Search routes...">
            <div id="no-results-message">No matching routes found.</div>
        </div>
    </div>

    @php
        $sections = [
            'Site Navigation' => [],
            'Account' => ['account'],
            'Admin' => ['admin'],
            'API' => ['api/'],
            'Logs' => ['log-viewer'],
            'Telescope' => ['telescope'],
            'Development' => ['_debugbar', 'sanctum', '_ignition', 'wecodelaravel', 'horizon', 'telescope', 'userVerification'],
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
                        <table class="routes-table table table-striped">
                            <thead>
                                <tr>
                                    <th>Method</th>
                                    <th>URI</th>
                                    <th>Name</th>
                                    <th>Controller</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Route::getRoutes() as $route)
                                    @if (empty($prefixes) || collect($prefixes)->some(fn($prefix) => str_contains($route->uri, $prefix)))
                                        <tr>
                                            <td>{{ implode('|', $route->methods) }}</td>
                                            <td>
                                                <a href="{{ url($route->uri) }}" target="_blank">
                                                    {{ $route->uri }}
                                                </a>
                                            </td>
                                            <td>{{ $route->getName() }}</td>
                                            <td>{{ $route->getActionName() }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>

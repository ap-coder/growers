<!DOCTYPE html>
<html>
<head>
    <title>Routes - AssetDash</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap3/bootstrap.min.css') }}">
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <style>
        body { padding-top: 30px; }
        .explanation { margin-bottom: 20px; }
        .panel-heading { cursor: pointer; background: #f5f5f5; padding: 10px 15px; border-bottom: 1px solid #ddd; }
        .panel-heading:hover { background: #e8e8e8; }
        .search-input { margin-bottom: 20px; }
        .match-count { font-size: 12px; color: #666; margin-left: 10px; }
        .panel-body { display: none; padding: 15px; }
        .panel { border: 1px solid #ddd; margin-bottom: 10px; border-radius: 4px; }
        .panel-title { margin: 0; font-size: 16px; font-weight: bold; }
        .chevron { display: inline-block; width: 0; height: 0; margin-right: 8px; border-top: 5px solid transparent; border-bottom: 5px solid transparent; border-left: 8px solid #333; transition: transform 0.2s; }
        .chevron.open { transform: rotate(90deg); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="explanation">
        <p>AssetDash application routes. Click a section to expand, or type to filter.</p>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="text" class="form-control search-input" placeholder="Type to filter routes..." autofocus>
        </div>
    </div>

    @php
        $hiddenPrefixes = [
            '_debugbar', '_ignition', 'sanctum', 'wecodelaravel', 
            'userVerificatio', 'livewire', 'broadcasting'
        ];
        
        // Dev tool prefixes - checked first to exclude from Admin
        $devPrefixes = ['horizon', 'telescope', 'log-viewer', 'admin/logs', 'logs', 'routes'];
        
        $allRoutes = collect(Route::getRoutes())->filter(function ($route) use ($hiddenPrefixes) {
            foreach ($hiddenPrefixes as $prefix) {
                if (strpos($route->uri, $prefix) === 0) {
                    return false;
                }
            }
            return true;
        });
        
        // Shop/Site prefixes (public pages)
        $shopPrefixes = ['shop', 'cart', 'checkout', 'faq', 'contact', 'about', 'how-to-order', 'products', 'home'];
        
        // Account prefixes (logged-in customer area)
        $accountPrefixes = ['account'];
        
        // Filter routes for each section
        $shopRoutes = $allRoutes->filter(function ($route) use ($shopPrefixes) {
            $uri = $route->uri;
            foreach ($shopPrefixes as $prefix) {
                if (strpos($uri, $prefix) === 0) {
                    return true;
                }
            }
            return false;
        });
        
        $accountRoutes = $allRoutes->filter(function ($route) use ($accountPrefixes) {
            $uri = $route->uri;
            foreach ($accountPrefixes as $prefix) {
                if (strpos($uri, $prefix) === 0) {
                    return true;
                }
            }
            return false;
        });
        
        $adminRoutes = $allRoutes->filter(function ($route) use ($devPrefixes, $shopPrefixes, $accountPrefixes) {
            $uri = $route->uri;
            // Exclude dev prefixes
            foreach ($devPrefixes as $prefix) {
                if (strpos($uri, $prefix) === 0) {
                    return false;
                }
            }
            // Exclude shop prefixes
            foreach ($shopPrefixes as $prefix) {
                if (strpos($uri, $prefix) === 0) {
                    return false;
                }
            }
            // Exclude account prefixes
            foreach ($accountPrefixes as $prefix) {
                if (strpos($uri, $prefix) === 0) {
                    return false;
                }
            }
            return strpos($uri, 'admin') === 0;
        });
        
        $apiRoutes = $allRoutes->filter(function ($route) {
            return strpos($route->uri, 'api/') === 0;
        });
        
        $devRoutes = $allRoutes->filter(function ($route) use ($devPrefixes) {
            $uri = $route->uri;
            foreach ($devPrefixes as $prefix) {
                if (strpos($uri, $prefix) === 0) {
                    return true;
                }
            }
            return false;
        });
        
        $sections = [
            'Shop & Public Pages' => $shopRoutes,
            'Account (Customer)' => $accountRoutes,
            'Admin' => $adminRoutes,
            'API' => $apiRoutes,
            'Development Tools' => $devRoutes,
        ];
    @endphp

    <div class="col-12">
        @foreach ($sections as $section => $routes)
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <span class="chevron"></span>
                        {{ $section }} Routes
                        <span class="match-count"></span>
                    </h4>
                </div>
                <div class="panel-body">
                    @include('partials.routes_table', ['routes' => $routes])
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
$(document).ready(function() {
    // Click to toggle panel
    $(".panel-heading").on("click", function() {
        var panel = $(this).closest(".panel");
        var body = panel.find(".panel-body");
        var chevron = $(this).find(".chevron");
        
        body.slideToggle(200);
        chevron.toggleClass("open");
    });

    // Search functionality
    var searchTimeout;
    
    function searchRoutes() {
        var searchTerm = $(".search-input").val().toLowerCase().trim();

        if (searchTerm === '') {
            $(".routes-table tbody tr").show();
            $(".panel-body").slideUp(200);
            $(".panel").show();
            $(".match-count").text('');
            $(".chevron").removeClass("open");
            return;
        }

        $(".panel").each(function() {
            var panel = $(this);
            var visibleCount = 0;

            panel.find(".routes-table tbody tr").each(function() {
                var row = $(this);
                if (row.text().toLowerCase().indexOf(searchTerm) > -1) {
                    row.show();
                    visibleCount++;
                } else {
                    row.hide();
                }
            });

            var countSpan = panel.find(".match-count");
            var chevron = panel.find(".chevron");
            if (visibleCount > 0) {
                countSpan.text('(' + visibleCount + ')');
                panel.find(".panel-body").slideDown(200);
                chevron.addClass("open");
                panel.show();
            } else {
                countSpan.text('');
                panel.find(".panel-body").slideUp(200);
                chevron.removeClass("open");
                panel.hide();
            }
        });
    }

    $(".search-input").on("input", function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(searchRoutes, 150);
    });

    $(".search-input").on("keypress", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            searchRoutes();
        }
    });
});
</script>
</body>
</html>

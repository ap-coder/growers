<table class='table table-striped' style='width:100%'>
    <!-- Table headers -->
    <tr>
        <td width='10%'><h4>HTTP Method</h4></td>
        <td width='30%'><h4>URL</h4></td>
        <td width='30%'><h4>Route</h4></td>
        <td width='30%'><h4>Corresponding Action</h4></td>
    </tr>
    @foreach($routes as $route)
        @php
            $displayRoute = false;
            if (!empty($prefixes)) {
                foreach ($prefixes as $prefix) {
                    if (\Illuminate\Support\Str::startsWith($route->uri(), $prefix)) {
                        $displayRoute = true;
                        break;
                    }
                }
            } else {
                // For 'Non-Admin' section, display routes not belonging to any other specified sections
                $displayRoute = true; // Assume display, then check
                foreach ($sections as $_section => $_prefixes) {
                    if ($_section === 'Non-Admin') continue;
                    foreach ($_prefixes as $_prefix) {
                        if (\Illuminate\Support\Str::startsWith($route->uri(), $_prefix)) {
                            $displayRoute = false;
                            break 2; // Break both loops
                        }
                    }
                }
            }
            if (!$displayRoute) continue;
        @endphp
        <tr>
            <td>{{ $route->methods()[0] }}</td>
            <td><a href="{{ url($route->uri()) }}" target='_blank'>{{ $route->uri() }}</a></td>
            <td>{{ $route->getName() }}</td>
            <td>{{ $route->getActionName() }}</td>
        </tr>
    @endforeach
</table>

<table class='table table-striped routes-table' style='width:100%'>
    <thead>
        <tr>
            <th width='10%'>Method</th>
            <th width='35%'>URL</th>
            <th width='25%'>Route Name</th>
            <th width='30%'>Controller Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($routes as $route)
        <tr>
            <td><span class="label label-{{ $route->methods()[0] === 'GET' ? 'primary' : ($route->methods()[0] === 'POST' ? 'success' : ($route->methods()[0] === 'DELETE' ? 'danger' : 'warning')) }}">{{ $route->methods()[0] }}</span></td>
            <td><a href="{{ url($route->uri()) }}" target='_blank'>{{ $route->uri() }}</a></td>
            <td><code>{{ $route->getName() ?: '-' }}</code></td>
            <td><small>{{ str_replace('App\\Http\\Controllers\\', '', $route->getActionName()) }}</small></td>
        </tr>
    @endforeach
    </tbody>
</table>

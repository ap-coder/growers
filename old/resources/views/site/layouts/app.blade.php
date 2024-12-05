<!DOCTYPE html>
<html lang="en">
	@include('site.layouts.partials.head')
    <body id="bg">

<div class="page-wraper" id="scroll-container">

<div id="loading-area" class="loading-page-1">
	<div class="text"><span class="text-primary">Plant</span>Zone</div>
</div>

    @include('site.layouts.partials.header')
    @yield('page-content')
    @include('site.layouts.partials.footer')
</div>
@include('site.layouts.partials.bscripts')
</body>
</html>

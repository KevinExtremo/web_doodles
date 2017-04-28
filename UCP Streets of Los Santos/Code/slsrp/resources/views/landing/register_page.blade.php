@extends('landing.main')

@section('content')

<!-- logo -->
<div class="row">
	<header>
		<div class="col-md-6 col-md-offset-3"><img src="../images/logo.png"/></div>
	</header>
</div>
<!-- login and register -->
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        @include('landing.register')
    </div>
</div>
<!-- footer credits -->
<div class="row">
	<footer>
	    <div class="col-md-4 col-md-offset-4"><p>Copyright 2017&copy; developed by Kevin 'Extremo' Sekin</p></div>
	</footer>
</div>

@endsection
<form id="login" method="POST" action="/">
	{{ csrf_field() }}
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- code for login and register -->
            <input type="text" class="form-control input-style" id="loginusername" placeholder="Username">
            <input type="password" class="form-control input-style" id="loginpassword" placeholder="Password">
            <input class="btn btn-default center-block button-style" id="loginsubmit" type="submit" value="Login">
            <p>Don't have an Account? <a href="/register">Click here to register</a>.</p>
        </div>
    </div>
</form>
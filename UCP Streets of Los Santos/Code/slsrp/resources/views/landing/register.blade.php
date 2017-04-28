<form id="register" method="POST" action="/">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- code for login and register -->
            <input type="text" class="form-control input-style" id="registerusername" placeholder="Username">
            <input type="email" class="form-control input-style" id="registeremail" placeholder="Email">
            <input type="email" class="form-control input-style" id="registeremailtwo" placeholder="Verify Email">
            <input type="password" class="form-control input-style" id="registerpassword" placeholder="Password">
            <input type="password" class="form-control input-style" id="registerpasswordtwo" placeholder="Verify Password">
            <input class="btn btn-default center-block button-style" id="registersubmit" type="submit" value="Register">
            <p>Already have an account? <a href="/login">Click here to login</a>.</p>
        </div>
    </div>
</form>
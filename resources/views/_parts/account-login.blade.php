<div class="row">
    <div class="col-sm-6">
        <h3>Log in</h3>
        <form method="post" action="{{ route('login') }}">
            {!! csrf_field() !!}
            <div class="mt10">
                <label for="email">Email:</label>
                <input type="email" name="email">
            </div>
            <div class="mt10">
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            <div class="mt10">
                <label>Remember:</label>
                <input type="checkbox" name="remember">
            </div>
            <button class="mt10 inline"><i class="fa fa-sign-in"></i> Login</button>
            <a href="{{ route('login.facebook') }}" class="facebook btn btn-primary btn-xs" title="Login with Facebook"><i class="fa fa-facebook-official"></i> Facebook</a>
            <hr/>
            <a href="" class="facebook" title="Reset password">Reset password</a>
        </form>
    </div>
    <div class="col-sm-6 left-border">
        <h3>Create account</h3>
        <form method="post" action="{{ route('register') }}">
            {!! csrf_field() !!}
            <div class="mt10">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ session('register.email') ?: '' }}" {{ !empty(session('register.email')) ? 'readonly':'' }}>
            </div>
            <div class="mt10">
                <label for="username">Username:</label>
                <input type="text" name="username">
            </div>
            <div class="mt10">
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            <div class="mt10">
                <label for="repeat-password">Repeat pw:</label>
                <input type="password" name="repeat-password">
            </div>
            <br>
            <button class=""><i class="fa fa-user-plus"></i> Create</button>
            <a href="{{ route('login.facebook') }}" class="facebook btn btn-primary btn-xs" title="Login with Facebook"><i class="fa fa-facebook-official"></i> Facebook</a>
            {!! Honeypot::generate('my_name', 'my_time') !!}
         </form>
    </div>
</div>
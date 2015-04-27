<div class="loginContainer">
    <form class="form-horizontal" action="/<?= _request_uri ?>/" id="loginForm" method="POST">
        <div class="form-row row">
            <div class="col-lg-12">
                <div class="row">
                    <label class="form-label col-lg-12" for="username">
                        Username:
                        <span class="icon16 icomoon-icon-user right gray marginR10"></span>
                    </label>
                    <input class="col-lg-12" id="username" type="text" name="data[username]" value="" />
                </div>
            </div>
        </div>

        <div class="form-row row">
            <div class="col-lg-12">
                <div class="row">
                    <label class="form-label col-lg-12" for="password">
                        Password:
                        <span class="icon16 icomoon-icon-lock right gray marginR10"></span>
                        <span class="forgot"><a href="#">Forgot your password?</a></span>
                    </label>
                    <input class="col-lg-12" id="password" type="password" name="data[password]" value="" />
                </div>
            </div>
        </div>
        <div class="form-row row">                       
            <div class="col-lg-12">
                <div class="row">
                    <div class="form-actions">
                    <div class="col-lg-12 controls">
                        <input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" /> Keep me logged in
                        <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Login</button>
                    </div>
                    </div>
                </div>
            </div> 
        </div>

    </form>
</div>
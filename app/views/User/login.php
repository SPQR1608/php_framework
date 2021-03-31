<h2>Log In</h2>
<div class="row">
    <div class="col-md-6">
        <form method="post" action="/user/login/">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Enter login"
                       value="<?=isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : ''?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data'])?>
    </div>
</div>
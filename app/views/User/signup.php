<h2>Sign up</h2>
<div class="row">
    <div class="col-md-6">
        <form method="post" action="/user/signup/">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Enter login"
                       value="<?=isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : ''?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="login">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                       value="<?=isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : ''?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email"
                       value="<?=isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ''?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data'])?>
    </div>
</div>
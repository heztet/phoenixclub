<div class="row">
    <div class="col-sm-10">
        <h2>Login</h2>
    </div>
</div>
<br />
<br />

<?php echo validation_errors('<p class="bg-danger fade-message" style="padding: 3px 3px 3px 3px;">'); ?>

<?php if($error): ?>
    <?php echo '<p class="bg-danger fade-message" style="padding: 3px 3px 3px 3px;">'.$error.'</p>';?>
<?php endif; ?>

<div class="row">
<?php echo form_open('auth/login', 'class="form-horizontal"'); ?>
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
           <input type="input" class="form-control" name="username" value="<?php echo set_value('username'); ?>" autofocus />
        </div> 
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
           <input type="password" class="form-control" name="password" value="" autofocus />
        </div> 
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </div>
</form>
</div>
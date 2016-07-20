<br>
<?php
if (isset($this->message))
    echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message . '</strong> Nie udało się zalogować. <br>
</div>'
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post" action="<?php echo URL; ?>adminLogin/login">
            <fieldset>
                <legend>Panel logowania administratora</legend>
                <div class="form-group">
                    <label for="login" class="control-label">Login</label>
                    <input class="form-control" id="login" name="login" type="text" required="required">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Hasło</label>
                    <input class="form-control" id="password" name="password" type="password" required="required">
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="login" name="submit">Zaloguj</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
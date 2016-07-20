<?php
require_once 'resources/menus/profileMenu.php';
if (isset($this->message))
    if($this->message=="Sukces")
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message. '</strong> Hasło zostało zmienione. <br></div>';
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
            <strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Zmień hasło</legend>
                <div class="form-group">
                    <label for="oldPassword" class="control-label">Stare hasło</label>
                    <input class="form-control" id="oldPassword" name="oldPassword" type="password">
                </div>
                <div class="form-group">
                    <label for="newPassword" class="control-label">Nowe hasło</label>
                    <input class="form-control" id="newPassword" name="newPassword" type="password">
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="control-label">Potwierdź hasło</label>
                    <input class="form-control" id="confirmPassword" name="confirmPassword" type="password">
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="changePassword" name="submit">Zatwierdź
                        </button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
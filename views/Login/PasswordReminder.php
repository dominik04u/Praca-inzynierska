<?php
require_once 'resources/menus/index.php';
if (isset($this->message))
    if ($this->message == "Sukces") {
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Został wysłany mail z linkiem resetującym. <br></div>';
        header('refresh:3; url='. URL . 'login');
    }
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Nie można wykonać operacji. <br>
</div>'
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Przypomnij hasło</legend>
                <div class="form-group">
                    <p class="text-info" align="center">Podaj swój login (nr indeksu), jeśli nie pamiętasz hasła.<br>
                        Nowe hasło zostanie wysłane na Twoje konto e-mail.</p>
                </div>
                <div class="form-group">
                    <label for="index" class="control-label">Indeks</label>
                    <input class="form-control" id="index" name="index" type="text" minlength="6" maxlength="6">
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" name="submit" value="remindPassword">Przypomnij
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
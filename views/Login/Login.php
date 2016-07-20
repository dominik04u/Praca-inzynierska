<?php
require_once 'resources/menus/index.php';
if (isset($this->message))
	echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message . '</strong> Nie udało się zalogować. <br>
</div>'
?>
<div class="col-lg-offset-4 col-lg-4">
	<div class="well bs-component">
		<form class="form-group" method="post" action="<?php echo URL; ?>login/login">
			<fieldset>
				<legend>Logowanie</legend>
				<div class="form-group">
					<label for="index" class="control-label">Indeks</label>
					<input class="form-control" id="index" name="index" type="text" required="required">
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
				<div class="form-group">
					<div class="control-label">
						<a href="<?php echo URL; ?>login/remindPassword" class="btn btn-warning">Resetuj hasło</a>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<div class="control-label">
					<p class="text-info">Jeżeli nie posiadasz jeszcze konta</p>
						<a href="<?php echo URL; ?>Register" class="btn btn-default">Rejestracja</a>
						</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
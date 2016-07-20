<?php
require_once 'resources/menus/loginMenu.php';
if (isset($this->message))
if($this->message=="Sukces")
echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message. '</strong> Poprawnie dodano adres <br></div>';
else
echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
	<div class="well bs-component">
		<form class="form-group" method="post">
			<fieldset>
				<legend>Adres</legend>
				<div class="form-group">
					<label for="place" class="control-label">Miejscowość</label>
					<input class="form-control" id="place" name="place" type="text" required="required">
				</div>
				<div class="form-group">
					<label for="street" class="control-label">Ulica</label>
					<input class="form-control" id="street" name="street" type="text">
				</div>
				<div class="form-group">
					<label for="houseNumber" class="control-label">Nr domu</label>
					<input class="form-control" id="houseNumber" name="houseNumber" type="text" required="required">
				</div>
				<div class="form-group">
					<label for="flatNumber" class="control-label">Nr mieszkania</label>
					<input class="form-control" id="flatNumber" name="flatNumber" type="text" >
				</div>
				<div class="form-group">
					<label for="zipCode" class="control-label">Kod pocztowy</label>
					<input class="form-control" id="zipCode" name="zipCode" type="text" required="required">
				</div>
				<div class="form-group">
					<label for="postOffice" class="control-label">Poczta</label>
					<input class="form-control" id="postOffice" name="postOffice" type="text" required="required">
				</div>
				<div class="form-group">
					<div class="control-label">
						<button type="submit" class="btn btn-primary" value="addAddress" name="submit">Zatwierdź</button>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
</div>
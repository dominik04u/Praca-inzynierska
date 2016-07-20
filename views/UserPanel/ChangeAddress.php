<?php
require_once 'resources/menus/profileMenu.php';
if (isset($this->message))
    if ($this->message == "Sukces")
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Dane adresowe zostały zmienione. <br></div>';
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Nie udało się zmienić danych adresowych. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Edytuj adres</legend>
                <?php foreach ($this->news as $row) {
                    echo '
				<div class="form-group">
					<label for="place" class="control-label">Miejscowość</label>
					<input class="form-control" id="place" name="place" type="text" required="required" value="' . $row['place'] . '">
				</div>
				<div class="form-group">
					<label for="street" class="control-label">Ulica</label>
					<input class="form-control" id="street" name="street" type="text" value="' . $row['street'] . '">
				</div>
				<div class="form-group">
					<label for="houseNumber" class="control-label">Nr domu</label>
					<input class="form-control" id="houseNumber" name="houseNumber" type="text" required="required" value="' . $row['house_number'] . '">
				</div>
				<div class="form-group">
					<label for="flatNumber" class="control-label">Nr mieszkania</label>
					<input class="form-control" id="flatNumber" name="flatNumber" type="text" value="' . $row['flat_number'] . '">
				</div>
				<div class="form-group">
					<label for="zipCode" class="control-label">Kod pocztowy</label>
					<input class="form-control" id="zipCode" name="zipCode" type="text" required="required" value="' . $row['zip_code'] . '">
				</div>
				<div class="form-group">
					<label for="postOffice" class="control-label">Poczta</label>
					<input class="form-control" id="postOffice" name="postOffice" type="text" required="required" value="' . $row['post_office'] . '">
				</div>
				<div class="form-group">
					<div class="control-label">
						<button type="submit" class="btn btn-primary" value="changeAddress" name="submit">Zatwierdź</button>
					</div>
				</div>
	';
                } ?>
            </fieldset>
        </form>
    </div>
</div>
<?php
require_once 'resources/menus/adminMenu.php';
if (isset($this->message))
    if ($this->message == "Sukces")
        echo '
<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Zmieniono status wniosku <br></div>';
    else
        echo '
<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br></div>';
if ($this->data == -1) {
    echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	Student o podanym indeksie nie istnieje<br></div>';
} elseif ($this->data > 0) {
    foreach ($this->data as $row) {
        $scholarship_amount = $row['scholarship'];
        if ($row['dorm_add'] == 1)
            $scholarship_amount += $row['dorm_add_amount'];
        echo '
<div class="col-lg-offset-4 col-lg-4">
	<div class="well bs-component">
		<form class="form-group" method="post">
			<fieldset>
				<legend>Wniosek</legend>
				<div class="form-group">
					<label class="control-label">Imię i nazwisko</label> ' . $row['name'] . ' ' . $row['surname'] . '
				</div>
				<div class="form-group">
					<label class="control-label">Nr indeksu</label> ' . $row['st_index'] . '
				</div>
				<div class="form-group">
					<label class="control-label">Data złożenia wniosku</label> ' . $row['app_date'] . '
				</div>
				<div class="form-group">
					<label class="control-label">Data przyjęcia wniosku</label> ' . $row['accept_date'] . '
				</div>
				<div class="form-group">
					<label class="control-label">Kwota stypendium</label> ' . $scholarship_amount . '
				</div>
				<div class="form-group">
					<label class="control-label">Status</label> ' . $row['ap_status'] . '
				</div>
				<div class="form-group">
					<label for="status" class="control-label">Zmień status wniosku</label>
					<select class="form-control" id="status" name="status">
						<option value="Przyjęto">Przyjęto</option>
						<option value="Rozpatrywane">W trakcie rozpatrywania</option>
					</select>
					<br>
					<button type="submit" class="btn btn-primary" value="changeStatus" name="submit">Zatwierdź status
					</button>
				</div>
				<div class="form-group">
					<div class="control-label">
						<a href="'.URL.'adminPanel/setDecision/' . $row['st_index'] . '" class="btn btn-success">Decyzja</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>';
    }
} else {
    echo '<div class="alert alert-dismissible alert-warning col-lg-4 col-lg-offset-4" align="center">
	Student nie złożył jeszcze wnioseku. <br></div>';
}
?>



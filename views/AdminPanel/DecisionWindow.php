<?php
require_once 'resources/menus/adminMenu.php';
if (isset($this->message))
    if ($this->message == "Sukces")
        echo '
<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Decyzja została poprawnie zamieszczona <br></div>';
    else
        echo '
<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br></div>';
if ($this->data == -1) {
    echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	Student o podanym indeksie nie istnieje<br></div>';
} elseif ($this->data > 0) {
    foreach ($this->data as $row) {
        echo '
<div class="col-lg-offset-4 col-lg-4">
	<div class="well bs-component">
		<form class="form-group" method="post">
			<fieldset>
				<legend>Decyzja</legend>
				<input type="hidden" id="dormChbx" value="' . $row['dorm_add'] . '">
				<div class="form-group">
				<input type="radio" value="positive" name="decision" onchange="DecisionWindowJSFunction(this.value)"> Pozytywna
				<input type="radio" value="negative" name="decision" onchange="DecisionWindowJSFunction(this.value)"> Negatywna
				</div>
				<div class="form-group">
					<label class="control-label">Imię i nazwisko</label> ' . $row['name'] . ' ' . $row['surname'] . '
				</div>
				<div class="form-group">
					<label class="control-label">Nr indeksu</label> ' . $row['st_index'] . '
				</div>
				<div id="decisionPart" style="display:none">
				<div class="form-group">
					<label for="amount" class="control-label">Kwota stypendium</label>
					<input class="form-control" id="amount" name="amount" type="text" required="required" value="' . $row['scholarship'] . '">
				</div>
				<div class="form-group" >

				<input type="checkbox" id="dormAddBox" name="dormAddBox"';
        if ($row['dorm_add'] == 0)
            echo ' disabled="true"';
        else
            echo ' disabled="false"';
        echo '><label class="control-label" > Dodatek mieszkaniowy </label >
				</div >
				<div class="form-group">
					<label for="dateFrom" class="control-label">Data od</label>
					<input class="form-control" id="dateFrom" name="dateFrom" type="text" required="required" placeholder="rrrr-mm-dd">
				</div>
				<div class="form-group">
					<label for="dateTo" class="control-label">Data do</label>
					<input class="form-control" id="dateTo" name="dateTo" type="text" required="required" placeholder="rrrr-mm-dd">
				</div>
				</div>
				<div class="form-group">
					<div class="control-label">
						<button type="submit" class="btn btn-success" value="setDecision" name="submit">Wydaj decyzję
						</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<script type="text/javascript">
function DecisionWindowJSFunction(value){
if(value=="positive"){
	document.getElementById("amount").required=true;
	document.getElementById("dateFrom").required=true;
	document.getElementById("dateTo").required=true;
	document.getElementById("decisionPart").style.display="block";
}
else{
	document.getElementById("amount").required=false;
	document.getElementById("dateFrom").required=false;
	document.getElementById("dateTo").required=false;
	document.getElementById("decisionPart").style.display="none";
}
}
</script>
';
    }
} else {
    echo '<div class="alert alert-dismissible alert-warning col-lg-4 col-lg-offset-4" align="center">
	Student nie złożył jeszcze wnioseku. <br></div>';
}
?>



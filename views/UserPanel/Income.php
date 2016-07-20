<?php
require_once 'resources/menus/applicationMenu.php';
if (isset($this->message))
if ($this->message == "Sukces")
echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Poprawnie dodano dochód <br></div>';
else
echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Nie udało się dodać. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
	<div class="well bs-component">
		<form class="form-group" method="post">
			<fieldset>
				<legend>Dochód</legend>
				<div class="form-group">
					<label for="incomeName" class="control-label">Nazwa</label>
					<input class="form-control" id="incomeName" name="incomeName" type="text" required="required">
				</div>
				<div class="form-group">
					<label for="incomeType" class="control-label">Typ źródła dochodu</label>
					<select class="form-control" id="incomeType" name="incomeType" required="required" onchange="IncomeJSFunction(this.value)">
						<option value=""></option>
						<option value="Umowa o pracę">Umowa o pracę</option>
						<option value="Umowa zlecenie">Umowa zlecenie</option>
						<option value="Umowa o dzieło">Umowa o dzieło</option>
						<option value="Papiery wartościowe">Papiery wartościowe</option>
						<option value="Działalność rolnicza">Działalność rolnicza</option>
						<option value="Własna działalność">Własna działalność</option>
						<option value="Diety">Diety</option>
						<option value="Dzierżawa">Ziemia oddana w dzierżawę</option>
						<option value="Alimenty otrzymywane">Alimenty otrzymywane</option>
						<option value="Alimenty płacone">Alimenty płacone</option>
						<option value="Emeryt">Emeryt/rencista</option>
						<option value="Student">Uczeń/student</option>
						<option value="Wiek przedszkolny">Wiek przedszkolny</option>
					</select>
				</div>
				<div id="incomeData" style="display: none">
				<div class="form-group">
					<label for="incomeAmount" class="control-label">Suma</label>
					<input class="form-control" id="incomeAmount" name="incomeAmount" type="text" required="required" placeholder="Jeśli brak, to wpisz 0">
				</div>
				<div class="form-group">
					<label for="incomeTax" class="control-label">Podatek</label>
					<input class="form-control" id="incomeTax" name="incomeTax" type="text" required="required" placeholder="Jeśli brak, to wpisz 0">
				</div>
				<div class="form-group">
					<label for="healthInsurance" class="control-label">Składki na ubezp. zdrowotne</label>
					<input class="form-control" id="healthInsurance" name="healthInsurance" type="text" required="required" placeholder="Jeśli brak, to wpisz 0">
				</div>
				<div class="form-group">
					<label for="socialInsurance" class="control-label">Składki na ubezp. społeczne</label>
					<input class="form-control" id="socialInsurance" name="socialInsurance" type="text" required="required" placeholder="Jeśli brak, to wpisz 0">
				</div>
				<div class="form-group">
					<label for="dateFrom" class="control-label">Data od</label>
					<input class="form-control" id="dateFrom" name="dateFrom" type="text" required="required" placeholder="rrrr-mm-dd">
				</div>
				<div class="form-group">
					<label for="dateTo" class="control-label">Data do</label>
					<input class="form-control" id="dateTo" name="dateTo" type="text" required="required" placeholder="rrrr-mm-dd">
					<h6 class="text-info">Jeśli cały rok, to wpisać od 1.01 do 31.12</h6>
				</div>
				</div>
				<script type="text/javascript">
					function IncomeJSFunction(value){
						if(value=="Student" || value=="Wiek przedszkolny"){
							document.getElementById("incomeAmount").required=false;
							document.getElementById("incomeTax").required=false;
							document.getElementById("healthInsurance").required=false;
							document.getElementById("socialInsurance").required=false;
							document.getElementById("dateFrom").required=false;
							document.getElementById("dateTo").required=false;
							document.getElementById("incomeData").style.display = 'none';
						}
						else{
							document.getElementById("incomeAmount").required=true;
							document.getElementById("incomeTax").required=true;
							document.getElementById("healthInsurance").required=true;
							document.getElementById("socialInsurance").required=true;
							document.getElementById("dateFrom").required=true;
							document.getElementById("dateTo").required=true;
							document.getElementById("incomeData").style.display = 'block';
						}
					}
				</script>
				<div class="form-group">
					<div class="control-label">
						<button type="submit" class="btn btn-primary" value="addIncome" name="submit">Zatwierdź</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
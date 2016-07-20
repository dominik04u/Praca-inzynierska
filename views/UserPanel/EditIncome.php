<?php
require_once 'resources/menus/applicationMenu.php';
if (isset($this->message))
	if ($this->message == "Sukces") {
		echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message . '</strong> Poprawnie zmieniono dane <br></div>';
		$this->request=$_GET['url'];
		$this->request = rtrim($this->request, "/");
		$this->params = explode("/", $this->request);
		if($this->params[1]=="editStudentIncome")
			header('refresh:3; url='. URL . 'UserPanel/studentIncomeWindow');
		else
			header('refresh:3; url='. URL . 'UserPanel/familyIncomeWindow/'.$this->member);
	}
	else
		echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
            <strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br></div>';
?>
<body onload="fun(incomeType.value)">
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Dochód</legend>
                <?php foreach ($this->data as $row) {
                    echo '
				<div class="form-group">
					<label for="incomeName" class="control-label">Nazwa</label>
					<input class="form-control" id="incomeName" name="incomeName" type="text" required="required" value="'.$row['income_name'].'">
				</div>
				<div class="form-group">
					<label for="incomeType" class="control-label">Typ źródła dochodu</label>
					<select class="form-control" id="incomeType" name="incomeType" required="required" onchange="EditIncomeJSFunction(this.value)">
						<option value=""></option>
						<option value="Umowa o pracę"'; if($row['income_source']=="Umowa o pracę") {echo 'selected="selected"';} echo '>Umowa o pracę</option>
						<option value="Umowa zlecenie"'; if($row['income_source']=="Umowa zlecenie") {echo 'selected="selected"';} echo '>Umowa zlecenie</option>
						<option value="Umowa o dzieło"'; if($row['income_source']=="Umowa o dzieło") {echo 'selected="selected"';} echo '>Umowa o dzieło</option>
						<option value="Papiery wartościowe"'; if($row['income_source']=="Papiery wartościowe") {echo 'selected="selected"';} echo '>Papiery wartościowe</option>
						<option value="Działalność rolnicza"'; if($row['income_source']=="Działalność rolnicza") {echo 'selected="selected"';} echo '>Działalność rolnicza</option>
						<option value="Własna działalność"'; if($row['income_source']=="Własna działalność") {echo 'selected="selected"';} echo '>Własna działalność</option>
						<option value="Diety"'; if($row['income_source']=="Diety") {echo 'selected="selected"';} echo '>Diety</option>
						<option value="Dzierżawa"'; if($row['income_source']=="Dzierżawa") {echo 'selected="selected"';} echo '>Ziemia oddana w dzierżawę</option>
						<option value="Alimenty otrzymywane"'; if($row['income_source']=="Alimenty otrzymywane") {echo 'selected="selected"';} echo '>Alimenty otrzymywane</option>
						<option value="Alimenty płacone"'; if($row['income_source']=="Alimenty płacone") {echo 'selected="selected"';} echo '>Alimenty płacone</option>
						<option value="Emeryt"'; if($row['income_source']=="Emeryt") {echo 'selected="selected"';} echo '>Emeryt/rencista</option>
						<option value="Student"'; if($row['income_source']=="Student") {echo 'selected="selected"';} echo '>Uczeń/student</option>
						<option value="Wiek przedszkolny"'; if($row['income_source']=="Wiek przedszkolny") {echo 'selected="selected"';} echo '>Wiek przedszkolny</option>
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
					<input class="form-control" id="dateFrom" name="dateFrom" type="text" required="required" value="'.$row['income_from'].'" placeholder="rrrr-mm-dd">
				</div>
				<div class="form-group">
					<label for="dateTo" class="control-label">Data do</label>
					<input class="form-control" id="dateTo" name="dateTo" type="text" required="required" value="'.$row['income_to'].'" placeholder="rrrr-mm-dd">
					<h6 class="text-info">Jeśli cały rok, to wpisać od 1.01 do 31.12</h6>
				</div>
				</div>

				<script type="text/javascript">
					function EditIncomeJSFunction(value){
						if(value=="Student" || value=="Wiek przedszkolny"){
							document.getElementById("incomeAmount").required=false;
							document.getElementById("incomeTax").required=false;
							document.getElementById("healthInsurance").required=false;
							document.getElementById("socialInsurance").required=false;
							document.getElementById("dateFrom").required=false;
							document.getElementById("dateTo").required=false;
							document.getElementById("incomeData").style.display = "none";
						}
						else{
							document.getElementById("incomeAmount").required=true;
							document.getElementById("incomeTax").required=true;
							document.getElementById("healthInsurance").required=true;
							document.getElementById("socialInsurance").required=true;
							document.getElementById("dateFrom").required=true;
							document.getElementById("dateTo").required=true;
							document.getElementById("incomeData").style.display = "block";
						}
					}
				</script>
				';
				} ?>

				<div class="form-group">
					<div class="control-label">
						<button type="submit" class="btn btn-primary" value="editIncome" name="submit">Zatwierdź</button>
					</div>
				</div>
            </fieldset>
        </form>
    </div>
</div>
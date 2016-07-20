<?php
require_once 'resources/menus/applicationMenu.php';
if (isset($this->alert))
    if ($this->alert == "Sukces") {
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Wniosek został wysłany <br></div>';
        header('refresh:5;' . URL . 'UserPanel/documentsList');
    } elseif ($this->alert == "Uwaga")
        echo '<div class="alert alert-dismissible alert-warning col-lg-4 col-lg-offset-4" align="center">
	        <strong>' . $this->alert . '</strong> Wniosek został przyjęty. Proszę donieść ewentualnie brakujące elementy. <br></div>';
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Spróbuj jeszcze raz <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Złóż wniosek</legend>
                <div class="form-group">
                    <p class="text-info" align="center">Zamieszczone dane są danymi poglądowymi</p>
                </div>
                <hr>
                <?php foreach ($this->data as $row) {
                    $scholarship = floor($row['scholarship_threshold'] - $row['income_per_person']);
                    if ($scholarship < 50 && $scholarship>0) {
                        $scholarship = 50;
                    }elseif($scholarship<0){
                        $scholarship=0;
                        echo '<div class="alert alert-dismissible alert-danger " align="center">
	        <strong>' . $this->alert . '</strong> Niestety średni dochód miesięczny na osobę jest wyższy niż próg stypendialny. <br></div>';
                    }
                    echo '<div class="form-group" >
					<label class="control-label"> Liczba członków gosp. domowego </label > <label class="control-label" style="color: #080808" >' . ($row['family_mem_numbers']+1) . '</label>
				</div >
				<div class="form-group" >
					<label class="control-label" > Dochód miesięczny na osobę </label > <label class="control-label" style="color: #080808" >' . $row['income_per_person'] . '</label>
				</div >
				<div class="form-group" >
					<label class="control-label" > Stypendium podstawowe </label > <label class="control-label" style="color: #080808" >' . $scholarship . '</label>
				</div >
				<div class="form-group" >
				<input type="checkbox" name="dormAddBox"';
                    if ($scholarship == 0)
                        echo ' disabled="true"';
                    echo ' onChange="ApplicationJSFunction(this.checked)"><label class="control-label" > Dodatek mieszkaniowy </label >
				</div >
				<div class="form-group" >
					<label class="control-label"> Dodatek</label >
					<label class="control-label" id="dormAdd" style="color: #080808" >0</label>
				</div >
				<div class="form-group" >
					<label class="control-label" > Całkowita suma stypendium </label > <label class="control-label" id="totalScholarship" style="color: #080808" >' . $scholarship . '</label>
				</div >
				<script type="text/javascript">
                    function ApplicationJSFunction(checked){
                    var dormAddAmount=' . $row['dorm_add_amount'] . '
                    var scholarship=' . $scholarship . '
                        if(checked==true){
                            document.getElementById("dormAdd").innerHTML=dormAddAmount;
                            document.getElementById("totalScholarship").innerHTML=dormAddAmount+scholarship;
                        }
                        else
                        {
                            document.getElementById("dormAdd").innerHTML=0;
                            document.getElementById("totalScholarship").innerHTML=scholarship;
                        }
                    }
                </script>

                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="apply" name="submit"';
                    if ($scholarship == 0)
                        echo ' disabled="true"';
                    echo '> Złóż wniosek</button>
                    </div>
                </div>';
    } ?>
            </fieldset>
        </form>
    </div>
</div>
<?php
require_once 'resources/menus/applicationMenu.php'; ?>
<div class="col-lg-offset-1 col-lg-10">
	<div class="well bs-component">
		<table class="table table-striped table-hover ">
			<thead>
			<tr>
				<th>#</th>
				<th>Nazwa</th>
				<th>Źródło dochodu</th>
				<th>Suma</th>
				<th>Data od</th>
				<th>Data do</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?php
                $id = 0;
				$id_member=$this->id_member;
                foreach ($this->data as $row) {
				echo '
				<td>' . ++$id . '</td>
				<td>' . $row['income_name'] . '</td>
				<td>' . $row['income_source'] . '</td>
				<td>' . $row['income_amount'] . '</td>
				<td>' . $row['income_from'] . '</td>
				<td>' . $row['income_to'] . '</td>
				<td>
					<a href="'.URL.'UserPanel/deleteFamilyIncome/'.$row['id_member'].'/'.$row['id_income'].'" class="btn btn-danger">Usuń</a>
					<a href="'.URL.'UserPanel/editFamilyIncome/'.$row['id_member'].'/'.$row['id_income'].'" class="btn btn-primary">Edytuj</a>
				</td></tr>';}

			echo'
			</tbody>
		</table>
		<hr>
		<div class="form-group">
			<a href="'.URL.'UserPanel/addFamilyIncome/'.$id_member.'" class="btn btn-success">Dodaj źródło dochodu</a>
		</div>';
			?>

	</div>
</div>
<?php
require_once 'resources/menus/applicationMenu.php'; ?>
<div class="col-lg-offset-1 col-lg-10">
    <div class="well bs-component">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>St. pokrewieństwa</th>
                <th>Data urodzenia</th>
                <th>Dochód całkowity</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $id = 0;
                foreach ($this->data as $row) {
                    echo '
				<td>' . ++$id . '</td>
				<td>' . $row['name'] . '</td>
				<td>' . $row['surname'] . '</td>
				<td>' . $row['relationship'] . '</td>
				<td>' . $row['date_of_birth'] . '</td>
				<td>' . $row['income'] . '</td>
				<td>
					<a href="'.URL.'userPanel/deleteFamilyMember/'.$row['id_member'].'" class="btn btn-danger">Usuń</a>
					<a href="'.URL.'userPanel/editFamilyMember/'.$row['id_member'].'" class="btn btn-primary">Edytuj</a>
					<a href="'.URL.'userPanel/familyIncomeWindow/'.$row['id_member'].'" class="btn btn-primary">Dochód</a>
				</td>
			</tr>';
                }
                ?>
            </tbody>
        </table>
        <hr>
        <div class="form-group">
            <a href="<?php echo URL; ?>UserPanel/addFamilyMember" class="btn btn-success">Dodaj członka rodziny</a>
        </div>

    </div>
</div>
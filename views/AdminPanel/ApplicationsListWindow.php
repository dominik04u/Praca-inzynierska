<?php
require_once 'resources/menus/adminMenu.php';
if (isset($this->data)) {
    echo '<div class="col-lg-offset-2 col-lg-8">
    <div class="well bs-component">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Imię i nazwisko</th>
                <th>Indeks</th>
                <th>Data złożenia wniosku</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>';
    $id = 0;
    foreach ($this->data as $row) {
        echo '
				<td>' . ++$id . '</td>
				<td>' . $row['name'] . ' ' . $row['surname'] . '</td>
				<td>' . $row['st_index'] . '</td>
				<td>' . $row['app_date'] . '</td>
				<td>' . $row['ap_status'] . '</td>
				<td>
					<a href="'.URL.'AdminPanel/showStudentProfile/'.$row['st_index'].'" class="btn btn-primary">Profil</a>
					<a href="'.URL.'AdminPanel/showApplication/'.$row['st_index'].'" class="btn btn-success">Wniosek</a>
				</td>
			</tr>';
    }
    echo '</tbody>
        </table>
    </div>
</div>';
}
else{
    echo '
<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	W chwili obecnej nie ma żadnych wniosków do rozpatrzenia <br></div>';

}
?>
<?php
require_once 'resources/menus/applicationMenu.php'; ?>
<div class="col-lg-offset-2 col-lg-8">
	<div class="well bs-component">
		<table class="table table-striped table-hover ">
			<thead>
			<tr>
				<th><h4>Wymagane dokumenty</h4></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?php
                $id = 0;
                foreach ($this->data as $row) {
				echo '
				<td>' . $row . '</td>
			</tr>';
			}
			?>
			</tbody>
		</table>

	</div>
</div>
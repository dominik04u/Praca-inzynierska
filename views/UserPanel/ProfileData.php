<?php
if(isset($_SESSION) && $_SESSION['privilege']=='user')
	require_once 'resources/menus/profileMenu.php';
elseif(isset($_SESSION) && $_SESSION['privilege']=='admin')
	require_once 'resources/menus/adminMenu.php';
?>
<br>
<div class="col-lg-offset-4 col-lg-4">
	<div class="well bs-component">
		<form class="form-group" method="post">
			<fieldset>
				<legend>Dane osobowe</legend>
				<?php foreach ($this->news as $row) {
					if ($row['degree']=='I')
						$row['degree']='1. stopień';
					else if ($row['degree']=='II')
						$row['degree']='2. stopień';
					if ($row['system']=='st')
						$row['system']='stacjonarne';
					else if ($row['system']=='nst')
						$row['system']='niestacjonarne';
				echo '<div class="form-group">
					<label class="control-label">Imię</label> '.$row['name'].'
				</div>
				<div class="form-group">
					<label class="control-label">Nazwisko</label> '.$row['surname'].'
				</div>
				<div class="form-group">
					<label class="control-label">Data urodzenia</label> '.$row['birth'].'
				</div>
				<div class="form-group">
					<label class="control-label">Numer indeksu</label> '.$_SESSION['st_index'].$row['st_index'].'
				</div>
				<legend>Studia</legend>
				<div class="form-group">
					<label class="control-label">Wydział</label> '.$row['faculty_name'].'
				</div>
				<div class="form-group">
					<label class="control-label">Kierunek</label> '.$row['subject_name'].'
				</div>
				<div class="form-group">
					<label class="control-label">Semestr</label> '.$row['semester'].'
				</div>
				<div class="form-group">
					<label class="control-label">Stopień</label> '.$row['degree'].'
				</div>
				<div class="form-group">
					<label class="control-label">System</label> '.$row['system'].'
				</div>
				<legend>Adres</legend>
				<div class="form-group">
					<label class="control-label">Miejscowość</label> '.$row['place'].'
				</div>
				<div class="form-group">
					<label class="control-label">Ulica</label> '.$row['street'].'
				</div>
				<div class="form-group">
					<label class="control-label">Nr domu</label> '.$row['house_number'].'
				</div>
				<div class="form-group">
					<label class="control-label">Nr mieszkania</label> '.$row['flat_number'].'
				</div>
				<div class="form-group">
					<label class="control-label">Kod pocztowy</label> '.$row['zip_code'].'
				</div>
				<div class="form-group">
					<label class="control-label">Poczta</label> '.$row['post_office'].'
				</div>
';} ?>
			</fieldset>
		</form>
	</div>
</div>
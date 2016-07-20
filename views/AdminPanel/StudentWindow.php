<?php require_once 'resources/menus/adminMenu.php'; ?>
    <div class="col-lg-offset-4 col-lg-6 ">
        <div class="well bs-component">
            <form class="form-group" method="post">
                <fieldset>
                    <legend>Wyszukaj</legend>
                    <div class="form-group" align="center">
                        <input type="radio" name="search" value="index" checked="checked"
                               onClick="changeForm('queryIndex')"> Indeks
                        <input type="radio" name="search" value="name"
                               onClick="changeForm('queryName')"> Imię i nazwisko
                        <input type="radio" name="search" value="faculty"
                               onClick="changeForm('queryFaculty')"> Wydział
                        <input type="radio" name="search" value="subject"
                               onClick="changeForm('querySubject')"> Kierunek
                        <input type="radio" name="search" value="system"
                               onClick="changeForm('querySystem')"> System
                        <input type="radio" name="search" value="degree"
                               onClick="changeForm('queryDegree')"> Stopień
                        <input type="radio" name="search" value="semester"
                               onClick="changeForm('querySemester')"> Semestr
                    </div>
                    <div class="form-group" style="display: block" id="queryIndex">
                        <label for="index" class="control-label">Indeks</label>
                        <input class="form-control" id="index" name="index" type="text">
                    </div>
                    <div class="form-group" style="display: none" id="queryName">
                        <label for="name" class="control-label">Imię</label>
                        <input class="form-control" id="name" name="name" type="text">
                        <label for="surname" class="control-label">Nazwisko</label>
                        <input class="form-control" id="surname" name="surname" type="text">
                    </div>
                    <div class="form-group" style="display: none" id="queryFaculty">
                        <label for="faculty" class="control-label">Wydział</label>
                        <select class="form-control" id="faculty" name="faculty">
                            <option value=""></option>
                            <option value="Wydział A">Wydział A</option>
                            <option value="Wydział B">Wydział B</option>
                            <option value="Wydział C">Wydział C</option>
                            <option value="Wydział D">Wydział D</option>
                            <option value="Wydział E">Wydział E</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="querySubject">
                        <label for="subject" class="control-label">Kierunek</label>
                        <select class="form-control" id="subject" name="subject">
                            <option value=""></option>
                            <option value="Kierunek AA">Kierunek AA</option>
                            <option value="Kierunek AB">Kierunek AB</option>
                            <option value="Kierunek AC">Kierunek AC</option>
                            <option value="Kierunek BA">Kierunek BA</option>
                            <option value="Kierunek BB">Kierunek BB</option>
                            <option value="Kierunek BC">Kierunek BC</option>
                            <option value="Kierunek CA">Kierunek CA</option>
                            <option value="Kierunek CB">Kierunek CB</option>
                            <option value="Kierunek CC">Kierunek CC</option>
                            <option value="Kierunek DA">Kierunek DA</option>
                            <option value="Kierunek DB">Kierunek DB</option>
                            <option value="Kierunek DC">Kierunek DC</option>
                            <option value="Kierunek EA">Kierunek EA</option>
                            <option value="Kierunek EB">Kierunek EB</option>
                            <option value="Kierunek EC">Kierunek EC</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="querySystem">
                        <label for="system" class="control-label">System</label>
                        <select class="form-control" id="system" name="system">
                            <option value=""></option>
                            <option value="st">Stacjonarne</option>
                            <option value="nst">Niestacjonarne</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="queryDegree">
                        <label for="degree" class="control-label">Stopień</label>
                        <select class="form-control" id="degree" name="degree">
                            <option value=""></option>
                            <option value="I">1. stopień (inżynierskie/licencjat)</option>
                            <option value="II">2. stopień (magisterskie)</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="querySemester">
                        <label for="semester" class="control-label">Semestr</label>
                        <select class="form-control" id="semester" name="semester">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <script type="text/javascript">
                        function changeForm(element) {
                                document.getElementById('queryIndex').style.display = 'none';
                                document.getElementById('queryName').style.display = 'none';
                                document.getElementById('queryFaculty').style.display = 'none';
                                document.getElementById('querySubject').style.display = 'none';
                                document.getElementById('querySystem').style.display = 'none';
                                document.getElementById('queryDegree').style.display = 'none';
                                document.getElementById('querySemester').style.display = 'none';
                                document.getElementById(element).style.display = 'block';
                        }
                    </script>
                    <div class="form-group col-lg-4">
                        <div class="control-label">
                            <button type="submit" class="btn btn-primary" value="searchStudent" name="submit">Wyszukaj
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
<?php
if (isset($this->data)) {
    echo '<div class="col-lg-offset-4 col-lg-6">
    <div class="well bs-component">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Imię i nazwisko</th>
                <th>Indeks</th>
                <th>Data urodzenia</th>
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
				<td>' . $row['birth'] . '</td>
				<td>' . $row['income_to'] . '</td>
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
?>
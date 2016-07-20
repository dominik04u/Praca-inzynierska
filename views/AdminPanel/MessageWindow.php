<?php require_once 'resources/menus/adminMenu.php'; ?>
<br>
<div class="col-lg-offset-4 col-lg-4">
	<div class="well bs-component">
		<form class="form-group" method="post" action="<?php echo URL; ?>AdminPanel/sendMessage">
			<fieldset>
				<legend>Wiadomość do studenta</legend>
				<div class="form-group">
					<label for="index" class="control-label">Index</label>
					<input class="form-control" id="index" name="index" type="text">
				</div>
				<div class="form-group">
					<label for="message" class="control-label">Treść</label>
					<textarea class="form-control" id="message" name="message" rows="5"></textarea>
				</div>
				<div class="form-group">
					<div class="control-label">
						<button type="submit" class="btn btn-primary">Wyślij</button>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
</div>
</body>
</html>
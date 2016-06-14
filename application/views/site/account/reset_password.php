<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center">

<h1>Wpisz nowe hasło</h1>
<hr>

<?php echo form_open(); ?>

<div class="row">
	<div class="form-group col-sm-4 col-sm-offset-4">
		<input class="form-control" type="password" name="password" placeholder="Nowe hasło">
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-4 col-sm-offset-4">
		<input class="form-control" type="password" name="passconf" placeholder="Powtórz nowe hasło">
	</div>
</div>

<button type="submit" class="btn btn-lg btn-primary">Zapisz zmiany</button>

<?php echo form_close(); ?>

		</div>
	</div>
</div>

<?php require_once APPPATH . 'views/site/include/footer.php'; ?>
</body>
</html>
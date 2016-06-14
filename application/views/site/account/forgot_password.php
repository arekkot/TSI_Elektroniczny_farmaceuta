<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center">

<h1>Zapomniałeś hasła?</h1>
<hr>

<?php echo form_open(); ?>

<div class="row">
	<div class="form-group col-sm-4 col-sm-offset-4">
		<input id="email" class="form-control" type="text" name="email" placeholder="Twój adres email">
	</div>
</div>

<button type="submit" class="btn btn-lg btn-primary">Przypomnij hasło</button>

<?php echo form_close(); ?>

		</div>
	</div>
</div>

<?php require_once APPPATH . 'views/site/include/footer.php'; ?>
</body>
</html>
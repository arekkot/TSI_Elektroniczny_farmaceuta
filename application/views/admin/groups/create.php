<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Nowa grupa</h1>
<hr>

<div class="row">
	<div class="col-sm-5">

<?php echo form_open(); ?>

<div class="form-group">
	<label for="name">Nazwa</label>
	<input id="name" class="form-control" type="text" name="name" placeholder="Nazwa">
</div>

<div class="form-group">
	<label for="alias">Alias (opcjonlanie)</label>
	<input id="alias" class="form-control" type="text" name="alias" placeholder="Alias (opcjonlanie)">
</div>

<button type="submit" class="btn btn-primary btn-lg">Dodaj grupę</button>

<?php echo form_close(); ?>

				</div>
			</div>

		</div>
	</div>
</div>

<?php require_once APPPATH . 'views/admin/include/footer.php'; ?>
</body>
</html>
<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Edycja grupy</h1>
<hr>

<div class="row">
	<div class="col-sm-5">
<?php echo form_open(); ?>
<div class="form-group">
	<label for="name">Nazwa</label>
	<input id="name" class="form-control" type="text" name="name" placeholder="Nazwa" value="<?php echo $group->name; ?>">
</div>

<div class="form-group">
	<label for="alias">Alias (opcjonlanie)</label>
	<input id="alias" class="form-control" type="text" name="alias" placeholder="Alias (opcjonlanie)" value="<?php echo $group->alias; ?>">
</div>

<button type="submit" class="btn btn-primary btn-lg">Zapisz</button>

<?php echo form_close(); ?>

				</div>
			</div>

		</div>
	</div>
</div>

<footer>
  <div class="container-fluid">
    <div class="col-md-12">
      <p class="footer-text">Elektroniczny Farmaceuta:</p>
      <p class="footer-last">tel: 663698144</p>
    </div>
  </div>
</footer>

<?php require_once APPPATH . 'views/admin/include/footer.php'; ?>
</body>
</html>

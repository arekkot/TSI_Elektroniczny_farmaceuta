<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Nowy użytkownik</h1>
<hr>

<div class="row">
	<div class="col-sm-5">

<?php echo form_open(); ?>

<div class="form-group">
	<label for="name">Imię</label>
	<input id="name" class="form-control" type="text" name="name" placeholder="Imię">
</div>

<div class="form-group">
	<label for="email">Email</label>
	<input id="email" class="form-control" type="text" name="email" placeholder="Email">
</div>

<div class="form-group">
	<label for="password">Hasło</label>
	<input id="password" class="form-control" type="password" name="password" placeholder="Hasło">
</div>

<div class="form-group">
	<label for="password">Powtórz hasło</label>
	<input id="password" class="form-control" type="password" name="passconf" placeholder="Powtórz hasło">
</div>

<?php foreach ( $groups as $group ): ?>
	<input id="group-id-<?php echo $group->id; ?>" type="checkbox" name="groups[<?php echo $group->id; ?>]" value="<?php echo $group->name; ?>">
	<label for="group-id-<?php echo $group->id; ?>">
		<?php echo $group->name; ?>
	</label>
	<br>
<?php endforeach; ?>
<p>&nbsp;</p>

<button type="submit" class="btn btn-primary btn-lg">Dodaj użytkownika</button>

<?php echo form_close(); ?>
<p>&nbsp;</p>

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

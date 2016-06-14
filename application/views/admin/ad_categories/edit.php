<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Edycja kategorii</h1>
<hr>

<div class="row">
	<div class="col-sm-5">

<?php echo form_open(); ?>

<div class="form-group">
	<label for="name">Nazwa</label>
	<input id="name" class="form-control" type="text" name="name" placeholder="Nazwa" value="<?php echo $ad_category->name; ?>">
</div>

<div class="form-group">
	<label for="alias">Alias (opcjonlanie)</label>
	<input id="alias" class="form-control" type="text" name="alias" placeholder="Alias (opcjonlanie)" value="<?php echo $ad_category->alias; ?>">
</div>


<div class="form-group">
	<label for="parent_id">Nadrzędna kategoria</label>

	<select id="parent_id" class="form-control" name="parent_id">

		<option value="0">Brak</option>
	
		<?php foreach ( $first_level as $first ): ?>

			<option value="<?php echo $first->id; ?>" <?php if ( $ad_category->parent_id == $first->id ) echo 'selected'; ?>>
				<?php echo $first->name; ?>
			</option>


			<?php foreach ( $second_level as $second ): ?>

				<?php if ( $second->parent_id == $first->id ): ?>

					<option value="<?php echo $second->id; ?>" <?php if ( $ad_category->parent_id == $second->id ) echo 'selected'; ?>>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo $second->name; ?>
					</option>

					
				<?php endif; ?>
				
			<?php endforeach; ?>

		<?php endforeach; ?>

	</select>

</div>

<button type="submit" class="btn btn-primary btn-lg">Zapisz</button>

<?php echo form_close(); ?>

<?php require_once APPPATH . 'views/admin/include/footer.php'; ?>
</body>
</html>
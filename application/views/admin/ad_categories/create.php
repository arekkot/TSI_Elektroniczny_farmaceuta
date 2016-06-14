<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Nowa kategoria</h1>
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

<div class="form-group">
	<label for="parent_id">Nadrzędna kategoria</label>

	<select id="parent_id" class="form-control" name="parent_id">
		
		<option value="0">Brak</option>
		
		<?php foreach ( $first_level as $first ): ?>

			<option value="<?php echo $first->id; ?>">
				<?php echo $first->name; ?>
			</option>


			<?php foreach ( $second_level as $second ): ?>

				<?php if ( $second->parent_id == $first->id ): ?>

					<option value="<?php echo $second->id; ?>">
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo $second->name; ?>
					</option>
					
				<?php endif; ?>
				
			<?php endforeach; ?>

			
		<?php endforeach; ?>

	</select>

</div>

<button type="submit" class="btn btn-primary btn-lg">Dodaj</button>

<?php echo form_close(); ?>

				</div>
			</div>

		</div>
	</div>
</div>

<?php require_once APPPATH . 'views/admin/include/footer.php'; ?>
</body>
</html>
<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<a href="<?php echo base_url( 'ads/show/' . $ad->id . '/' . alias( $ad->subject ) ) ?>">Powrót do ogłoszenia</a>

<h1>Edycja ogłoszenia</h1>
<hr>

<?php echo form_open(); ?>

<p>Wybierz miniaturę</p>

	<?php if ( !empty( $uploaded_files ) ): ?>
		
		<?php foreach ( $uploaded_files as $file ): ?>

			<div style="position:relative;">
			
				<label for="<?php echo $file; ?>">
					<img src="<?php echo $thumbs_url . $file; ?>" alt="" class="img-thumbnail"><br>
					<input type="radio" name="thumb" id="<?php echo $file; ?>" value="<?php echo $file; ?>" <?php if ( $ad->thumb == $file ) echo 'checked'; ?>>
				</label>

				<a href="<?php echo base_url( 'ads/delimg/' . $file ); ?>" class="btn btn-warning btn-xs" style="position:absolute; top:5px;left:5px;"><strong>&times;</strong></a>

			</div>

		<?php endforeach; ?>

	<?php endif; ?>

<hr>

<div class="form-group">
	<label for="subject">Nazwa apteki</label>
	<input id="subject" class="form-control" type="text" name="subject" placeholder="Nazwa apteki" value="<?php echo $ad->subject; ?>">
</div>

<div class="form-group">
	<label for="description">Szczegóły ogłoszenia</label>
	<textarea id="description" class="form-control" type="text" name="description" placeholder="Szczegóły ogłoszenia"><?php echo $ad->description; ?></textarea>
</div>

<div class="form-group">
	<label for="marka">Miejscowość</label>
	<input id="marka" class="form-control" type="text" name="marka" placeholder="Miejscowość" value="<?php echo $ad->marka; ?>">
</div>

<div class="form-group">
	<label for="stan">Zlecenie dla</label>

	<select id="stan" class="form-control" name="stan">
		<option value="Nowy" <?php if ( $ad->stan == 'Nowy' ) echo 'selected'; ?>>Technik Farmacji</option>
		<option value="Używany" <?php if ( $ad->stan == 'Używany' ) echo 'selected'; ?>>Student Farmacji</option>
	</select>

</div>

<div class="form-group">
	<label for="kategoria">Kategoria</label>

	<select id="kategoria" class="form-control" name="category_id">
	
	<?php foreach ( $first_level as $first ): ?>

		<option value="<?php echo $first->id; ?>" <?php if ( $ads_cats->cat_id == $first->id ) echo 'selected'; ?>>
			<?php echo $first->name; ?>
		</option>


		<?php foreach ( $second_level as $second ): ?>

			<?php if ( $second->parent_id == $first->id ): ?>

				<option value="<?php echo $second->id; ?>" <?php if ( $ads_cats->cat_id == $second->id ) echo 'selected'; ?>>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $second->name; ?>
				</option>

				
			<?php endif; ?>
			
		<?php endforeach; ?>

		
	<?php endforeach; ?>

	</select>

</div>

<div class="form-group">
	<label for="phone">Telefon kontaktowy</label>
	<input id="phone" class="form-control" type="text" name="phone" placeholder="Telefon kontaktowy" <?php if ( !empty( $user->phone ) ) echo 'value="' . $user->phone . '"' ?>>
</div>

<div class="form-group">
	<label for="price">Koszt wykonania zlecenia</label>
	<input id="price" class="form-control" type="text" name="price" placeholder="Wpisz wartość liczbową" value="<?php echo $ad->price; ?>">
</div>

<button type="submit" class="btn btn-primary btn-lg">Zapisz zmiany</button>

<?php echo form_close(); ?>

<?php require_once APPPATH . 'views/site/include/footer.php'; ?>
</body>
</html>
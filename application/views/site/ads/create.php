<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Nowe ogłoszenie</h1>
<hr>

<?php echo form_open_multipart( 'ads/upload' ); ?>

	<p>Wybierz zdjęcia i wybierz miniaturę</p>
	<input type="file" name="userfile"><br>
	<button type="submit" class="btn btn-primary btn-lg">Załaduj wybrane zdjęcie</button>

<?php echo form_close(); ?>

<?php echo form_open(); ?>

	<?php if ( !empty( $uploaded_files ) ): ?>

		<?php foreach ( $uploaded_files as $file ): ?>


			<label for="<?php echo $file; ?>">
				<img src="<?php echo $temp_url . $file; ?>" alt=""><br>
				<input type="radio" name="thumb" id="<?php echo $file; ?>" value="<?php echo $file; ?>">
			</label>

			<a href="<?php echo base_url( 'ads/delimg/' . $file ); ?>">Usuń</a>
			<br>

		<?php endforeach; ?>

	<?php endif; ?>

<hr>

<div class="row">
	<div class="col-sm-5">

<div class="form-group">
	<label for="subject">Nazwa apteki</label>
	<input id="subject" class="form-control" type="text" name="subject" placeholder="Nazwa apteki">
</div>

<div class="form-group">
	<label for="description">Szczegóły ogłoszenia</label>
	<textarea id="description" class="form-control" type="text" name="description" placeholder="Szczegóły ogłoszenia"></textarea>
</div>

<div class="form-group">
	<label for="marka">Miejscowość</label>
	<input id="marka" class="form-control" type="text" name="marka" placeholder="Miejscowość">
</div>

<div class="form-group">
	<label for="stan">Zlecenie dla:</label>

	<select id="stan" class="form-control" name="stan">
		<option value="Nowy">Technik Farmacji</option>
		<option value="Używany">Student Farmacji</option>
	</select>

</div>

<div class="form-group">
	<label for="kategoria">Wybierz Kategorie</label>

	<select id="kategoria" class="form-control" name="category_id">

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

<div class="form-group">
	<label for="phone">Telefon kontaktowy</label>
	<input id="phone" class="form-control" type="text" name="phone" placeholder="Telefon kontaktowy" <?php if ( !empty( $user->phone ) ) echo 'value="' . $user->phone . '"' ?>>
</div>

<div class="form-group">
	<label for="price">Koszt wykonania zlecenia</label>
	<input id="price" class="form-control" type="text" name="price" placeholder="Wpisz wartość liczbową">
</div>

<div class="form-group">
	<div class="checkbox">
		<label>
			<input id="promo" type="checkbox" name="promo" value="tak"> Promuj ogłoszenie przez 30 dni za 10 zł
		</label>
	</div>
</div>

<button type="submit" class="btn btn-primary btn-lg">Dodaj ogłoszenie</button>

<?php echo form_close(); ?>

<p>&nbsp;</p>

				</div>
			</div>

		</div>
	</div>
</div>
<footer>
  <div class="container">
    <div class="col-md-12">
      <p class="footer-text">Elektroniczny Farmaceuta:</p>
      <p class="footer-last">tel: 663698144</p>
    </div>
  </div>
</footer>

<?php require_once APPPATH . 'views/site/include/footer.php'; ?>
</body>
</html>

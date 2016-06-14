<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-6 col-md-6">

<?php if ( $user_id == $ad->user_id || check_group( 1 ) == true ): ?>
	<div>
		<a href="<?php echo base_url( 'ads/edit/' . $ad->id ); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
		<a href="<?php echo base_url( 'ads/delete/' . $ad->id ); ?>" onclick="return confirm( 'Czy na pewno usunąć?' )" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
	</div>
<?php endif; ?>

<h1 class="shop-title"><?php echo $ad->subject; ?></h1>


<p>
<?php echo $ad->description; ?>
</p>
<p><strong>Miasto: <?php echo $ad->marka; ?></strong></p>

<?php if ( !empty( $uploaded_files ) ): ?>

	<?php foreach ( $uploaded_files as $file ): ?>

		<a href="<?php echo $full_img_url . $file; ?>"><img src="<?php echo $thumbs_url . $file; ?>" alt="" class="img-thumbnail" style="width:50%;"></a>

	<?php endforeach; ?>

<?php endif; ?>

<br>

<h2 class="text-info">Wynagrodzenie <?php echo $ad->price; ?> zł</h2>
<a href="<?php echo base_url( 'ads/cart/' . $ad->id ); ?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-shopping-star"></span> Dodaj do ulubionych</a>
<p>&nbsp;</p>
</div>
<div class="col-xs-12 col-md-6">
	<h2>Skontaktuj się z ogłoszeniodawcą</h2>

	<p><strong>Email: <?php echo $user->email; ?></strong></p>
	<p><strong>Telefon: <?php echo $user->phone; ?></strong></p>

	<p><?php echo $ad->description; ?></p>

<hr>

<?php echo form_open( '' , 'class="form-horizontal"' ); ?>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 col-md-3 control-label">Twój Email</label>
<div class="col-sm-8 col-md-8">
	<input type="text" name="email" placeholder="Twój e-mail" class="form-control">
</div>
</div>

<div class="form-group">
	<label for="inputEmail3" class="col-sm-4 col-md-3 control-label">Temat</label>
	<div class="col-sm-8 col-md-8">
		<input type="text" name="subject" placeholder="Temat wiadomości" class="form-control">
	</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 col-md-3 control-label">Wiadomość</label>
<div class="col-sm-8 col-md-8">
	<textarea type="text" name="message" placeholder="Wiadomość" class="form-control"></textarea>
</div>
</div>

<div class="col-sm-12 col-md-12">
	<button type="submit" class="btn btn-success btn-block">Wyślij wiadmość</button>
</div>
<?php echo form_close(); ?>
</div>
		</div>
	</div>
</div>

<p>&nbsp;</p>

<footer>
  <div class="container-fluid">
    <div class="col-md-12">
      <p class="footer-text">Elektroniczny Farmaceuta:</p>
      <p class="footer-last">tel: 663698144</p>
    </div>
  </div>
</footer>


<?php require_once APPPATH . 'views/site/include/footer.php'; ?>
</body>
</html>

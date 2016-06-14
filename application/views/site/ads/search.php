<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<?php if ( !empty( $ads ) ): ?>

	<h1>Wyników wyszukiwania (<?php echo count( $ads ); ?>)</h1>
	<hr>

<?php foreach ( $ads as $ad ): ?>
	<div class="row">

		<div class="col-sm-4">
			<a href="<?php echo base_url( 'ads/show/' . $ad->id . '/' . alias( $ad->subject ) ); ?>"><img class="img-responsive" src="<?php echo base_url( 'img/ogloszenia/' . $ad->id . '/thumbs/' . $ad->thumb ); ?>" alt=""></a>
		</div>

		<div class="col-sm-8">
			<h2><a href="<?php echo base_url( 'ads/show/' . $ad->id . '/' . alias( $ad->subject ) ); ?>"><?php echo $ad->subject; ?></a></h2>
			<p><?php echo character_limiter( $ad->description , 50 ); ?></p>
		</div>

	</div>
		<p>&nbsp;</p>
<?php endforeach; ?>

<?php else: ?>

	<h1>Brak wyników spełniających Twoje kryteria</h1>

<?php endif; ?>

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

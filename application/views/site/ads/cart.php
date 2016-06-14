<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Ulubione</h1>
<hr>

<?php if ( !empty( $cart ) ): ?>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nazwa Apteki</th>
				<th>Wynagrodzenie</th>
				<th>Usuń</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ( $cart as $key => $item ): ?>

				<tr>

					<td><?php echo $item['subject']; ?></td>
					<td><?php echo $item['price']; ?> PLN</td>
					<td><a href="<?php echo base_url( 'ads/cart/' . $key . '/del' ) ?>" class="btn btn-xs btn-danger"><strong>&times;</strong></a></td>

				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>
</div>

<a href="<?php echo base_url( 'ads/cart/' . $key . '/clear' ) ?>" class="btn btn-sm btn-primary">Wyczyść ulubione ogłoszenia</a>

<?php else: ?>

<h2>Nie masz ulubionych ogłoszeń</h2>

<?php endif; ?>

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

<?php require_once APPPATH . 'views/site/include/footer.php'; ?>
</body>
</html>

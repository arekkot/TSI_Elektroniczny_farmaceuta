<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center">

<h1>Opłać promowane ogłoszenie</h1>
<hr>

<h3>Kwota: 10 zł</h3>

<form action="https://secure.transferuj.pl" method="post" accept-charset="utf-8">

<!-- ZASTĄP XXXX swoim id z transferuj.pl -->
<input type="hidden" name="id" value="XXXX">

<input type="hidden" name="kwota" value="10">
<input type="hidden" name="opis" value="Promowanie ogłoszenia przez 30 dni">
<input type="hidden" name="crc" value="<?php echo $ad_id ?>">
<input type="hidden" name="wyn_url" value="<?php echo base_url( 'ads/payment' ) ?>">

<input type="submit" name="Przejdź do płatności" value="Przejdź do płatności" class="btn btn-lg btn-primary">
</form>

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

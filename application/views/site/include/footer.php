<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url( 'js/bootstrap.min.js' ) ?>"></script>

<!-- Modal -->
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formularz logowania</h4>
      </div>
      <div class="modal-body">

      	<?php echo form_open( 'account/login' , 'class="form-horizontal"' ); ?>

		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<input type="text" name="email" placeholder="Email" class="form-control">
        <input type="password" name="password" placeholder="Hasło" class="form-control">


      </div>
      <div class="col-xs-6 col-xs-offset-3">
				Zapamiętaj mnie <input type="checkbox" name="remember" value="1">
				<a href="<?php echo base_url( 'account/forgot-password' ); ?>" class="pull-right">Zapomniałeś hasła?</a>
			</div>
		</div>



		<div class="row">

		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Zaloguj się</button>
      </div>

		<?php echo form_close(); ?>

    </div>
  </div>
</div>


<div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formularz rejestracji</h4>
      </div>
      <div class="modal-body">

      	<?php echo form_open( 'account/registration' , 'class="form-horizontal"' ); ?>
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3 register-form">
        	<input type="text" name="name" placeholder="Imię" class="form-control first-form">
				  <input type="text" name="email" placeholder="Email" class="form-control">
        	<input type="password" name="password" placeholder="Hasło" class="form-control">
          <input type="password" name="passconf" placeholder="Potwórz hasło" class="form-control">
          <label class="radio-inline"><input type="radio" name="optradio" class="form-tex">Mam aptekę</label>
          <label class="radio-inline"><input type="radio" name="optradio" class="form-tex">Szukam pracy</label>
      </div>
		</div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Zarejestruj się</button>
      </div>

		<?php echo form_close(); ?>

    </div>
  </div>
</div>

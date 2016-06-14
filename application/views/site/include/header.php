<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmaceuta</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url( 'css/bootstrap.min.css' ) ?>" rel="stylesheet">
    <link href="<?php echo base_url( 'css/main.css' ) ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


<?php if ( $this->session->flashdata( 'alert' ) == true ): ?>

	<div class="alert alert-warning alert-dismissible text-center" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $this->session->flashdata( 'alert' ); ?>
	</div>

<?php endif; ?>

<div class="container-fluid mainContainer">
	<div class="row">
		<div class="col-md-12">

			<nav class="navbar">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="<?php echo base_url() ?>">Farmaceuta</a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			      <ul class="nav navbar-nav navbar-right">
			        <li><a href="<?php echo base_url( 'ads/create' ) ?>">Dodaj aptekę</a></li>

			        <?php if ( logged_in() == false ): ?>
			        	<li><a href="#" data-toggle="modal" data-target="#Login">Zaloguj się</a></li>
			        <?php else: ?>
			        	<li><a href="<?php echo base_url( 'account/logout' ) ?>">Wyloguj się</a></li>
			        <?php endif; ?>

			        <?php if ( logged_in() == false ): ?>
			        	<li><a class="register-button" href="#" data-toggle="modal" data-target="#Register">Zarejestruj się</a></li>
			        <?php else: ?>
			        	<li><a href="<?php echo base_url( 'account/index' ) ?>">Twoje konto</a></li>
			        <?php endif; ?>

					<?php if ( logged_in() == true )
					{

						// 1 - grupa admina
						if ( check_group( 1 ) )
						{
							?>
								<li><a href="<?php echo base_url( 'admin' ) ?>">Admin</a></li>
							<?php
						}

					} ?>

			      </ul>

				<?php echo form_open( 'ads/index' , 'class="navbar-form navbar-right" role="search"' ); ?>
				  <!--  <div class="input-group">
				      <input type="text" name="search" class="form-control" placeholder="Szukaj...">
				      <span class="input-group-btn">
				        <button type="submit" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				      </span>
				    </div><!-- /input-group -->
				<?php echo form_close(); ?>

			    <?php if ( $this->session->has_userdata( 'cart' ) ): ?>
			   		<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="<?php echo base_url( 'ads/cart' ); ?>">Ulubione</a>
						</li>
					</ul>
				<?php endif; ?>

			    </div><!-- /.navbar-collapse -->

			  </div><!-- /.container-fluid -->
			</nav>
      <div class="container-fluid hello-container">
            <div class="row">
              <div class="col-md-12 bannerglowna">
                <h1 class="hello-text">Poznaj elektronicznego farmaceutę!</h1>
              <!--  <button onclick="window.location.href='account/'" class="btn btn-secondary button-hello">Przejdź do swojego panelu!</button>-->
                <br><br><br>
              </div>
            </div>
          </div>


			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>





			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">



			      <ul class="nav navbar-nav">

			    <?php

			    foreach ( $first_level as $first )
			    {
			    	$first_lvl_ids_arr[] = $first->id;
			    }

			    foreach ( $second_level as $second )
			    {
			    	$second_lvl_parent_ids_arr[] = $second->parent_id;
			    }

			    $single_lvl_ids_arr = array_diff( $first_lvl_ids_arr , $second_lvl_parent_ids_arr );

			    ?>


				<?php foreach ( $first_level as $first ): ?>

					<?php if ( in_array( $first->id , $single_lvl_ids_arr ) ): ?>

					<li>
						<a href="<?php echo base_url( 'ads/cat/' . $first->alias ) ?>"><?php echo $first->name; ?> <span class="badge"><?php echo !empty( $ads_cats_count_menu[$first->id] ) ? $ads_cats_count_menu[$first->id] : 0 ; ?></span></a>
					</li>

					<?php else: ?>

			        <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="<?php echo base_url( 'ads/cat/' . $first->alias ) ?>"><?php echo $first->name; ?> <span class="badge"><?php echo !empty( $ads_cats_count_menu[$first->id] ) ? $ads_cats_count_menu[$first->id] : 0 ; ?></span> <span class="caret"></span></a>

			          	<ul class="dropdown-menu" role="menu">

							<?php foreach ( $second_level as $second ): ?>

								<?php if ( $second->parent_id == $first->id ): ?>

									<li>
										<a href="<?php echo base_url( 'ads/cat/' . $second->alias ) ?>"><?php echo $second->name; ?> <span class="badge"><?php echo !empty( $ads_cats_count_menu[$second->id] ) ? $ads_cats_count_menu[$second->id] : 0 ; ?></span> </a>
									</li>

								<?php endif; ?>

							<?php endforeach; ?>

						</ul>
					</li>

					<?php endif; ?>

				<?php endforeach; ?>

			      </ul>


			    </div><!-- /.navbar-collapse -->

			  </div><!-- /.container-fluid -->
			</nav>

		</div>
	</div>
</div>

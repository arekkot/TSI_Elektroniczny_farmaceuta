<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url( 'css/bootstrap.min.css' ) ?>" rel="stylesheet">

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

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="<?php echo base_url() ?>">PANEL ADMINA</a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			      <ul class="nav navbar-nav">

			        <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">Użytkownicy <span class="caret"></span></a>

			          	<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url( 'admin/users' ) ?>">Lista użytkowników</a>
							</li>
							<li>
								<a href="<?php echo base_url( 'admin/users/create' ) ?>">Nowy użytkownik</a>
							</li>
						</ul>
					</li>

			        <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">Grupy <span class="caret"></span></a>

			          	<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url( 'admin/groups' ) ?>">Lista grup</a>
							</li>
							<li>
								<a href="<?php echo base_url( 'admin/groups/create' ) ?>">Nowa grupa</a>
							</li>
						</ul>
					</li>

			        <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">Kategorie <span class="caret"></span></a>

			          	<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url( 'admin/ad-categories' ) ?>">Lista kategorii</a>
							</li>
							<li>
								<a href="<?php echo base_url( 'admin/ad-categories/create' ) ?>">Nowa kategoria</a>
							</li>
						</ul>
					</li>

			      </ul>

			    </div><!-- /.navbar-collapse -->

			  </div><!-- /.container-fluid -->
			</nav>

		</div>
	</div>
</div>


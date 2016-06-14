<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Kategorie</h1>
<hr>

<ul>	
	<?php foreach ( $first_level as $first ): ?>

		<li>
			<?php echo $first->name; ?>
			<a href="<?php echo base_url( 'admin/ad-categories/edit/' . $first->id ); ?>" class="btn btn-xs btn-warning">edytuj</a>
			<a href="<?php echo base_url( 'admin/ad-categories/delete/' . $first->id ); ?>" class="btn btn-xs btn-danger" onclick="return confirm( 'Czy na pewno usunąć?' )">usuń</a>	
		</li>
		<br>

			<ul>

				<?php foreach ( $second_level as $second ): ?>

					<?php if ( $second->parent_id == $first->id ): ?>

						<li>
							<?php echo $second->name; ?>
							<a href="<?php echo base_url( 'admin/ad-categories/edit/' . $second->id ); ?>" class="btn btn-xs btn-warning">edytuj</a>
							<a href="<?php echo base_url( 'admin/ad-categories/delete/' . $second->id ); ?>" class="btn btn-xs btn-danger" onclick="return confirm( 'Czy na pewno usunąć?' )">usuń</a>	
						</li>
						<br>
						
					<?php endif; ?>
					
				<?php endforeach; ?>

			</ul>
		
	<?php endforeach; ?>

</ul><br>		

		</div>
	</div>
</div>

<?php require_once APPPATH . 'views/admin/include/footer.php'; ?>
</body>
</html>
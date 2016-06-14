<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Grupy (<?php echo count( $groups ); ?>)</h1>
<hr>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Imię</th>
				<th>Aias</th>
				<th>Edytuj</th>
				<th>Usuń</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ( $groups as $group ): ?>

				<tr>

					<td>
						<?php echo $group->id; ?>
					</td>

					<td>
						<?php echo $group->name; ?>
					</td>

					<td>
						<?php echo $group->alias; ?>
					</td>

					<td>
						<?php if ( $group->alias != 'admin' ): ?>
							<a href="<?php echo base_url( 'admin/groups/edit/' . $group->id ); ?>" class="btn btn-xs btn-warning">edytuj</a>
						<?php endif; ?>
					</td>

					<td>
						<?php if ( $group->alias != 'admin' ): ?>
							<a href="<?php echo base_url( 'admin/groups/delete/' . $group->id ); ?>" class="btn btn-xs btn-danger" onclick="return confirm( 'Czy na pewno usunąć?' )">usuń</a>
						<?php endif; ?>
					</td>
				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>
</div>

		</div>
	</div>
</div>

<?php require_once APPPATH . 'views/admin/include/footer.php'; ?>
</body>
</html>
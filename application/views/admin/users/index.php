<?php require_once APPPATH . 'views/admin/include/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">

<h1>Użytkownicy (<?php echo count( $users ); ?>)</h1>
<hr>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Imię</th>
				<th>Email</th>
				<th>Grupy</th>
				<th>Edytuj</th>
				<th>Usuń</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ( $users as $user ): ?>

				<tr>

					<td>
						<?php echo $user->id; ?>
					</td>

					<td>
						<?php echo $user->name; ?>
					</td>

					<td>
						<?php echo $user->email; ?>
					</td>
					
					<td>
						<?php foreach ( $users_groups as $group ): ?>
							<?php if ( $user->id == $group->user_id ): ?>
								<?php echo $groups_ids_names_arr[$group->group_id]; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</td>

					<td>
						<a href="<?php echo base_url( 'admin/users/edit/' . $user->id ); ?>" class="btn btn-xs btn-warning">edytuj</a>
					</td>

					<td>
						<a href="<?php echo base_url( 'admin/users/delete/' . $user->id ); ?>" class="btn btn-xs btn-danger" onclick="return confirm( 'Czy na pewno usunąć?' )">usuń</a>
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
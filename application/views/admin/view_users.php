<div id="body">

	<h2>View All Users</h2>

	<table>
		<tr>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>E-mail</th>
			<th>Company</th>
			<th>Job Title</th>
			<th>Creation Time</th>
			<th>Actions</th>
		</tr>

		<?php foreach ($users as $user): ?>

			<tr>
				<td><?php echo($user->id) ?></td>
				<td><?php echo($user->first_name) ?></td>
				<td><?php echo($user->last_name) ?></td>
				<td><?php echo($user->email) ?></td>
				<td><?php echo($user->company) ?></td>
				<td><?php echo($user->title) ?></td>
				<td><?php echo($user->creation_time) ?></td>
				<td><a href="<?php echo(base_url("admin/users/edit/{$user->id}")); ?>">View Exams / Change Info</a></td>
			</tr>

		<?php endforeach; ?>

	</table>

</div>


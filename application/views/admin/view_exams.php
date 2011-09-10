<div id="body">

	<h2>View All Exams</h2>

	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Creation Time</th>
			<th>Actions</th>
		</tr>

		<?php foreach ($exams as $exam): ?>

			<tr>
				<td><?php echo($exam->id) ?></td>
				<td><?php echo($exam->name) ?></td>
				<td>$<?php echo($exam->price) ?></td>
				<td><?php echo($exam->creation_time) ?></td>
				<td><a href="<?php echo(base_url("admin/exams/edit/{$exam->id}")); ?>">View Exam / Change Info</a></td>
			</tr>

		<?php endforeach; ?>

	</table>

</div>


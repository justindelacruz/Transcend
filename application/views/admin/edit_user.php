<h2>User Details</h2>

<form action="<?php echo(base_url("admin/users/update_user")); ?>/" method="POST">

	<table>
		<tr>
			<th>User ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>E-mail</th>
			<th>Company</th>
			<th>Job Title</th>
			<th>Creation Time</th>
			<th>Actions</th>
		</tr>

		<tr>
			<td><?php echo($user->id) ?></td>
			<td><input type="text" name="first_name" value="<?php echo($user->first_name) ?>" /></td>
			<td><input type="text" name="last_name" value="<?php echo($user->last_name) ?>" /></td>
			<td><input type="email" name="email" value="<?php echo($user->email) ?>" /></td>
			<td><input type="text" name="company" value="<?php echo($user->company) ?>" /></td>
			<td><input type="text" name="title" value="<?php echo($user->title) ?>" /></td>
			<td><?php echo($user->creation_time) ?></td>
			<td>
				<input type="hidden" name="id" value="<?php echo($user->id) ?>" />
				<input type="Submit" value="Save" />
			</td>
		</tr>

	</table>

</form>

<h2>Purchased Exams</h2>

<?php if (count($exams) > 0) { ?>

	<table>
		<tr>
			<th>Purchase ID</th>
			<th>Exam ID</th>
			<th>Paid</th>
			<th>Status</th>
			<th>Last Question Answered</th>
			<th>Purchase Time</th>
			<th>Expiration Time</th>
			<th>Actions</th>
		</tr>


		<?php foreach ($exams as $exam): ?>

			<form action="<?php echo(base_url("admin/users/update_purchased_exam")); ?>/" method="POST">
				<tr>
					<td><?php echo($exam->id) ?></td>
					<td><?php echo($exam->exam_id) ?></td>
					<td><?php echo($exam->price) ?></td>
					<td><?php echo($exam->status) ?></td>
					<td><input type="text" name="current_question" value="<?php echo($exam->current_question) ?>" /></td>
					<td><?php echo($exam->creation_time) ?></td>
					<td><input type="text" name="expiration_date" value="<?php echo($exam->expiration_time) ?>" /></td>
					<td>
						<input type="hidden" name="user_id" value="<?php echo($user->id) ?>" />
						<input type="hidden" name="id" value="<?php echo($exam->id) ?>" />
						<input type="hidden" name="exam_id" value="<?php echo($exam->exam_id) ?>" />
						<input type="Submit" value="Save" />
					</td>
				</tr>
			</form>
		
		<?php endforeach; ?>

	</table>

<?php } // end if
else { ?>

	<p>
		This user has not purchased any exams.
	</p>

<?php } // end else ?>

<p class="back">
	Return to <strong><a href="<?php echo(base_url("admin/users/view")); ?>">View All Users</a></strong>
</p>


<h2>User Details</h2>

<form action="./update/<?php echo($user->id) ?>" action="POST">

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
			<td><?php echo($user->first_name) ?></td>
			<td><?php echo($user->last_name) ?></td>
			<td><input type="email" value="<?php echo($user->email) ?>" /></td>
			<td><input type="text" value="<?php echo($user->company) ?>" /></td>
			<td><input type="text" value="<?php echo($user->title) ?>" /></td>
			<td class="nowrap"><?php echo($user->creation_time) ?></span></td>
			<td>
				<input type="Submit" value="Save Changes" /> 
				<input type="Submit" value="Cancel" />
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
			<th>Status</th>
			<th>Last Question Answered</th>
			<th>Purchase Time</th>
			<th>Expiration Time</th>
			<th>Actions</th>
		</tr>


		<?php foreach ($exams as $exam): ?>

			<tr>
				<td><?php echo($exam->id) ?></td>
				<td><?php echo($exam->exam_id) ?></td>
				<td><?php echo($exam->status) ?></td>
				<td><input type="text" value="<?php echo($exam->current_question) ?>" /></td>
				<td><input type="text" value="<?php echo($exam->creation_time) ?>" /></td>
				<td><input type="text" value="<?php echo($exam->expiration_time) ?>" /></td>
				<td><?php echo($exam->creation_time) ?></td>
				<td>
					<input type="Submit" value="Save Changes" /> 
					<input type="Submit" value="Cancel" />
				</td>
			</tr>

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


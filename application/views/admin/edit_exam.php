<h2>Exam Details</h2>

<form action="<?php echo(base_url("admin/exams/update_exam")); ?>/" method="POST">

	<table>
		<tr>
			<th>Exam ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Last Modified</th>
			<th>Creation Time</th>
			<th>Actions</th>
		</tr>

		<tr>
			<td><?php echo($exam->id) ?></td>
			<td><input type="text" name="name" value="<?php echo($exam->name) ?>" /></td>
			<td>$<input type="text" name="price" value="<?php echo($exam->price) ?>" style="width: 4em" /></td>
			<td><?php echo($exam->modification_time) ?></td>
			<td><?php echo($exam->creation_time) ?></td>
			<td>
				<input type="hidden" name="id" value="<?php echo($exam->id) ?>" />
				<input type="Submit" value="Save" />
			</td>
		</tr>

	</table>

</form>



<h2>Categories</h2>

<?php if (count($categories) == 0) { ?>

	<p>
		This exam has no categories.
	</p>

<?php }  ?>

<table>
	<tr>
		<th>Name</th>
		<th>Actions</th>
	</tr>

	<?php if (count($categories) > 0) { ?>

		<?php foreach ($categories as $category): ?>

			<form action="<?php echo(base_url("admin/exams/update_category")); ?>/" method="POST">
				<tr>
					<td><input type="text" name="name" value="<?php echo($category->name) ?>" /></td>
					<td>
						<input type="hidden" name="id" value="<?php echo($category->id) ?>" />
						<input type="hidden" name="exam_id" value="<?php echo($category->exam_id) ?>" />
						<input type="Submit" name="update" value="Save" />
						<input type="Submit" name="delete" value="Delete" />
					</td>
				</tr>
			</form>

		<?php endforeach; ?>

	<?php } ?>



	<form action="<?php echo(base_url("admin/exams/update_category")); ?>/" method="POST">
		<tr>
			<td><input type="text" name="name" value="" placeholder="New Category" /></td>
			<td>
				<input type="hidden" name="exam_id" value="<?php echo($exam->id) ?>" />
				<input type="Submit" name="create" value="Add" />
			</td>
		</tr>
	</form>

</table>



<h2>Questions</h2>

<?php if (count($questions) > 0) { ?>

	<table>
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>


		<?php foreach ($questions as $question): ?>

			<form action="<?php echo(base_url("admin/exams/update_question")); ?>/" method="POST">
				<tr>
					<td><input type="text" name="name" value="<?php echo($question->name) ?>" /></td>
					<td>
						<input type="hidden" name="id" value="<?php echo($question->id) ?>" />
						<input type="hidden" name="exam_id" value="<?php echo($question->exam_id) ?>" />
						<input type="Submit" name="update" value="Save" />
						<input type="Submit" name="delete" value="Delete" />
					</td>
				</tr>
			</form>

		<?php endforeach; ?>

		<form action="<?php echo(base_url("admin/exams/update_question")); ?>/" method="POST">
			<tr>
				<td><input type="text" name="name" value="" placeholder="New question" /></td>
				<td>
					<input type="hidden" name="exam_id" value="<?php echo($exam->id) ?>" />
					<input type="Submit" name="create" value="Add" />
				</td>
			</tr>
		</form>

	</table>

<?php } // end if
else { ?>

	<p>
		This exam has no questions.
	</p>

<?php } // end else  ?>



<p class="back">
	Return to <strong><a href="<?php echo(base_url("admin/exams/view")); ?>">View All Exams</a></strong>
</p>


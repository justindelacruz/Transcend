<pre>
<?php print_r($subcategories); ?>
<?php print_r($questions); ?>
<?php print_r($answers); ?>
</pre>
<link type="text/css" href="<?php echo(base_url("assets/css/exam_builder.css")) ?>" rel="Stylesheet" />	
<h2>Exam Builder</h2>

<section id="builder_container">

	<header>
		<section class="left">
			<button id="add_category_button">Add Category</button>
			<button id="add_subcategory_button">Add Subcategory</button>
			<button id="add_question_button">Add Question</button>
		</section>
		<section class="right">

			<select id="categories">
				<option value="" default="default">Change Category</option>
				<option value="1">Part 1</option>
				<option value="2">Part 2</option>
				<option value="3">Part 3</option>
				<option value="4">Part 4</option>
				<option value="5">Part 5</option>
				<option value="6">Part 6</option>
			</select>

			<button id="save_button">Save</button>
		</section>
		<br style="clear: both" />
	</header>

	<section>

		<div id="module_container">

		</div>
		
		<div id="debug"></div>

		<div id="module_templates">
			
			<section class="module category">
				<input class="name" type="input" placeholder="Untitled Category"/><br />
				<textarea class="description" rows="6" cols="50" placeholder="You can include any text or info that will help people fill this out."></textarea>
			</section>
			
			<section class="module subcategory">
				<div class="tools hide right">
					<button class="trash_button">Delete</button>
				</div>
				<input class="name" type="input" placeholder="Untitled Subcategory"/><br />
				<textarea class="description" "rows="4" cols="50" placeholder="You can include any text or info that will help people fill this out."></textarea>
			</section>
			
			<section class="module question">
				<div class="tools hide right">
					<button class="trash_button">Delete</button>
				</div>
				<table width="100%">
					<tbody>
						<tr class="question">
							<th>Question</th>
							<td><textarea placeholder="Untitled question"></textarea></td>
						</tr>
						<tr class="answers">
							<th>Answers</th>
							<td>
								<div class="inline-block answer correct"><input type="text" placeholder="Correct answer" /></div>
								<div class="inline-block answer incorrect"><input type="text" placeholder="Incorrect option" /><button class="delete_button">Delete</button></div>
								<div class="inline-block answer ghost"><input type="text" placeholder="Click to add option" /></div>
							</td>
						</tr>
					</tbody>
				</table>
			</section>

			<div id="dialog-confirm" title="Really delete this item?">
				<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This module will be deleted and cannot be recovered. Are you sure?</p>
			</div>
		</div>
	</section>

</section>

<form action="<?php echo(base_url("admin/exams/build_exam")); ?>/" method="POST">




</form>


<script src="<?php echo(base_url("assets/js/jquery-1.6.4.min.js")); ?>"></script>
<script src="<?php echo(base_url("assets/js/jquery-ui-1.8.16.custom.min.js")); ?>"></script>
<script src="<?php echo(base_url("assets/modules/modules.js")); ?>"></script>
<script>
var getSubcategories = function() {
	return jQuery.parseJSON('<?php echo addslashes(json_encode($subcategories)); ?>');
};
var getQuestions = function() {
	return jQuery.parseJSON('<?php echo addslashes(json_encode($questions)); ?>');
};
var getAnswers = function() {
	return jQuery.parseJSON('<?php echo addslashes(json_encode($answers)); ?>');
};
</script>
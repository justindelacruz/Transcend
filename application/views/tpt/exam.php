<h1 id="mainHead"><?php echo($exam->name) ?></h1>
<span class="ribbon"></span>

<h1>Section <?php echo(($category->category_id)+1) ?>: <?php echo($category->name) ?></h1>

<h1>Part <?php echo($subcategory->subcategory_id) ?>: <?php echo($subcategory->name) ?></h1>

<p>
	<?php echo($subcategory->description) ?>
</p>

<form action="<?php echo base_url("tpt/exam/next") ?>" method="post">

<ol>
	<?php foreach ($questions as $question): ?>
	<li class="clear">
		<div class="image right"><img src="<?php echo(base_url("assets/exam/0.gif")) ?>" alt=""></div>
		<div class="question"><?php echo($question->question) ?></div>
		<ol class="answers">
		<?php foreach ($answers[$question->question_id] as $answer): ?>	
	
			<li><input type="radio" name="exam[<?php echo $question->question_id ?>]" id="exam-<?php echo $question->question_id ?>-<?php echo $answer->answer_id ?>"value="<?php echo $answer->answer_id ?>" /> <label for="exam-<?php echo $question->question_id ?>-<?php echo $answer->answer_id ?>"><?php echo($answer->answer) ?></label></li>
			
		<?php endforeach;?>
		</ol>
	</li>	
	<?php endforeach;?>
</ol>

<p class="clear">
	<input type="hidden" name="progress[exam_id]" value="<?php echo $exam->exam_id ?>" />
	<input type="hidden" name="progress[category_id]" value="<?php echo $category->category_id ?>" />
	<input type="hidden" name="progress[subcategory_id]" value="<?php echo $subcategory->subcategory_id ?>" />
	<input type="submit" value="Complete Exam" />
</p>
</form>
$(document).ready(function() {
	
	var MODULE_CONTAINER = '#module_container';
	var activeModule = null;
	
	$("button").button();
		
	$(".delete_button").button({
		icons: {
			primary: "ui-icon-close"
		},
		text: false
	});
	
	$(".trash_button").button({
		icons: {
			primary: "ui-icon-trash"
		},
		text: false
	});
		
	/* Container */
	$("#module_container").sortable();
	$(".module").draggable({
		axis: 'y',
		containment: '#module_container'
	});
		

	/* Header */
	$("#add_category_button, #add_subcategory_button, #add_question_button").button({
		icons: {
			primary: 'ui-icon-plusthick'
		}
	});
	
	$("#save").click(function() {
		return false;
	});
	
	$("#add_category_button").click(function() {
		alert("Sorry, this demo only allows one category. In the future, you will be able to create and manage multiple categories.");
	});
	
	$("#categories").select(function() {
	});
	
	
	$("#add_subcategory_button").click(function() {
		if(activeModule === null) {
			$("#module_templates > .subcategory").clone().appendTo(MODULE_CONTAINER);	
		} else {
			$("#module_templates > .subcategory").clone().insertAfter(activeModule);
		}
	});

	$("#add_question_button").click(function() {
		if(activeModule === null) {
			$("#module_templates > .question").clone().appendTo(MODULE_CONTAINER);	
		} else {
			$("#module_templates > .question").clone().insertAfter(activeModule);
		}
	});
	
	$("#save_button").click(function() {
		save_exam();
	});

	
	/* Modules */
	
	// Delete module
	$('.module .tools .trash_button').live('click',function() {
		var element = $(this).parent().parent();
		_deleteDialog(element);
	})
	
	
	/* Active */
	$(".module").live('click', function() {
		$(".module").removeClass("active");
		$(this).addClass("active");
		
		activeModule = $(this);
	});
	
	
	/*
	 * Subcategory
	 */
	$('.module').live('mouseover', function() {
		$(this).find('.tools').removeClass('hide');
	});
	
	$('.module').live('mouseout', function() {
		$(this).find('.tools').addClass('hide');
	});
	
	
	
	/* 
	 * Question
	 */

	// Clone new incorrect question
	$(".module.question .answer.ghost").live('focusin', function() {
		$("#module_templates .module.question .answer.incorrect").clone().insertAfter($(this).prev());
	});
	
	// Delete incorrect question
	$(".module.question .answer .delete_button").live('click', function() {
		$(this).parent().remove();
	});
	
	/*
	* Loading
	*/
	var load_subcategories = (function(sc) {
		var subcategories = getSubcategories();
		var questions = getQuestions();
		var answers = getAnswers();
		
		$.each(subcategories, function(sc_k,sc) {
			
			// subcategory 0 = don't show
			if(sc['subcategory_id'] != 0) {
				var subcategoryModule = $("#module_templates > .subcategory").clone();
				$(subcategoryModule).find('.name').val(sc['name']);
				$(subcategoryModule).find('.description').val(sc['description']);
				
				if(activeModule === null) {
					$(subcategoryModule).appendTo(MODULE_CONTAINER);	
				} else {
					$(subcategoryModule).insertAfter(activeModule);
				}
			}
			
			$.each(questions, function(q_k, q) {
				
				var questionId = q['exam_id'] + '-' + q['category_id'] + '-' + q['subcategory_id'] + '-' + q['question_id'];
				
				if( sc['exam_id'] == q['exam_id'] && 
					sc['category_id'] == q['category_id'] &&
					sc['subcategory_id'] == q['subcategory_id']
					) {
					// Add question
					var questionModule = $("#module_templates > .question").clone();
					$(questionModule).attr('id',questionId);
					$(questionModule).find('textarea').val(q['question']);
					
					if(activeModule === null) {
						$(questionModule).appendTo(MODULE_CONTAINER);	
					} else {
						$(questionModule).insertAfter(activeModule);
					};

					$.each(answers, function(a_k, a) {
						// Add answer
						if( q['exam_id'] == a['exam_id'] && 
							q['category_id'] == a['category_id'] &&
							q['subcategory_id'] == a['subcategory_id'] &&
							q['question_id'] == a['question_id']
							) {
							// index 0 = correct answer
							if(a['answer_id'] == 0) {
								$("#" + questionId + " .answers .correct input").val(a['answer']);
							} 
							// incorrect answer
							else {
								var answerField = $("#module_templates > .question .answers .incorrect").clone();
								$(answerField).find('input').val(a['answer']);
								$("#" + questionId + " .answers .incorrect:last").before(answerField);
							}
						}
					});
				}
			});
		});
	})();
	
	/* 
	* Saving 
	*/
	var save_exam = function() {
		// Disable elements
		$("#module_container *").css("opacity","0.75");
		$("input, textarea").attr('disabled','disabled');
		
		var exam_json = _buildExam();
		
		$.ajax({
			url: "/transcend/admin/exams/build/",
			type: 'POST',
			data: {
				data: exam_json
			},
			error: function() {
				// Re-enable
				alert('error');
				$("#module_container *").css("opacity","1");
				$("input, textarea").removeAttr('disabled');
			},
			success: function(){
				// Re-enable
				alert('saved!');
				$("#module_container *").css("opacity","1");
				$("input, textarea").removeAttr('disabled');
			}
		});	
	}
	
	var _buildExam = function() {
		var subcategoryCtr = 0;
		var questionCtr = 0;
		var answerCtr = 0;
		
		/*
		* Exam structure
		* 
		* exam {
		*	subcategory 0 (no category) :
		*		name
		*		desc
		*		questions
		*			question 1
		*				question
		*				answers
		*					answer 1
		*						answer
		*					answer 2
		*						answer
		*			question 2
		*				question
		*				answers
		*					answer 1 (correct)
		*						answer
		*					answer 2
		*						answer
		*					answer 3
		*						answer
		*	subcategory 1
		*		...
		*/
		var exam = {};
		exam[0] = {};
		exam[0]['name'] = '';
		exam[0]['description'] = '';
		exam[0]['questions'] = {};
		
		var question, answer, subcategoryName, subcategoryDescription;
		
		// Walk-through
		$("#module_container").find(".module").each(function() {
			var module =  $(this);
			var type = module.attr('class');
			
			// Find questions
			if(type.indexOf('question') != -1) {
				question = $(this).find('textarea').val();
				
				exam[subcategoryCtr]['questions'][questionCtr] = {};
				exam[subcategoryCtr]['questions'][questionCtr]['question'] = question;
				exam[subcategoryCtr]['questions'][questionCtr]['answers'] = {};

				// Find answers
				answerCtr = 0;
				$(this).find('.answers .answer').not('.ghost').each(function() {
					answer = $(this).find('input').val();
					if(answer !== '') {
						exam[subcategoryCtr]['questions'][questionCtr]['answers'][answerCtr] = answer;
						answerCtr++;
					}
				});
				
				questionCtr++;
			}
			// Subcategory
			else if(type.indexOf('subcategory') != -1) {
				subcategoryCtr++;
				
				subcategoryName = $(this).find('.name').val();
				subcategoryDescription = $(this).find('.description').val();
				
				exam[subcategoryCtr] = {};
				exam[subcategoryCtr]['name'] = subcategoryName;
				exam[subcategoryCtr]['description'] = subcategoryDescription;
				exam[subcategoryCtr]['questions'] = {};
				
			}
		});
		
		return JSON.stringify(exam);
	}
	
	/*
	* Helpers
	*/
	var _deleteDialog = function(element) {
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"Delete module": function() {
					element.remove();
					activeModule = null;
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	}
});
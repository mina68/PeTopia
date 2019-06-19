var medical_histories_count = 1;

var originPath = $('meta[name="http-root"]').attr('content');

$(function(){

	// Add new medical history from Template

	$('#add_new_medical_history').click(function(){
	  var template = $('#medical_history_template').html();
	  // Compile the template data into a function
	  var templateScript = Handlebars.compile(template);
	  var context = { "index" : medical_histories_count };
	  var html = templateScript(context);

	  medical_histories_count ++;

	  //Add new record
	  $('#medical_histories').append(html);
	})


	// delete medical history
	$(document).on('click', '.delete_medical_history', function(){
		let deleteButton = $(this)
		bootbox.confirm({
			title  : "<div class='text-center'>Deletetion Confirmation</div>",
			message: "<div class='confirmation-text-float-left'>Are you sure you want to delete ?</div>",
			buttons: {
				cancel: {
					label: '<i class="fa fa-times"></i> Cancel'
				},
				confirm: {
					label    : '<i class="fa fa-check"></i> Confirm',
					className: "btn-danger"
				}
			},
			callback: function(result) {
			  	deleteButton.closest('.medical_history_record').detach();
			}
		})

	});

	// edited medical history flag
	$(document).on('change', '.medical_history_record input, .medical_history_record select', function(){
	    $(this).closest('.medical_history_record').find('.changed').val(1);
	})
})
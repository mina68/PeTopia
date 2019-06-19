$(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var originPath = $('meta[name="http-root"]').attr('content');

	$('body').on('submit', 'form.ajax', function(e) {
		e.preventDefault();
		var form    = $(this);
		var formUrl = form.attr('action');

		var formInputs = $(form.find(':input.form-data'));

		var formData = new FormData();

		formInputs.each(function(index, el) {
			var formInput = $(el);

			if (formInput.attr('type') == 'file' && formInput.attr('name').indexOf('[]') >= 0 ) {
				if (formInput[0].files[0]) {
					for (var i = 0; i < formInput[0].files.length; i++) {
						formData.append(formInput.attr('name'),formInput[0].files[i]);
					}
				}
				else{
					formData.append(formInput.attr('name'),formInput.val());
				}
			}
			else if(formInput.attr('type') == 'file'){
				if (formInput.val()) {
					formData.append(formInput.attr('name'),formInput[0].files[0]);
				}
			}
			else if(formInput[0].type == 'select-multiple'){
				if (formInput.val()) {
					for (var i = 0; i < formInput.val().length; i++) {
						formData.append(formInput.attr('name'),formInput.val()[i]);
					}
				}
			}else if(formInput[0].type == 'radio' || formInput[0].type == 'checkbox' ){
				if (formInput.is(':checked')) {
					formData.append(formInput.attr('name'),formInput.val());
				}
			}else{
				formData.append(formInput.attr('name'),formInput.val());
			}
		});


		if ( form.find('input[name="_method"]').length ) {
			formData.append( '_method', form.find('input[name="_method"]').val() );
		}

		if ( form.find('input[name="_token"]').length ) {
			formData.append( '_token', form.find('input[name="_token"]').val() );
		}

		$('.flash-messages').remove();
		$('#ajax-messages').html('');
		$('.validation-error-label').remove();
		$('.val-error').remove();
		$.ajax({
			method: 'POST',
			url: formUrl,
			data: formData,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: function (response) {

				if (response.requestStatus) {

					// create forms.

					form.trigger("reset");
					form.find('select').val('').trigger('change');

					if (response.redirect != undefined) {
						window.location =  response.redirect;
					}else{

						$('#ajax-messages').html("<div class='alert alert-success alert-styled-left alert-arrow-left alert-bordered'><button type='button' class='close' data-dismiss='alert'><span>×</span><span class='sr-only'>إغلاق</span></button><p>" + response.message + "</p></div>");
						$("html, body").animate({ scrollTop: 0 }, "slow");
					}

					if ( form.find('input[type="file"]').length) {

						form.find('input[type="file"]').val('');

						var fileInputs = form.find('input[type="file"]').parents('.media-body').find('span.filename');
						for (var i = 0; i < fileInputs.length; i++) {
							form.find('input[type="file"]').parents('.media-body').find('span.filename')[i].innerHTML = "No file selected";
						}
					}
				}else{
					new PNotify({
						type    : 'error',
						title   : response.message,
					});
				}


			},
			error: function (data) {

				if (data.status == 422) { //validation errors
					handle_validation_errors(data,form);

				}else if(data.status == 500){ //server error
					new PNotify({
						type    : 'error',
						title   : 'Some error happened',
					});
				}
			},
			complete : function(data) {
				if (data.requestStatus != undefined) {
					if (data.requestStatus.csrfToken == undefined) {
						refresh_csrf_meta();
					}
				}
			}
		});

		return false;
	});


	$(document).on("click",".delete-action",function() {
		var clickedBtn = $(this);
		var datatable  = clickedBtn.parents('table').dataTable();
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
				if (result) {
					$.ajax({
						url: clickedBtn.attr("data-url"),
						method : "POST",
						data   :{"_method" : "DELETE"},
						success: function(responseData) {

							if (responseData.deleteStatus) {

								var clickedTr = clickedBtn.parents('tr');
								clickedTr.fadeOut('slow', function() {
									datatable.fnDeleteRow($(this)); //this for clickedTr
								});

							}else{

								var errorMsg = responseData.error;
								bootbox.alert({
									size   : "small",
									title  : "<p class='text-danger'>Error</p>",
									message:errorMsg,
									buttons: {
										ok: {
											label: '<i class="fa fa-check"></i> cancel',
										}
									}
								});

							}
						},
						complete : function(data) {

							/**** callback****/

							if (data.requestStatus != undefined) {
								if (data.requestStatus.csrfToken == undefined) {
									refresh_csrf_meta();
								}
							}

							/**** callback****/
						}
					});
				}
			}
		});

		return false;
	});


	$(document).on("click",".show-action, .hide-action",function() {
		var clickedBtn = $(this);
		clickedBtn.attr('disabled', 'disabled');
		var action = clickedBtn.attr("title");
		var visibilityBadge  = clickedBtn.parents('tr').find('.visibility-status');
		$.ajax({
			url: clickedBtn.attr("data-url"),
			method : "get",
			success: function(responseData) {

				if (responseData.showStatus || responseData.hideStatus) {
					visibilityBadge.toggleClass('badge-success').toggleClass('badge-warning')
					if(action == 'show'){
						visibilityBadge.text('Visible')
						visibilityBadge.removeClass('badge-warning')
						visibilityBadge.addClass('badge-success')
						clickedBtn.find('i').removeClass('fa-eye')
						clickedBtn.find('i').addClass('fa-eye-slash')
						clickedBtn.attr('title', 'hide').attr('data-original-title', 'show')
						clickedBtn.attr('data-url', clickedBtn.attr('data-url').replace('show', 'hide'))
					}
					else{
						visibilityBadge.text('Hidden')
						visibilityBadge.removeClass('badge-success')
						visibilityBadge.addClass('badge-warning')
						clickedBtn.find('i').removeClass('fa-eye-slash')
						clickedBtn.find('i').addClass('fa-eye')
						clickedBtn.attr('title', 'show').attr('data-original-title', 'show')
						clickedBtn.attr('data-url', clickedBtn.attr('data-url').replace('hide', 'show'))
					}
				}
				else{
					var errorMsg = responseData.error;
					bootbox.alert({
						size   : "small",
						title  : "<p class='text-danger'>Error</p>",
						message:errorMsg,
						buttons: {
							ok: {
								label: '<i class="fa fa-check"></i> cancel',
							}
						}
					});

				}
			},
			complete : function(data) {

				/**** callback****/

				if (data.requestStatus != undefined) {
					if (data.requestStatus.csrfToken == undefined) {
						refresh_csrf_meta();
					}
				}
				clickedBtn.removeAttr('disabled')

				/**** callback****/
			}
		});

		return false;
	});


	// logout form submit
	$( ".panel-logout" ).click(function() {
	    $('.panel-logout-submit').trigger('submit');
	    return false;
    });
})

function handle_validation_errors(data,form = null) {

	new PNotify({
		type    : 'error',
		title   : 'Please check your inputs!',
	});

	var errors = data.responseJSON.errors;
	$.each( errors, function( key, value ) {
		var input = $(':input[name="'+key+'"]');
		if(input.length == 0) input = $('select[name="'+key+'"]'); // for select

		if(input.length == 0 && key.indexOf(".") != -1 ){ // for multiple inputs nested names
			var nestedNames = key.split(".");

			for (var i = 0; i < nestedNames.length; i++) {
				if (i != 0) {	
					if(Number.isInteger(Number(nestedNames[i])))
						inputName += '[]';
					else	
						inputName += '['+nestedNames[i]+']';
				}
				else{
					inputName += nestedNames[i];
				}
			}
			input = $(':input[name="'+inputName+'"]');
			if(input.length == 0) input = $('select[name="' + inputName + '"]');

			if(input.length == 0){
				var inputName   = '';
				for (var i = 0; i < nestedNames.length; i++) {
					if (i != 0) {	
						inputName += '['+nestedNames[i]+']';
					}
					else{
						inputName += nestedNames[i];
					}
				}
				input = $(':input[name="'+inputName+'"]');
				if(input.length == 0) input = $('select[name="' + inputName + '"]');
			}
		}

		if (input.length) {
			if(input.parents('.form-group').find('.validation-error-label').length == 0)
				input.parents('.form-group').append("<p class='validation-error-label'>:"+value[0]+"</p>");
		}
	});
}

function refresh_csrf_meta() {
	$.ajax({
		type:'POST',
		url: originPath + '/dashboard/refreshCsrfAjax',
		success: function(response){
			if (response.requestStatus) {
				$('meta[name="csrf-token"]').attr('content', response.csrfToken);
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': response.csrfToken
					}
				});
			}
		},
	});
}


function previewImage(input) {
  var div = document.getElementById('images_preview');
  div.innerHTML="";
  if (input.files && input.files[0]) {
    for(var i = 0; i < input.files.length; i++){

      var reader = new FileReader();
      reader.onload = function (e) {
        div.innerHTML += '<div class="attach_img"><img class="img-thumbnail" src="' + e.target.result +'" /></div>' ;
      }
      reader.readAsDataURL(input.files[i]);
    }
  } 
  else {
    preview.setAttribute('src', 'placeholder.png');
  }
}

$('.attach_img').on('click', 'button', function(){
  if(ConfirmDelete())
    $(this).parents('.attach_img').remove();
})

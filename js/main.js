$ = jQuery;
function initSimpleNewsletter(element)
{
	$(function() {
		jQuery(element).submit(function( event ) {
			jQuery(".simplenewsletter-success").hide();
			event.preventDefault();
			_this= this;

			loading(_this ,1);

			var posting = jQuery.post( '', jQuery(this).serialize() );
			posting.done(function(e){
				e = jQuery.parseJSON(e);
				if(e.success == '1'){
					message = '<div class="simplenewsletter-success">Obrigado por se cadastrar</div>';
					showSucess(_this,message);
				}else{
					jQuery("fieldset.simplenewsleter-field span").remove();
					jQuery.each(e.message,function(field, error) {
						jQuery(element).find(".simplenewsleter-field-"+field).append('<span class="error">'+error+'</span>');
					});

				}
				loading(_this,0);
			});
		});
	});
}

function showSucess(element, message)
{
	var showon = jQuery(element).parent().data('showon');
	jQuery(element).find('.error').remove();

	switch(showon){
		case 'append':
			jQuery(element).parent().append(message);
			return 0;
		break;

		case 'prepend':
			jQuery(element).parent().prepend(message);
			return 0;
		break;

		case 'substitute':
		default:
			jQuery(element).parent().html(message);
			return 0;
		break;
	}
	
}

function loading(element, method)
{
	if(method == 0)
	{
		jQuery(element).show();
		jQuery(element).parent().find('.simplenewsletter_spinner').hide();
		return 0;
	}
	
	jQuery(element).hide();
	jQuery(element).parent().find('.simplenewsletter_spinner').show();
	return 0;

}
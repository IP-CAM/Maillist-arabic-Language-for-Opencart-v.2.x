<div class="mail col-md-12 col-sm-12 col-xs-12">
    <h3><?php echo $heading_title ?></h3>
    <div class="container">
        <div id="response-loading"></div>
        <div class="clearfix"></div>
    </div>
    <!-- <input type="text" class="inpt wow slideInDown" name="name" id="name" placeholder="<?php echo $entry_name ?>" /> -->
    <input type="text" class="inpt wow slideInDown" name="email" id="email" placeholder="<?php echo $entry_email ?>" />
    <button class="button button--ujarak button--text-thick submit wow slideInDown" id="submitNewsletter" type="button">
        <?php echo $button_submit ?>
    </button>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//clear inputs
		$('#name').click(function(){
			if($(this).val() == '<?php echo $entry_name; ?>') {
				$(this).attr('value','');
			}
		});
		$('#email').click(function(){
			if($(this).val() == '<?php echo $entry_email ?>') {
				$(this).attr('value','');
			}
		});
		
		//save data
		$('#submitNewsletter').click(function(){
			//validate form
			errors = 0;
			if(($('#name').val() == '') || ($('#name').val() == '<?php echo $entry_name; ?>')) {
				//$('#name').css('border','solid red 1px');
				//errors++;
			} else {
				//$('#name').css('border','0px');
			}
			if(($('#email').val() == '') || ($('#email').val() == '<?php echo $entry_email ?>')) {
				$('#email').css('border','solid red 1px');
				errors++;
			} else {
				$('#email').css('border','0px');
			}
			//submit data
			if(errors == 0) {
				$.ajax({
					url: 'index.php?route=module/rfnewsletter/save',
					type: 'POST',
			        //dataType: 'json',
					data: { 
						//name: $('#name').val(),
						email: $('#email').val()
						},
				    beforeSend: function() {
			            $('.success, .warning').remove();
			            $('#response-loading').html('<div class="attention"> ..... </div>');
			        },
			        complete: function() {
			            $('#button-review').attr('disabled', false);
			            $('.attention').remove();
			        },
			        success: function(respons) {
				    	if(respons){
                			$('#response-loading').html('<div class="alert alert-success"><?php echo $text_success ?></div>');
			            }else{
			                $('#response-loading').html('<div class="alert alert-danger"><?php echo $error_email ?></div>');
                		}
				    }
				});
			}
		});
	});
</script>
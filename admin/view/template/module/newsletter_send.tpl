<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a id="button-send" onclick="/*$('#mail_form').submit();*/send('index.php?route=module/rfnewsletter/send&token=<?php echo $token; ?>');" class="btn btn-primary">
                    <?php echo $button_send; ?>
                </a>
                <a onclick="location = '<?php echo $cancel; ?>';" class="btn btn-default">
                    <?php echo $button_cancel; ?>
                </a>
            </div>
            <h1>
                <?php echo $heading_title; ?>
            </h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li>
                    <a href="<?php echo $breadcrumb['href']; ?>">
                        <?php echo $breadcrumb['text']; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil">
                    </i>
                </h3>
            </div>
            <div class="panel-body">
                <div class="box">
                    <div class="response"></div>
                    <form method="post" id="mail_form">
                        <table class="table table-stripped" id="mail">
                            <tr>
                                <td>
                                    <span class="required">
                                        *
                                    </span>
                                    <?php echo $entry_subject; ?>
                                </td>
                                <td>
                                    <input type="text" name="subject" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="required">
                                        *
                                    </span>
                                    <?php echo $entry_message; ?>
                                </td>
                                <td>
                                    <textarea name="message">
                                    </textarea>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
$('textarea[name=\'message\']').summernote({
	height: 300
});
//--></script> 
<script type="text/javascript"><!--	

function send(url) { 
	$('textarea[name=\'message\']').html($('textarea[name=\'message\']').val());
	// alert($('textarea[name=\'message\']').val());
	$.ajax({
		url: url,
		type: 'post',
		data: $('input, textarea'),		
		dataType: 'json',
		beforeSend: function() {
			$('#button-send').attr('disabled', true);
			$('#button-send').before('<span class="wait"><img src="view/image/loading.gif" alt="" />&nbsp;</span>');
		},
		complete: function() {
			$('#button-send').attr('disabled', false);
			$('.wait').remove();
		},				
		success: function(json) {
			$('.success, .warning, .error').remove();
			
			if (json['error']) {
				if (json['error']['warning']) {
					$('.response').html('<div class="alert alert-danger" style="display: none;"><i class="fa fa-exclamation-circle"></i>' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert"></button></div>');
			
					$('.warning').fadeIn('slow');
				}
				
				if (json['error']['subject']) {
					$('input[name=\'subject\']').after('<span class="error">' + json['error']['subject'] + '</span>');
				}	
				
				if (json['error']['message']) {
					$('textarea[name=\'message\']').parent().append('<span class="error">' + json['error']['message'] + '</span>');
				}									
			}			
			
			if (json['next']) {
				if (json['success']) {
					//$('.response').html('<div class="success">' + json['success'] + '</div>');
					
					send(json['next']);
				}		
			} else {
									
			}
			if (json['success']) {
				$('.response').html('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i>' + json['success'] + '<button type="button" class="close" data-dismiss="alert"></button></div>');
		
				$('.success').fadeIn('slow');
			}				
		}
	});
}
//--></script> 
<?php echo $footer; ?>

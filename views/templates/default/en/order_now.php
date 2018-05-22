	<script type="text/javascript">	
		$(document).ready(function() {		
						
			$("#submit_contact").click(function() {
				$(".redBorders").removeClass("redBorders");
				var message_error = "";			
				
				if($("#product_no").val() == '')
				{
					$("#product_no").addClass('redBorders');
					message_error += '&#x2718; The Model field is required.<br/>';						
				}				
				if($("#first_name").val() == '')
				{
					$("#first_name").addClass('redBorders');
					message_error += '&#x2718; The First name field is required.<br/>';						
				}
				if($("#last_name").val() == '')
				{
					$("#last_name").addClass('redBorders');
					message_error += '&#x2718; The Last name field is required.<br/>';						
				}
				if($("#email").val() == '')
				{
					$("#email").addClass('redBorders');
					message_error += '&#x2718; The Email field is required.<br/>';						
				}
				else
				{
					var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,9}$','i');
					if(!regEmail.test($("#email").val()))
					{
						$("#email").addClass('redBorders');
						message_error += '&#x2718; The Email field must contain a valid email address.<br/>';									
					}
				}
				if($("#phone").val() == '')
				{
					$("#phone").addClass('redBorders');
					message_error += '&#x2718; The Phone field is required.<br/>';						
				}
				else
				{
					var regPhone = new RegExp('^(\([0-9]{3}\) [0-9]{3}( |-)[0-9]{4}|^[0-9]{3}( |-)[0-9]{3}( |-)[0-9]{4})( ?x[0-9]{1,5})?$','i');
					if(!regPhone.test($("#phone").val()))
					{
						$("#phone").addClass('redBorders');
						message_error += '&#x2718; The Phone field must be in the format 123 456-7890 x123.<br/>';									
					}
				}
				
				if($("#message").val() == '')
				{
					$("#message").addClass('redBorders');
					message_error += '&#x2718; The Additionnal informations field is required.<br/>';						
				}
				if(message_error != "")
				{	
					$("#message_contact").html('<div class="message_error">' + message_error + '</div>');
					$('html, body').animate({scrollTop:$('#form_contact').offset().top}, 'fast'); 	
					return false;
				}
				else
				{	
					$.ajax({
						'type': "POST",					
						'url': document.URL,						
						'data' : {
							product_no : $("#product_no").val(),	
							first_name : $("#first_name").val(),
							last_name : $("#last_name").val(),	
							email : $("#email").val(),
							phone : $("#phone").val(),	
							message : $("#message").val()
						},
						'success': function(message){							
							$("#message_contact").html(message);
							$('html, body').animate({scrollTop:$('#form_contact').offset().top}, 'fast'); 
							if(message.indexOf("message_success") >= 0)
							{
								$("input:not(#product_no)").val('');
								$("textarea").val('');	
							}							
						}					
					});
				}			
			});
		});
	</script>
	<div id="contact">
		<div class="contact_bg">
		</div>
		<div class="wrap nopadding">
			<div class="left">
				<div class="title" style="margin:0 0 5px 0;">Lambertson</div>
				<div class="address">
					Toll-Free Canada / U.S. : 1 800 548-3324<br/>
					Phone : 775 857-1100<br/>
					Fax : 775 857-3289<br/>
					<div style="padding-top:10px;">
						1335 Alexandria Court<br/>
						Sparks, NV 89434.
					</div>
				</div>
				<div class="text"><?=utf8_decode($page['content_en'])?></div>
			</div>
			<div class="right_bg"></div>
			<div class="right">		
				<div id="form_contact">
					<div class="title" style="margin-top:0;">Order now</div>
					<div>* Required fields</div>					
					<div id="message_contact"></div>
					<label for="product_no">Model *</label>
					<input type="text" name="product_no" id="product_no" value="<?=$product[0]->product_no?>" disabled/><br/>
					<label for="first_name">First name *</label>
					<input type="text" name="first_name" id="first_name"/><br/>
					<label for="last_name">Last name *</label>
					<input type="text" name="last_name" id="last_name"/><br/>
					<label for="email">Email *</label>
					<input type="text" name="email" id="email"/><br/>	
					<label for="phone">Phone *</label>
					<input type="text" name="phone" id="phone"/><br/>
					<label for="message">Additional informations</label>			
					<textarea name="message" id="message"></textarea>									
					<div style="text-align:right;"><a href="javascript:;" class="btn" id="submit_contact">Submit my order</a></div>
				</div>
			</div>	
			<div class="clear"></div>
		</div>
	</div>
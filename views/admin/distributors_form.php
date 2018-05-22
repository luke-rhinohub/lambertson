		</div>
		 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=fr"></script>
		<script type="text/javascript">	
			// Displays an address form, using the autocomplete feature
			// of the Google Places API to help users fill in the information.
			var placeSearch, autocomplete;
			var componentForm = {	
			  locality: 'long_name',
			  administrative_area_level_1: 'short_name',
			  country: 'long_name',
			  postal_code: 'short_name'
			};

			function initialize() {			
				autocomplete = new google.maps.places.Autocomplete(
				  /** @type {HTMLInputElement} */(document.getElementById('autocomplete')));
				google.maps.event.addListener(autocomplete, 'place_changed', function() {
				fillInAddress();
			  });
			}
			
			function fillInAddress() {
				// Get the place details from the autocomplete object.
				var place = autocomplete.getPlace();console.log(place);

				var address = '';
				for (var i = 0; i < place.address_components.length; i++) 
				{
					var addressType = place.address_components[i].types[0];
					if(addressType == 'street_number' || addressType == 'route')
					{
						if(address != '')
							address += ' ';
						address += place.address_components[i]['long_name'];
					}
					else if(addressType == 'locality')
						document.getElementById('distributor_city').value = place.address_components[i]['long_name'];
					else if(addressType == 'administrative_area_level_3')
						document.getElementById('distributor_city').value = place.address_components[i]['long_name'];
					else if(addressType == 'administrative_area_level_1')
						document.getElementById('distributor_province').value = place.address_components[i]['short_name'];
					else if(addressType == 'country')
						document.getElementById('distributor_country').value = place.address_components[i]['long_name'];
					else if(addressType == 'postal_code')
						document.getElementById('distributor_postal_code').value = place.address_components[i]['short_name'];							
				}
				document.getElementById('distributor_name').value = place.name;
				document.getElementById('distributor_address').value = address;
				if(place.formatted_phone_number)
					document.getElementById('distributor_phone').value = place.formatted_phone_number;
				//document.getElementById("distributor_lat").value = place.geometry['location']['k'];
				//document.getElementById("distributor_lng").value = place.geometry['location']['B'];
			}			
								
			google.maps.event.addDomListener(window, 'load', initialize);
			
			$(document).ready(function() {		
				$("#distributor_form").submit(function() {
					$("#message_error_en").hide();
					$("#message_error").hide();
					var message_error = "";
					if($("#distributor_name").val() == '')		
						message_error += '&#x2718; Le champ Nom est requis.<br/>';	
					if($("#distributor_address").val() == '')		
						message_error += '&#x2718; Le champ Adresse est requis.<br/>';	
					if($("#distributor_city").val() == '')					
						message_error += '&#x2718; Le champ Ville est requis.<br/>';
					if($("#distributor_country").val() == '')		
						message_error += '&#x2718; Le champ Pays est requis.<br/>';	
					if($("#distributor_phone").val() == '')					
						message_error += '&#x2718; Le champ Téléphone est requis.<br/>';
					
					if(message_error != "")
					{	
						$("#message_error").show();
						$("#message_error").html(message_error);						
						window.scrollTo(0, 0);
						event.preventDefault();
					}				
				});
			});
		</script>
		<style>
			.error
			{
				color:red;
				padding:10px 0;
				display:none;
			}
			.error p
			{
				margin:0;
			}
			label
			{
				display:inline-block;
				width:150px;
			}
			input
			{
				width:400px;
			}
		 </style>
		<div id="contentfull">					
			<h2 id="Intro"><?if(!$distributor_id){?>Créer un distributeur<?}else{?>Éditer un distributeur<?}?></h2><br/>	
			<?if($distributor_id){?>
				<?=form_open('admin/distributors/form/distributor_id/'.$distributor_id, array('id' => 'distributor_form'));?>
			<?}else{?>
				<?=form_open('admin/distributors/form', array('id' => 'distributor_form'));?>
			<?}?>
				<?if($error_en):?>
					<div id="message_error_en" style="color:red;padding:10px 0;"><?=$error_en?></div>
				<?endif;?>		
				<?=$this->validation->error_string;?>	
				<div class="error" id="message_error"></div>
				<label>Emplacement : </label><input id="autocomplete" placeholder="Entrez l'adresse" type="text" class="styled"></input>				
				<div style="padding:5px 0;">----</div>
				<label>Nom :</label><input type="text" class="styled" name="distributor_name" id="distributor_name" value="<?=$this->validation->distributor_name;?>"/><br/>
				<input type="hidden" name="distributor_name_en" id="distributor_name_en" value="<?=$this->validation->distributor_name_en;?>"/>				
				<label>Adresse :</label><input type="text" class="styled" name="distributor_address" id="distributor_address" value="<?=$this->validation->distributor_address;?>"/><br/>	
				<input type="hidden" name="distributor_address_en" id="distributor_address_en" value="<?=$this->validation->distributor_address_en;?>"/>	
				<label>Ville :</label><input type="text" class="styled" name="distributor_city" id="distributor_city" value="<?=$this->validation->distributor_city;?>"/><br/>	
				<input type="hidden" name="distributor_city_en" id="distributor_city_en" value="<?=$this->validation->distributor_city_en;?>"/>
				<label>Province / État :</label><input type="text" class="styled" name="distributor_province" id="distributor_province" value="<?=$this->validation->distributor_province;?>"/><br/>	
				<label>Pays :</label><input type="text" class="styled" name="distributor_country" id="distributor_country" value="<?=$this->validation->distributor_country;?>"/><br/>	
				<input type="hidden" name="distributor_country_en" id="distributor_country_en" value="<?=$this->validation->distributor_country_en;?>"/>
				<label>Code postal / ZIP :</label><input type="text" class="styled" name="distributor_postal_code" id="distributor_postal_code" value="<?=$this->validation->distributor_postal_code;?>"/><br/>
				<label>Téléphone :</label><input type="text" class="styled" name="distributor_phone" id="distributor_phone" value="<?=$this->validation->distributor_phone;?>"/><br/>	
				<!--<label>Site web :</label><input type="text" class="styled" name="distributor_website" id="distributor_website" value="<?=$this->validation->distributor_website;?>"/><br/>	-->
				<br/>
				<label></label><input type="submit" class="styled" name="btnSubmit" value="<?=$this->lang->line('button_submit');?>" style="width:auto;"/>
			</form>
		</div>
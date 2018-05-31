<style type="text/css">
	.larger_icon {
		
		font-size: 1.5em;
		font-weight: normal;
		font-style: normal;
		
	}
	
	.step {
		margin: 15px 0px 10px;
	}

	.pp_auth_table {

	}

	.oauthcode {
		width: 74%;
	}
	
</style>


<?php if (!$preexisting_app) {?>
	<h3>Set up your Facebook application for <em><?=$site_label;?></em>.</h3>
	<h4 class='step'><span class='larger_icon'>&#9744;</span>  Step 1 - Set up your app on Facebook</h4>
	<p>Visit <a href="http://instagram.com/developer/register/" target="instagram">the Facebook Applicaion Creation Page</a> to create a new application for use on <em><?=$site_label;?></em>.</p>
	
	<p>You will be asked for an oAuth URL in the creation process. Below is URL you will need.</p>

	<p><input type="text" value="<?php echo $full_auth_url;?>" class="oauthcode" style='width: 74%;'></p>
		
	<p>When you've completed creating the application in the Facebook developer area, return to this page and fill in the information provided by Facebook in Step 2 below.</p>
	
	<p><em>NOTE: If you've previously set up your application, you can go directly the the <a href="http://instagram.com/developer/clients/manage/" target="instagram">Facebook Application Management screen</a> and get the information you'll need for Step 2 from there.</em></p>
	
	<h4 class='step'><span class='larger_icon'>&#9744;</span>  Step 2 - Save your Facebook app credentials into your Expression Engine database.</h4>
	<table border="1" cellspacing="2" cellpadding="5" width='75%' class='pp_auth_table'>
		<tr ><th colspan="2">Enter the info from your Facebook application page.</th></tr>

	<?=form_open($action_url, '', $form_hidden)?>

	<?php $data = array(
	              'name'        => 'fb_client_id',
	              'id'          => 'fb_client_id',
	              'value'       => '',
	              'maxlength'   => '64',
	              'size'        => '30',
	              'style'       => 'width:98%',
	            );
	echo "<tr><td>".form_label('Facebook Client ID ', 'fb_client_id')."</td><td>".form_input($data)."</tr>";
	//echo form_input($data);
	?>
	
	<?php $data = array(
	              'name'        => 'fb_client_secret',
	              'id'          => 'fb_client_secret',
	              'value'       => '',
	              'maxlength'   => '64',
	              'size'        => '30',
	              'style'       => 'width:98%',
	            );
	//echo form_label('Client Secret ', 'fb_client_secret');
	echo "<tr><td>".form_label('Facebook Client Secret ', 'fb_client_secret')."</td><td>".form_input($data)."</tr>";
	//echo form_input($data);
	?>


	<?php echo "<tr><td  colspan='2'>".form_submit(array('name' => 'submit', 'value' => lang('submit'), 'class' => 'submit'))."</td></tr>"; ?>

	<?=form_close()?>
	</table>
	<h4 class='step'><span class='larger_icon'>&#9744;</span> Step 3 - Have a user authorize the app</h4>
	<p>You must finish step 2 before authorizing the app to access a user's Facebook feed.</p>
<?php } else { ?>
	
	<h3>Set up your Facebook application for <em><?=$site_label;?></em>.</h3>

	<h4 class='step'><span class='larger_icon'>&#9745;</span> Step 1 - Set up your app on Facebook</h4>
	<p>Nice job. It appears you've completed this step. As a reminder, below is the redirect URL the app should be using.</p>
	<p><input type="text" value="<?php echo $full_auth_url;?>" class="oauthcode" style='width: 74%;'></p>
	
	<h4 class='step'><span class='larger_icon'>&#9745;</span> Step 2 - Save your Facebook app credentials into your Expression Engine database.</h4>
	<p>Almost there... You've completed this step, too. There are Facebook credentials saved into your Expression Engine for <em><?=$site_label;?></em>.</p>
	
	<h4 class='step'><span class='larger_icon'>&#9744;</span> Step 3 - Have a user authorize the app</h4>
	
	<p>Lastly, have an Facebook user request authorization from Facebook for this application to be granted access to his or her photostream.</p>

	<?php 
		if($ableToAuthorizeFromThisURL) {
	?>

	<p>Neither Expression Engine nor the Facebook application you've just built stores the password for this user. Only an authorization key is stored. Click the button below to start authorize this application access to your photos.</p>
	<!-- <p><a href="https://instagram.com/oauth/authorize/?client_id=<?=$clientID;?>&redirect_uri=<?=$redirect_url;?>&response_type=code" class='submit'>NON AJAX Authorize</a></p> -->
	<br>
	<p><a href="https://instagram.com/oauth/authorize/?client_id=<?=$clientID;?>&redirect_uri=<?=$redirect_url;?>&display=touch&response_type=code" class='submit authorize'>Authorize this App with Facebook</a></p>
	
	<script>
	$(document).ready(function()
	    {
			$(".authorize").bind('click', processAuthorization);

			function processAuthorization(e)
			{
				e.preventDefault();
				var theURL = $(this).attr('href');
				window.open(theURL,'ingram_auth','width=400,height=450,left=0,top=100,screenX=0,screenY=100');
				$(window).focus(function() {
				   // user closed the popup window... refresh this page to see if their info was successfully saved
					window.location.reload();
				});
			}
			
			/*function getParameterByName(name, data) {
			    var match = RegExp('[?&]' + name + '=([^&]*)')
			                    .exec(data);
			    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
			}*/
	});
	</script>
	<?php }  else { 
		if ($frontend_auth_url==='') {
			echo "<p>You'll need to use front end authorization since you're trying to authorize an Facebook app for a domain than the actual URL of the control panel you're logged into. Alternatively, you may try the <em><a href=\"$adv_user_url\">$fb_adv_user_auth</a></em> proceedure in the <em><a href=\"$adv_menu_url\">$fb_advanced_menu</a></em> menu.</p>";
		} else {
			echo "<p>Authorize <em>$site_label</em>'s Facebook application for access at <a href='$frontend_auth_url' target='_blank'>$frontend_auth_url</a>. The user must be logged into ExpressionEngine to complete authorization.</p>";
		}

		?>
	
	<?php } ?>
<?php } ?>

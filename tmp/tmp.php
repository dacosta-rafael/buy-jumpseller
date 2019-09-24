<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
	
<div style="margin:5px auto; padding: 10px; clear:both; max-width:100px;text-align:center;border: 1px solid #4CAF50;">

<a style="text-decoration:none;text-align:center;" href=" https://<?php echo $_output['storecode']; ?>.jumpseller.com/<?php echo $_output['product']['permalink']; ?>" target="_blank">
	
	<div style="width:100%; text-align:center;">
		<img style="max-width:90px" src="<?php echo $_output['product']['images'][0]['url']; ?>" />
	</div>	

	<div style="max-width:90px;margin:5px auto; text-align:center;max-height:50px; overflow:hidden;">
		<?php echo $_output['product']['name']; ?>
	</div>

	<input type="button" style="background-color: #4CAF50;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;margin: 4px 2px;cursor: pointer;" value="Buy" />

</a>
</div>

	

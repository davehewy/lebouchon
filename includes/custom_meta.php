<?php

	if(!class_exists('Lebouchon_Meta_Handler')):
	
	class Lebouchon_Meta_Handler{
	
		function __construct(){
			add_action('save_post',array(&$this,'menu_save'));
		}
	
		function menu_create(){
			
			add_meta_box('menu-type-div', __('Menu Item Information'),  array(&$this,'menu_type_metabox'), 'menu', 'normal', 'low');
			 
		}

		
		function menu_type_metabox($post){
		
			$lebouchon_text = get_post_meta($post->ID,'_lebouchon_text',true);
			$lebouchon_price = get_post_meta($post->ID,'_lebouchon_price',true);
					
		?>
			
			<table class="form-table">
			
			<tr><th scope="row"><label for="lebouchon_text">Menu Text</label></th><td><textarea style="width:600px;height:60px;" name="lebouchon_text" id="lebouchon_text"><? echo $lebouchon_text?></textarea></td></tr>
			<tr><th scope="row"><label for="lebouchon_price">Menu Price</label></th><td>&pound; <input type="text" name="lebouchon_price" id="lebouchon_price" value="<? echo $lebouchon_price?>"></td></tr>
				
			</table>
			
			
		<?php	
		
		}
		
		function menu_save($post_id){
		
			if(isset($_POST['lebouchon_text']) || isset($_POST['lebouchon_price'])):
				
				update_post_meta($post_id,'_lebouchon_text',$_POST['lebouchon_text']);
				update_post_meta($post_id,'_lebouchon_price',$_POST['lebouchon_price']);
				
			endif;
		
		}
		
	
	}
	
	
	endif;
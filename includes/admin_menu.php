<?php
// This file creates the settings page in the WordPress admin.
//*********************************************************************************

if(is_admin()) {
    wp_enqueue_script('jquery-ui-sortable');
}

// This function adds the menu item to the WordPress sidebar.
function sandbox_theme_admin_menus() {
	add_menu_page('Sandbox Theme Settings','Sandbox','manage_options','sandbox_theme_settings','sandbox_settings_page');
}

// This tells WordPress to call the function named "sandbox_theme_admin_menus" when it's time to create the menu pages.
add_action('admin_menu', 'sandbox_theme_admin_menus');

// This is the function that creates the content for the settings page.
function sandbox_settings_page() {
	// Check that the user is allowed to update options  
	if (!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	}
?>
	
	<script type="text/javascript"> 
		var elementCounter = 0;  
		jQuery(document).ready(function() {
			function removeElement(element) {  
				jQuery(element).remove();  
			}
		
			function setElementId(element, id) {  
				var newId = "front-page-element-" + id;      
			  
				jQuery(element).attr("id", newId);                 
			  
				var inputField = jQuery("select", element);  
				inputField.attr("name", "element-page-id-" + id);   
			  
				var labelField = jQuery("label", element);  
				labelField.attr("for", "element-page-id-" + id);  
			}
			
			jQuery("#featured-posts-list").sortable( {  
				stop: function(event, ui) {  
					var i = 0;  
			  
					jQuery("li", this).each(function() {  
						setElementId(this, i);  
						i++;  
					});  
			  
					elementCounter = i;  
					jQuery("input[name=element-max-id]").val(elementCounter);  
				}  
			});
			
			jQuery("#add-featured-post").click(function() {  
				var elementRow = jQuery("#front-page-element-placeholder").clone();  
				var newId = "front-page-element-" + elementCounter;  
	  
				elementRow.attr("id", newId);  
				elementRow.show();  
	  
				var inputField = jQuery("select", elementRow);  
				inputField.attr("name", "element-page-id-" + elementCounter);   
	  
				var labelField = jQuery("label", elementRow);  
				labelField.attr("for", "element-page-id-" + elementCounter);   
				
				var removeLink = jQuery("a", elementRow).click(function() {  
					removeElement(elementRow);  
					return false;  
				});  
				
				elementCounter++;  
				jQuery("input[name=element-max-id]").val(elementCounter);  
	  
				jQuery("#featured-posts-list").append(elementRow);  
	  
				return false;  
			});  
		});  
	</script> 
	
	
	
	<div class="wrap">
	
		<?php screen_icon('themes'); ?> <h2><?php echo get_admin_page_title(); ?></h2>
		
		<form method="POST" action="" id="sandbox_settings">
		
			<table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="num_elements">
                            Number of elements on a row:  
                        </label>
                    </th>
                    <td>
                        <input type="number" name="num_elements" min="0" max="30" />
                    </td>
                </tr>
            </table>
			
			<h3>Featured Posts</h3>
			
			<ul id="featured-posts-list"></ul>
			
			<input type="hidden" name="element-max-id" />
			
			<a href="#" id="add-featured-post">Add featured post</a>
			
			<p>
				<input type="submit" value="Save settings" class="button-primary"/>
			</p>  
		</form>
		
		<?php $posts = get_posts(); ?>
		<li class="front-page-element" id="front-page-element-placeholder" style="display:none;">
			<label for="element-page-id">Featured post:</label>
			<select name="element-page-id">
				<?php foreach ($posts as $post) : ?>
					<option value="<?php echo $post->ID; ?>">
						<?php echo $post->post_title; ?>
					</option>
				<?php endforeach; ?>
			</select>
			<a href="#">Remove</a>
		</li>
		  
	</div><!-- .wrap -->
	
	
<?php
}
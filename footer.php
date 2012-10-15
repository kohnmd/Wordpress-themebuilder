	</section><!-- #middle -->
	
	
	<footer id="bottom">
		<div id="footer-content" class="container_12">
			<?php
			// Where the "Footer Menu" navigation is included.
			// Navigation should be built in wp-admin >> Appearance >> Menus.
			// If no menu has been built, $menu_footer == false.
			$menu_footer = wp_nav_menu(
				array(
					'theme_location' => 'menu_footer',
					'menu_class' => 'menu_footer',
					'fallback_cb' => false,
					'echo' => false
				)
			);
			?>
			<?php if($menu_footer) { ?>
				<div id="footer-menu" class="grid_6">
					<?php echo $menu_footer; ?>
				</div><!-- #footer-menu -->
				<div class="clear"></div>
			<?php } ?>
			
			<div id="copy" class="grid_6">
				Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
			</div><!-- #copy -->
		</div><!-- #footer-content -->
	</footer><!-- #bottom -->
	
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
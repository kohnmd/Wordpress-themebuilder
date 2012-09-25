<section class="grid_3" id="sidebar">
	
	<?php
	// You may add widgets to this sidebar by using the wp-admin >> Appearance >> Widgets tool.
	// You may also add widgets manually by hard coding them in here (if you so desire).
	// Widget output looks like the following, so please use the same format:
	
		/*
		<aside class="widget" id="your-id">
			<h3 class="widget-title">Subnavigation</h3>
			<!-- your content goes here -->
		</aside>
		*/
	
	// Now here's the function that pulls in widgets:
	
	dynamic_sidebar( 'main_sidebar' );
	?>
	
</section><!-- #sidebar -->
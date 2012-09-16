<?php get_header(); ?>
	
<?php 
// This is the main slider area.
// It autmatically checks if the Nivo Slider plugin has been installed,
// and loads the slider with the slug "main-slider" if so.
if(class_exists('WordpressNivoSlider') && post_type_exists('nivoslider')) {
?>
	<section id="main-slider">
		<?php
			$slider = get_posts( array( 'name' => 'main-slider', 'post_type' => 'nivoslider', 'numberposts' => 1 ) );
			if(!empty($slider)) {
				echo do_shortcode('[nivoslider slug="main-slider"]');
			}
		?>
	</section><!-- #main-slider -->
<?php
} // ends if nivo slider plugin exists
?>
	
	
	<section class="home-block container_12">
		<div class="home-widget grid_6">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_6">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
	</section><!-- .home-block -->
	
	
	<section class="home-block container_12">
		<div class="home-widget grid_4">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_4">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_4">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
	</section><!-- .home-block -->
	
	<section class="home-block container_12">
		<div class="home-widget grid_3">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_3">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_3">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_3">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
	</section><!-- .home-block -->
	
	<section class="home-block container_12">
		<div class="home-widget grid_2">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_2">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_2">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_2">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_2">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
		
		<div class="home-widget grid_2">
			<h2>Block title</h2>
			<p>Smallish block of content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus lacus, faucibus in vulputate id, gravida eget tortor. Nulla vestibulum aliquet arcu quis pharetra.</p>
		</div>
	</section><!-- .home-block -->
	
	
	
	<p>This is a paragraph.</p>
	<p>This is a <a href="#">second paragraph</a> with more content in it. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis lectus quis ante dignissim congue. Aliquam erat volutpat. Aliquam erat volutpat. Cras vestibulum nisl id felis consequat quis condimentum elit vehicula. Fusce lorem orci, laoreet sed sagittis et, ornare nec dolor. Aenean mauris neque, faucibus vel convallis in, mollis eu velit. Integer dapibus ligula tempus urna pharetra gravida ut adipiscing mi.</p>
	<p>And here are all the header styles:</p>
	
	<h1>Header 1</h1>
	<p>content</p>
	
	<h2>Header 2</h2>
	<p>content</p>
	
	<h3>Header 3</h3>
	<p>content</p>
	
	<h4>Header 4</h4>
	<p>content</p>
	
	<h5>Header 5</h5>
	<p>content</p>
	
	<h6>Header 6</h6>
	<p>content</p>
	
	<blockquote>
		<p>This is a blockquote.</p>
	</blockquote>
	
	<blockquote>
		<p>This is a blockquote with two lines.</p>
		<p>Still in the blockquote.</p>
	</blockquote>
	
	
	<ul>
		<li>List item 1.</li>
		<li>List item 2.</li>
		<li>List item 3 with nested list.
			<ul>
				<li>Nested item 1.</li>
				<li>Nested item 2.</li>
			</ul>
		<li>Last list item.</li>
	</ul>
	
	<p>content paragraph goes here.</p>
	
	<ul>
		<li>List item 1.</li>
		<li>List item 2.</li>
		<li>List item 3 with nested list.
			<ol>
				<li>Nested item 1.</li>
				<li>Nested item 2.</li>
			</ol>
		<li>Last list item.</li>
	</ul>
	
	<ol>
		<li>List item 1.</li>
		<li>List item 2.</li>
		<li>List item 3 with nested list.
			<ol>
				<li>Nested item 1.</li>
				<li>Nested item 2.</li>
			</ol>
		<li>Last list item.</li>
	</ol>
	
	<ol>
		<li>List item 1.</li>
		<li>List item 2.</li>
		<li>List item 3 with nested list.
			<ul>
				<li>Nested item 1.</li>
				<li>Nested item 2.</li>
			</ul>
		<li>Last list item.</li>
	</ol>
	
	<p>Another paragraph. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis lectus quis ante dignissim congue. Aliquam erat volutpat. Aliquam erat volutpat. Cras vestibulum nisl id felis consequat quis condimentum elit vehicula. Fusce lorem orci, laoreet sed sagittis et, ornare nec dolor. Aenean mauris neque, faucibus vel convallis in, mollis eu velit. Integer dapibus ligula tempus urna pharetra gravida ut adipiscing mi.</p>
	

<?php get_footer(); ?>
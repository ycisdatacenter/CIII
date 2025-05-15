<form role="search" method="get"  class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s"  class="form-control" placeholder="<?php echo esc_html__( 'Enter Search Keywords','indofact'); ?>" required />
		<span class="input-group-addon">
			<button type="submit"><i class="icon icon-Search"></i></button>
		</span>
	</div>
</form>
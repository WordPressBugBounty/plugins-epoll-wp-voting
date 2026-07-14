<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Legacy API names retained for backward compatibility.

if ( ! function_exists( 'it_epoll_get_uploads_base_path' ) ) {
	function it_epoll_get_uploads_base_path() {
		$upload_dir = wp_upload_dir();
		$base       = trailingslashit( $upload_dir['basedir'] ) . 'epoll-wp-voting/';
		if ( ! is_dir( $base ) ) {
			wp_mkdir_p( $base );
		}
		return $base;
	}
}

if ( ! function_exists( 'it_epoll_get_uploads_themes_path' ) ) {
	function it_epoll_get_uploads_themes_path() {
		$path = trailingslashit( it_epoll_get_uploads_base_path() ) . 'themes/';
		if ( ! is_dir( $path ) ) {
			wp_mkdir_p( $path );
		}
		return $path;
	}
}

if ( ! function_exists( 'it_epoll_get_uploads_addons_path' ) ) {
	function it_epoll_get_uploads_addons_path() {
		$path = trailingslashit( it_epoll_get_uploads_base_path() ) . 'addons/';
		if ( ! is_dir( $path ) ) {
			wp_mkdir_p( $path );
		}
		return $path;
	}
}

if ( ! function_exists( 'it_epoll_get_bundled_themes_path' ) ) {
	function it_epoll_get_bundled_themes_path() {
		return trailingslashit( IT_EPOLL_DIR_PATH ) . 'frontend/templates/';
	}
}

if ( ! function_exists( 'it_epoll_get_bundled_addons_path' ) ) {
	function it_epoll_get_bundled_addons_path() {
		return trailingslashit( IT_EPOLL_DIR_PATH ) . 'backend/addons/';
	}
}

if ( ! function_exists( 'it_epoll_get_theme_install_path' ) ) {
	function it_epoll_get_theme_install_path( $theme_id ) {
		return trailingslashit( it_epoll_get_uploads_themes_path() ) . sanitize_file_name( $theme_id ) . '/';
	}
}

if ( ! function_exists( 'it_epoll_get_addon_install_path' ) ) {
	function it_epoll_get_addon_install_path( $addon_id ) {
		return trailingslashit( it_epoll_get_uploads_addons_path() ) . sanitize_file_name( $addon_id ) . '/';
	}
}

if ( ! function_exists( 'it_epoll_resolve_theme_path' ) ) {
	function it_epoll_resolve_theme_path( $theme_id ) {
		$bundled_path = trailingslashit( it_epoll_get_bundled_themes_path() ) . sanitize_file_name( $theme_id ) . '/';
		if ( is_file( $bundled_path . 'template.php' ) ) {
			return $bundled_path;
		}
		return false;
	}
}

if ( ! function_exists( 'it_epoll_resolve_addon_path' ) ) {
	function it_epoll_resolve_addon_path( $addon_id ) {
		$bundled_path = trailingslashit( it_epoll_get_bundled_addons_path() ) . sanitize_file_name( $addon_id ) . '/';
		if ( is_file( $bundled_path . 'addon.php' ) ) {
			return $bundled_path;
		}
		return false;
	}
}

// Shortens a number and attaches K, M, B, etc. accordingly
if(!function_exists('it_epoll_number_shorten')){

	function it_epoll_number_shorten($num) {
		if($num>1000) {

				$x = round($num);
				$x_number_format = number_format($x);
				$x_array = explode(',', $x_number_format);
				$x_parts = array('k', 'm', 'b', 't');
				$x_count_parts = count($x_array) - 1;
				$x_display = $x;
				$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
				$x_display .= $x_parts[$x_count_parts - 1];

				return $x_display;

		}
	return $num;
	}
}



//Adding Columns to epoll cpt
if(!function_exists('set_custom_edit_it_epoll_columns')){
	add_filter( 'manage_it_epoll_poll_posts_columns', 'set_custom_edit_it_epoll_columns' );
	add_filter( 'manage_it_epoll_opinion_posts_columns', 'set_custom_edit_it_epoll_columns' );
	function set_custom_edit_it_epoll_columns($columns) {
		$columns['total_option'] = __( 'Total Options', 'epoll-wp-voting' );
		$columns['poll_status'] = __( 'Poll Status', 'epoll-wp-voting' );
		$columns['shortcode'] = __( 'Shortcode', 'epoll-wp-voting' );
		$columns['view_result'] = __( 'View Result', 'epoll-wp-voting' );
		return $columns;
	}
}

if(!function_exists('custom_it_epoll_poll_column')){
	// Add the data to the custom columns for the book post type:
	add_action( 'manage_it_epoll_poll_posts_custom_column' , 'custom_it_epoll_poll_column', 10, 2 );
	add_action( 'manage_it_epoll_opinion_posts_custom_column' , 'custom_it_epoll_poll_column', 10, 2 );
	function custom_it_epoll_poll_column( $column, $post_id ) {
		switch ( $column ) {

			case 'shortcode' :
				if(get_post_type($post_id) == 'it_epoll_opinion'){
					$code = '[IT_EPOLL_POLL id="'.$post_id.'"][/IT_EPOLL_POLL]';
					if ( is_string( $code ) ){?>
						<code><?php echo esc_html($code,'epoll-wp-voting');?></code>
					<?php }else{
						echo esc_attr( 'Unable to get shortcode', 'epoll-wp-voting' );
					}
						
				}else{
					$code = '[IT_EPOLL_VOTING id="'.$post_id.'"][/IT_EPOLL_VOTING]';
					if ( is_string( $code ) ){?>
						<code><?php echo esc_html($code,'epoll-wp-voting');?></code>
					<?php }else{
						echo esc_attr( 'Unable to get shortcode', 'epoll-wp-voting' );
					}
				}
				
				break;
			case 'poll_status' :
				$poll_status = get_post_meta(get_the_id(),'it_epoll_poll_status',true);
				if($poll_status == 'live'){?>
					<span class='it_epolladmin_pro_badge'><?php echo esc_attr($poll_status,'epoll-wp-voting');?></span>
				<?php }else{?>
					<span class='it_epolladmin_pro_badge it_epolladmin_pro_badge_blue_only'><?php echo esc_attr($poll_status,'epoll-wp-voting');?></span>
				<?php }
				break;
			case 'total_option' :
				if(get_post_meta($post_id,'it_epoll_poll_option',true)){
					$total_opt = sizeof(get_post_meta($post_id,'it_epoll_poll_option',true));
				}else{
					$total_opt = 0;
				}
				echo esc_attr($total_opt,'epoll-wp-voting');
				break;
			case 'view_result' :?>
				<a href="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports&id='.$post_id),'epoll-wp-voting');?>" class='button button-primary'><?php echo esc_attr('View','epoll-wp-voting');?></a>
			<?php	break;
		}
	}
}


//Change Poll Title Placeholder in Editor
if(!function_exists('it_epoll_change_title_text')){

	add_filter( 'enter_title_here', 'it_epoll_change_title_text' );
	function it_epoll_change_title_text( $title ){
		$screen = get_current_screen();
	  
		if  ( 'it_epoll_opinion' == $screen->post_type ) {
			 $title = 'Enter Question / Poll title here...';
		}
		  
		if  ( 'it_epoll_poll' == $screen->post_type ) {
			$title = 'Enter Contest / Poll title here...';
	   }
	  
		return $title;
	}
	  
}


if(!function_exists('get_it_epoll_local_themes_data')){
	function get_it_epoll_local_themes_data(){
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
		global $wp_filesystem;
		$wp_filesystem = new WP_Filesystem_Direct( false );

		$theme_data  = array();
		$scan_paths  = array(
			it_epoll_get_bundled_themes_path(),
		);

		foreach ( $scan_paths as $template_dir ) {
			if ( ! is_dir( $template_dir ) ) {
				continue;
			}
			$themes = $wp_filesystem->dirlist( $template_dir );
			if ( $themes ) {
				foreach ( $themes as $theme ) {
					$theme_data[] = it_epoll_theme_dir_array( $theme, $template_dir );
				}
			}
		}

		return wp_json_encode( $theme_data );
	}
}

if(!function_exists('it_epoll_theme_dir_array')){
	function it_epoll_theme_dir_array( $theme_dir, $base_path = '' ) {
		if ( empty( $base_path ) ) {
			$base_path = it_epoll_get_bundled_themes_path();
		}
		$theme_name = $theme_dir['name'];
		$theme_dir  = trailingslashit( $base_path ) . $theme_name . '/';
		$theme_data = array();
		if(is_file($theme_dir.'template.php')){
		
			$theme_data = get_file_data($theme_dir.'template.php',array('Name'=>'Name',
			'Description'=>'Description',
			'Version'=>'Version',
			'Eversion'=>'Eversion',
			'Type'=>'Type',
			'Developer' => 'Developer',
			'Url' => 'Url',
			'Id'=>'Id',
			'Icon'=>'',
			'Required'=>'Required',
			'DownloadUrl'=>''
		));
		}
		$dir_array = array('Dir'=>$theme_name);
		array_push($theme_data,$dir_array);
		
		return  $theme_data;
		
		
	}

}



if(!function_exists('it_epoll_plugin_api_request')){
	function it_epoll_plugin_api_request($url,$cache_key){
	
		$remote = get_transient($cache_key);
		if( false === $remote){
			
			$remote = wp_remote_get($url);
	
		if( 
			is_wp_error( $remote )
			|| 200 !== wp_remote_retrieve_response_code( $remote )
			|| empty( wp_remote_retrieve_body( $remote ) )
		) {
			return false;
		}
		set_transient( $cache_key, $remote, DAY_IN_SECONDS );
	}
	
		
		$remote = json_decode( wp_remote_retrieve_body( $remote ) );
		return $remote;
	
	}
}

if(!function_exists('check_it_epoll_module_update_available')){
	function check_it_epoll_module_update_available($module_type,$module_id,$current_version=1.0){
		
		if($module_type == 'template'){
			$response = it_epoll_plugin_api_request(IT_EPOLL_THEME_STORE_URL.$module_id.'?get_version=true','it_epoll_plugin_theme_update_check_'.$module_id);
		}else{
			$response = it_epoll_plugin_api_request(IT_EPOLL_EXTENSION_STORE_URL.$module_id.'?get_version=true','it_epoll_plugin_addon_update_check_'.$module_id);
		}
		
		if(!$response){
			return false;
		}
		
		if(isset($response->Version)){
			$version = $response->Version;
		}else{
			$version = '1.0';
		}
	
		
		if($version != $current_version){
			return true;
		}else{
			return false;
		}
				
	}
}


if(!function_exists('check_it_epoll_theme_update_left')){
	function check_it_epoll_theme_update_available(){
		
	}
}



if(!function_exists('get_it_epoll_local_addons_data')){
	function get_it_epoll_local_addons_data(){
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
		global $wp_filesystem;
		$wp_filesystem = new WP_Filesystem_Direct( false );

		$addon_data = array();
		$scan_paths = array(
			it_epoll_get_bundled_addons_path(),
		);

		foreach ( $scan_paths as $addon_dir ) {
			if ( ! is_dir( $addon_dir ) ) {
				continue;
			}
			$addons = $wp_filesystem->dirlist( $addon_dir );
			if ( $addons ) {
				foreach ( $addons as $addon ) {
					$addon_data[] = it_epoll_addon_dir_array( $addon, $addon_dir );
				}
			}
		}

		return wp_json_encode( $addon_data );
	}
}

if(!function_exists('it_epoll_addon_dir_array')){
	function it_epoll_addon_dir_array( $addon_dir, $base_path = '' ) {
		if ( empty( $base_path ) ) {
			$base_path = it_epoll_get_bundled_addons_path();
		}
		$addon_name = $addon_dir['name'];
		$addon_dir  = trailingslashit( $base_path ) . $addon_name . '/';
		
		$addon_data = array();
		if(is_file($addon_dir.'addon.php')){
			$addon_data = get_file_data($addon_dir.'addon.php',array('Name'=>'Name',
			'Description'=>'Description',
			'Version'=>'Version',
			'Eversion'=>'Eversion',
			'Type'=>'Type',
			'Developer' => 'Developer',
			'Url' => 'Url',
			'Id'=>'Id',
			'Icon'=>'',
			'Required'=>'Required',
			'DownloadUrl'=>''
			));
		}
		$dir_array = array('Dir'=>$addon_name);
	
		array_push($addon_data,$dir_array);
	return  $addon_data;
	}

}



if(!function_exists('get_it_epoll_build_theme_data')){
	function get_it_epoll_build_theme_data($data,$data_local){
				
		
	
		$template_dir_url = IT_EPOLL_DIR_URL . 'frontend/templates/';

				$themes = json_decode($data,TRUE);
				$themes_local = json_decode($data_local,TRUE);
				
					if($themes){
						$active_theme = array();
			
						if(get_option('it_epoll_active_theme')){
							$active_theme = get_option('it_epoll_active_theme');
						}
						array_push($active_theme,'default');
					
						foreach($themes as $theme){
							
							$theme_data = $theme;
							$dont_show = false;
							$extension_name = __('Unkown Theme','epoll-wp-voting');
							$extension_icon = __('null','epoll-wp-voting');
							$extension_description =__('Tell us about your theme here!','epoll-wp-voting');
							$extension_supported_version = 1;
							$extension_type = 2;
							$extension_version =__('0.1.0','epoll-wp-voting');
							$extension_id = '';
							$extension_developer = __('infotheme inc.','epoll-wp-voting');
							$extension_preview_url =  __('https://infotheme.in/epoll/themes/default/','epoll-wp-voting');
							$extension_download_url = '';
							$extension_purchase_url = '';
							$extension_dir_path ="null....";
							if(isset($theme['Name'])) $extension_name = $theme['Name'];
							if(isset($theme['Description'])) $extension_description = $theme['Description'];
							if(isset($theme['Eversion'])) $extension_supported_version = $theme['Eversion'];
							if(isset($theme['Type'])) $extension_type = $theme['Type'];
							if(isset($theme['Version'])) $extension_version = $theme['Version'];
							if(isset($theme['Developer'])) $extension_developer = $theme['Developer'];
							if(isset($theme['Url'])) $extension_preview_url = $theme['Url'];
							if(isset($theme['Id'])) $extension_id = $theme['Id'];
							if(isset($theme['Icon'])) $extension_icon = $theme['Icon'];
							if(isset($theme['BuyUrl'])) $extension_purchase_url = $theme['BuyUrl'];
							if(isset($theme['DownloadUrl'])) $extension_download_url = $theme['DownloadUrl'];
							if(isset($theme[0]['Dir'])) $extension_dir_path = $theme[0]['Dir'];
								$update_availble = false;
							
								if(!$extension_id) $dont_show = true;

								$update_availble = false;
									if($themes_local){
										
										if(in_array($extension_id, array_column($themes_local, 'Id'))){
											$dont_show = true;
										}
									}else{
										$update_availble = check_it_epoll_module_update_available('templates',$extension_id,$extension_version);
									}
	
									if(!$extension_icon){
										$extension_icon = $template_dir_url.$extension_id.'/icon.png';
									}
	
								if(!$dont_show){	

							?>
			
						<div class="plugin-card">
								<div class="plugin-card-top">
									<div class="name column-name">
										<h3>
											<a href="<?php echo esc_url($extension_preview_url,'epoll-wp-voting');?>" target="blank" class="epoll_addon-link_wrap">
													<?php echo esc_attr($extension_name,'epoll-wp-voting');?>
													<img src="<?php echo esc_url($extension_icon,'epoll-wp-voting');?>" class="epoll_addon-icon" alt="<?php echo esc_attr($extension_name,'epoll-wp-voting');?>">
												</a>
										</h3>
									</div>
									<div class="action-links">
										<ul class="plugin-action-buttons it_epoll_plugin_buttons">
												
												<?php 
												$is_store_catalog = ! empty( $themes_local );
												if ( 403 == $extension_type ) { ?>
													<button class="button button-secondary" id="default" data-id="<?php echo esc_attr( $extension_id, 'epoll-wp-voting' ); ?>" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button>
												<?php } elseif ( $extension_purchase_url ) { ?>
													<li><a href="<?php echo esc_url( $extension_purchase_url, 'epoll-wp-voting' ); ?>" target="_blank" class="button button-primary" id="default" data-id="<?php echo esc_attr( $extension_id, 'epoll-wp-voting' ); ?>"><?php esc_attr_e( 'Buy Now', 'epoll-wp-voting' ); ?></a></li>
												<?php } elseif ( $is_store_catalog ) { ?>
													<li><button class="button button-secondary" type="button" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button></li>
												<?php } elseif ( ! $extension_purchase_url && ! $extension_download_url ) {
														if(!in_array($extension_id,$active_theme)){?>
														<li>
															<button class="button button-primary" id="activate" data-action="it_epoll_theme_action_activate" data-nonce="<?php echo esc_attr(wp_create_nonce( 'it_epoll_theme_action_activate_'.$extension_id ),'epoll-wp-voting');?>" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>"><?php echo esc_attr('Activate','epoll-wp-voting');?></button>
														</li>
														<?php  if($extension_id != 'default'){?>
														<li>
															<button class="button button-danger"  id="delete" data-path="<?php echo esc_attr($extension_dir_path,'epoll-wp-voting');?>" data-action="it_epoll_theme_action_uninstall" data-nonce="<?php echo esc_attr(wp_create_nonce( 'it_epoll_theme_action_uninstall_'.$extension_id ),'epoll-wp-voting');?>" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>"><?php echo esc_attr('Uninstall','epoll-wp-voting');?></button>
														</li>
														<?php } }else{?>
														<li>
														<?php  if($extension_id != 'default'){?>
															<button class="button button-secondary"  id="deactivate" data-action="it_epoll_theme_action_deactivate" data-nonce="<?php echo esc_attr(wp_create_nonce( 'it_epoll_theme_action_deactivate_'.$extension_id ),'epoll-wp-voting');?>" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>"><?php echo esc_attr('Deactivate','epoll-wp-voting');?></button>
														<?php }else{?>
															<button class="button button-secondary"  id="default" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>" disabled><?php echo esc_attr('Default','epoll-wp-voting');?></button>

															<?php }?>
														</li>
														<?php } } elseif ( $update_availble ) { ?>
																<li><button class="button button-secondary" type="button" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button></li>
															<?php } else { ?>
																<li><button class="button button-secondary" type="button" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button></li>
															<?php } ?>
													
											</ul>
										</div>
										<div class="desc column-description">
											<p class="authors"> <cite>By <a href="<?php echo esc_url($extension_preview_url,'epoll-wp-voting');?>" target="_blank"><?php echo wp_kses($extension_developer,array('a','b','i','strong'=>array('style'=>'color'),'del'=>array('style'=>'color')));?></a></cite></p>
									
											<p><?php echo esc_attr($extension_description,'epoll-wp-voting');?></p>
										</div>
									</div>
									<div class="plugin-card-notice">
									<?php if ( $update_availble && empty( $themes_local ) ) { ?>
										<div class="update-message notice inline notice-warning notice-alt"><p><?php echo esc_attr('New Update Available!','epoll-wp-voting');?></p></div>
										<?php }?>
									</div>
									<div class="plugin-card-bottom">
											<div class="column-updated">
											<strong><?php esc_attr_e('Version:','epoll-wp-voting');?></strong> <?php echo esc_attr($extension_version,'epoll-wp-voting');?>			
											</div>
											<div class="column-downloaded">
												<?php if($extension_type == 1){?>
													<strong><?php esc_attr_e('Type:','epoll-wp-voting');?></strong> <?php esc_attr_e('Funtional & Style','epoll-wp-voting');?>
												<?php }else{?>
													<strong><?php esc_attr_e('Type:','epoll-wp-voting');?></strong> <?php esc_attr_e('Style Only','epoll-wp-voting');?>
												<?php }?>
												<br><strong><?php esc_attr_e('ePoll Compatibility:','epoll-wp-voting');?></strong> <?php echo esc_attr($extension_supported_version,'epoll-wp-voting');?>
											</div>
									</div>
								</div>
						<?php
									}
							}
						}else{
							echo esc_attr('Please Install A Theme At Least to work this plugin','epoll-wp-voting');
						}
		}
}


if(!function_exists('it_epoll_myext_getMyDownloadUrl')){
	function it_epoll_myext_getMyDownloadUrl($extension_id){
		$response = it_epoll_plugin_api_request(IT_EPOLL_DOWNLOAD_URL."?name=".$extension_id,'it_epoll_plugin_get_download_url_checkerV2_'.$extension_id);
		
		if(!$response) return "";
		
		if(isset($response->url)){

			return $response->url;
		}else{
			return "";
		}	
	}
}

if(!function_exists('it_epoll_MyDomainCheck')){
	function it_epoll_MyDomainCheck($url) {
		if(filter_var( $url, FILTER_VALIDATE_URL,FILTER_SANITIZE_URL )){
			$domain = 'infotheme.net';
			if (checkdnsrr($domain, 'A') && wp_kses_bad_protocol($url,array('https')) && wp_http_validate_url($url)) {
			  return true;
			}
		}
		return false;
	}
}


if(!function_exists('get_it_epoll_build_addon_data')){
	function get_it_epoll_build_addon_data($data,$data_local){
				
		if(!current_user_can('manage_options')) exit(wp_json_encode(array('sts'=>404,'msg'=>'You don\'t have permission to do this!')));
             
	
		$addon_dir_url = IT_EPOLL_DIR_URL . 'backend/addons/';

				$addons = json_decode($data,TRUE);
				$addons_local = json_decode($data_local,TRUE);
					if($addons){
						
						$active_addon = array();
						
						if(get_option('it_epoll_active_addon')){
							$active_addon = get_option('it_epoll_active_addon');
						}
						array_push($active_addon,'default');
					
						foreach($addons as $addon){
						
							$addon_data = $addon;
			
							$extension_name = __('Unkown Addon','epoll-wp-voting');
							$extension_icon = __('null','epoll-wp-voting');
							$extension_description =__('Tell us about your addon here!','epoll-wp-voting');
							$extension_supported_version = 1;
							$extension_type = 2;
							$extension_version =__('0.1.0','epoll-wp-voting');
							$extension_id = '';
							$extension_required = __('default','epoll-wp-voting');
							$extension_developer = __('infotheme inc.','epoll-wp-voting');
							$extension_preview_url =  __('https://infotheme.in/epoll/addon/default/','epoll-wp-voting');
							$extension_download_url = '';
							$extension_purchase_url = '';
							$extension_dir_path ="null....";
							$update_available = false;
							$dont_show = false;
							if(isset($addon['Name'])) $extension_name = $addon['Name'];
							if(isset($addon['Description'])) $extension_description = $addon['Description'];
							if(isset($addon['Eversion'])) $extension_supported_version = $addon['Eversion'];
							if(isset($addon['Type'])) $extension_type = $addon['Type'];
							if(isset($addon['Version'])) $extension_version = $addon['Version'];
							if(isset($addon['Developer'])) $extension_developer = $addon['Developer'];
							if(isset($addon['Url'])) $extension_preview_url = $addon['Url'];
							if(isset($addon['Id'])) $extension_id = $addon['Id'];
							if(isset($addon['Icon'])) $extension_icon = $addon['Icon'];
							if(isset($addon['Required'])) $extension_required = $addon['Required'];
							
							if(isset($addon['BuyUrl'])) $extension_purchase_url = $addon['BuyUrl'];
							if(isset($addon['DownloadUrl'])) $extension_download_url = $addon['DownloadUrl'];
							
							if(isset($addon[0]['Dir'])) $extension_dir_path = $addon[0]['Dir'];
							
							if(!$extension_id) $dont_show = true;
							$update_availble = false;
								if($addons_local){
									if(array_search($extension_id, array_column($addons_local, 'Id'))){
										$dont_show = true;
									}
								}else{
									$update_availble = check_it_epoll_module_update_available('addons',$extension_id,$extension_version);
								}

								if(!$extension_icon){
									$extension_icon = $addon_dir_url.$extension_id.'/icon.png';
								}

							if(!$dont_show){	
							?>
			
						<div class="plugin-card">
						<?php if(!in_array($extension_required,$active_addon)){?>
								<div class="plugin-card-notice">
									<div class="error-message notice inline notice-error error-alt"><p><?php echo esc_attr($extension_required.' Addon Required','epoll-wp-voting');?></p></div>
								</div>
								<?php }?>
								<div class="plugin-card-top">
									
									<div class="name column-name">
										<h3>
											<a href="<?php echo esc_url($extension_preview_url,'epoll-wp-voting');?>" target="blank" class="epoll_addon-link_wrap">
													<?php echo esc_attr($extension_name,'epoll-wp-voting');?>
													<img src="<?php echo esc_url($extension_icon,'epoll-wp-voting');?>" class="epoll_addon-icon" alt="<?php echo esc_attr($extension_name,'epoll-wp-voting');?>">
												</a>
										</h3>
									</div>
									<div class="action-links">
										<ul class="plugin-action-buttons it_epoll_plugin_buttons">
												
												<?php 
												$is_store_catalog = ! empty( $addons_local );
												if ( 403 == $extension_type ) { ?>
													<li><button class="button button-secondary" type="button" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button></li>
												<?php } elseif ( $extension_purchase_url ) { ?>
													<li><a href="<?php echo esc_url( $extension_purchase_url, 'epoll-wp-voting' ); ?>" target="_blank" class="button button-primary" id="default" data-id="<?php echo esc_attr( $extension_id, 'epoll-wp-voting' ); ?>"><?php esc_attr_e( 'Buy Now', 'epoll-wp-voting' ); ?></a></li>
												<?php } elseif ( $is_store_catalog ) { ?>
													<li><button class="button button-secondary" type="button" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button></li>
												<?php } elseif ( ! $extension_purchase_url && ! $extension_download_url ) {
													
												if(!in_array($extension_id,$active_addon) && in_array($extension_required,$active_addon)){?>
													<li>
														<button class="button button-primary" id="activate" data-action="it_epoll_addon_action_activate"  data-nonce="<?php echo esc_attr(wp_create_nonce( 'it_epoll_addon_action_activate_'.$extension_id ),'epoll-wp-voting');?>" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>"><?php echo esc_attr('Activate','epoll-wp-voting');?></button>
													</li>
													<?php  if($extension_id != 'default'){?>
													<li>
														<button class="button button-danger"  id="delete" data-path="<?php echo esc_attr($extension_dir_path,'epoll-wp-voting');?>" data-action="it_epoll_addon_action_uninstall" data-nonce="<?php echo esc_attr(wp_create_nonce( 'it_epoll_addon_action_uninstall_'.$extension_id ),'epoll-wp-voting');?>" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>"><?php echo esc_attr('Uninstall','epoll-wp-voting');?></button>
													</li>
													<?php } }else{?>
													<li>
													<?php  if($extension_id != 'default' && in_array($extension_required,$active_addon)){?>
														<button class="button button-secondary"  id="deactivate" data-action="it_epoll_addon_action_deactivate" data-nonce="<?php echo esc_attr(wp_create_nonce( 'it_epoll_addon_action_deactivate_'.$extension_id ),'epoll-wp-voting');?>" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>"><?php echo esc_attr('Deactivate','epoll-wp-voting');?></button>
													<?php }else{?>
														<button class="button button-secondary"  id="default" data-id="<?php echo esc_attr($extension_id,'epoll-wp-voting');?>" disabled><?php echo esc_attr('Default','epoll-wp-voting');?></button>
														<?php }?>
													</li>
													
													
												<?php } } elseif ( $update_availble ) { ?>
														<li><button class="button button-secondary" type="button" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button></li>
													<?php } else { ?>
														<li><button class="button button-secondary" type="button" disabled><?php esc_attr_e( 'Coming Soon', 'epoll-wp-voting' ); ?></button></li>
													<?php } ?>
										</ul>
									</div>
									<div class="desc column-description">
										<p class="authors"> <cite>By <a href="<?php echo esc_url($extension_preview_url,'epoll-wp-voting');?>" target="_blank"><?php echo wp_kses($extension_developer,array('a','b','i','strong'=>array('style'=>'color'),'del'=>array('style'=>'color')));?></a></cite></p>
								
										<p><?php echo esc_attr($extension_description,'epoll-wp-voting');?></p>
									</div>
								</div>
								<div class="plugin-card-notice">
								<?php if ( $update_availble && empty( $addons_local ) ) { ?>
									<div class="update-message notice inline notice-warning notice-alt"><p><?php echo esc_attr('New Update Available!','epoll-wp-voting');?></p></div>
									<?php }?>
								</div>
								<div class="plugin-card-bottom">
										<div class="column-updated">
											<strong><?php esc_attr_e('Version:','epoll-wp-voting');?></strong> <?php echo esc_attr($extension_version,'epoll-wp-voting');?>				
										</div>
										<div class="column-downloaded">
											
											<strong><?php esc_attr_e('ePoll Compatibility:','epoll-wp-voting');?></strong> <?php echo esc_attr($extension_supported_version,'epoll-wp-voting');?>
											
										</div>
								</div>
							</div>
					<?php
							}
						}
					}else{
						echo esc_attr('Please Install A addon At Least to work this plugin','epoll-wp-voting');
					}
	}
}


if(!function_exists('get_it_epoll_local_themes')){

	function get_it_epoll_local_themes(){
		
		$themes = get_it_epoll_local_themes_data();
	
		get_it_epoll_build_theme_data($themes,'');
	}
}


if(!function_exists('get_it_epoll_local_addons')){

	function get_it_epoll_local_addons(){
		
		$addons = get_it_epoll_local_addons_data();
		
		get_it_epoll_build_addon_data($addons,'');
	}
}



if(!function_exists('get_it_epoll_store_themes')){

	function get_it_epoll_store_themes(){
		$template_dir = IT_EPOLL_DIR_PATH . 'frontend/templates';
		$response = it_epoll_plugin_api_request(IT_EPOLL_THEME_STORE_URL,'it_epoll_plugin_store_themes_');
		
			if($response){
					$themes = get_it_epoll_local_themes_data();
					get_it_epoll_build_theme_data(wp_json_encode($response),$themes);
			}else{?>
			<div>
				<h3><?php echo esc_attr('Unable to load from store, Please check your internet connection or contact us at support@infotheme.net','epoll-wp-voting');?></h3>
				<a href="#" onClick="window.location.reload();" class="button"><?php echo esc_attr('Retry','epoll-wp-voting');?></a>
			</div>
			<?php }
	
	}
}



if(!function_exists('get_it_epoll_store_addons')){

	function get_it_epoll_store_addons(){
		
		
		$response = it_epoll_plugin_api_request(IT_EPOLL_EXTENSION_STORE_URL,'it_epoll_plugin_store_addons_');
		
			if($response){
					$addons = get_it_epoll_local_addons_data();
					get_it_epoll_build_addon_data(wp_json_encode($response),$addons);
			}else{?>
			<div>
				<h3><?php echo esc_attr('Unable to load from store, Please check your internet connection or contact us at support@infotheme.net','epoll-wp-voting');?></h3>
				<a href="#" onClick="window.location.reload();" class="button"><?php echo esc_attr('Retry','epoll-wp-voting');?></a>
			</div>
			<?php }
		

		
	}
}


if(!function_exists('get_it_epoll_store_docs')){

	function get_it_epoll_store_docs($tab='general'){
		if($tab == 'forum'){
			$response = it_epoll_plugin_api_request(IT_EPOLL_DOC_STORE_URL.'?type='.$tab,'it_epoll_plugin_store_forum_');
		}else{
			$response = it_epoll_plugin_api_request(IT_EPOLL_DOC_STORE_URL.'?type='.$tab,'it_epoll_plugin_store_docs_');
		}
			if($response){
					if($tab == 'forum'){
						array_map('build_it_epoll_faq_layout',($response));
					}else{
						array_map('build_it_epoll_doc_layout',($response));
					}
				
			}else{?>
			<div>
				<h3><?php echo esc_attr('Unable to load from store, Please check your internet connection or contact us at support@infotheme.net','epoll-wp-voting');?></h3>
				<a href="#" onClick="window.location.reload();" class="button"><?php echo esc_attr('Retry','epoll-wp-voting');?></a>
			</div>
			<?php }
	}
}




if(!function_exists('build_it_epoll_doc_layout')){
	function build_it_epoll_doc_layout($data){?>
	<a href="<?php echo esc_url($data->link,'epoll-wp-voting');?>" class="it_epoll_admin_box_item_link">
		<div class="it_epoll_admin_box_item_content">
			<h4><?php echo esc_attr($data->title,'epoll-wp-voting');?></h4>
			<p class="it_epoll_admin_box_item_content_description"><?php echo esc_attr($data->desc,'epoll-wp-voting');?></p>
			<span class="it_epoll_admin_item_content_link"><i class="dashicons dashicons-external"></i><?php echo esc_attr(' Read More','epoll-wp-voting');?></span>
		</div>
		<img src="<?php echo esc_url($data->thumbnail,'epoll-wp-voting');?>" alt="" width="92" height="92"/>
	</a>
	<?php			
	}
}

if(!function_exists('build_it_epoll_faq_layout')){
	function build_it_epoll_faq_layout($data){?>	
		<a href="<?php echo esc_url($data->link,'epoll-wp-voting');?>" class="it_epoll_admin_box_item_link it_epoll_admin_box_item_link_partial">
			<div class="it_epoll_admin_box_item_content">
				<h4><?php echo esc_attr($data->title,'epoll-wp-voting');?></h4>
				<p class="it_epoll_admin_box_item_content_description"><?php echo esc_attr($data->desc,'epoll-wp-voting');?></p>
				<span class="it_epoll_admin_item_content_link"><i class="dashicons dashicons-external"></i><?php echo esc_attr(' Read More','epoll-wp-voting');?></span>
			</div>
		</a>
		<?php
	}
}

if ( ! function_exists( 'it_epoll_parse_post_form_data' ) ) {
	function it_epoll_parse_post_form_data( $field = 'data' ) {
		// phpcs:disable WordPress.Security.NonceVerification.Missing -- Nonce is verified in the AJAX handler before this helper runs.
		if ( ! isset( $_POST[ $field ] ) || ! is_string( $_POST[ $field ] ) ) {
			return array();
		}
		$parsed = array();
		parse_str( sanitize_textarea_field( wp_unslash( $_POST[ $field ] ) ), $parsed );
		// phpcs:enable WordPress.Security.NonceVerification.Missing
		return map_deep( $parsed, 'sanitize_text_field' );
	}
}

if(!function_exists('it_epoll_install_from_store_zip')){
	function it_epoll_install_from_store_zip($url,$upload_dir,$action_upload,$type="template"){
		if(!current_user_can('manage_options')) {
			return array('sts'=>404,'msg'=>'You don\'t have permission to do this!');
		}
		return array('sts'=>404,'msg'=>'Remote installation is not supported in the WordPress.org plugin directory version.');
	}
	
}


if(!function_exists('it_epoll_install_from_local_zip')){

	function it_epoll_install_from_local_zip($upload_dir,$action_upload,$type="template"){
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		?>
		<div class="error notice is-dismissible">
			<p><?php esc_html_e( 'Uploading custom add-on or template ZIP files is not supported in this version. Only bundled templates and add-ons included with the plugin can be used.', 'epoll-wp-voting' ); ?></p>
		</div>
		<?php
	}

}



if(!function_exists('it_epoll_module_admin_script_enque')){

	function it_epoll_module_admin_script_enque(){

	}
}


if(!function_exists('it_epoll_module_admin_css_enque')){

	function it_epoll_module_admin_css_enque(){
		
	}
}

if(!function_exists('it_epoll_module_css_enque')){

	function it_epoll_module_css_enque(){
		
	}
}

if(!function_exists('it_epoll_module_script_enque')){

	function it_epoll_module_script_enque(){
		
	}
}

if(!function_exists('it_epoll_module_editor_script_enque')){

	function it_epoll_module_editor_script_enque(){
		
	}
}


if(!function_exists('it_epoll_settings_plugin_link')){

	add_filter( 'plugin_action_links', 'it_epoll_settings_plugin_link', 10, 2 );

	function it_epoll_settings_plugin_link( $links, $file ) 
	{
		if ( $file == plugin_basename(IT_EPOLL_DIR_PATH . '/it-epoll.php') ) 
		{
			
			/*
			 * Insert the link at the beginning
			 */
			$in = '<a href="admin.php?page=epoll_options">' . __('Settings','epoll-wp-voting') . '</a>';
			array_unshift($links, $in);
	
			/*
			 * Insert at the end
			 */
			 $links[] = '<a target="_blank" style="font-weight: bold; color: #FF5722;" href="'.esc_url('https://infotheme.net/item/wordpress/plugin/poll-maker-and-voting-plugin/','epoll-wp-voting').'">'.__('Get ePoll Pro','epoll-wp-voting').'</a>';
		}
		return $links;
	}
}
//Security Check for Admin Ajax Request in Addon and Theme Section for ePoll
if(!function_exists('it_epoll_admin_ajax_capabilities_check')){
	function it_epoll_admin_ajax_capabilities_check(){
		if(!current_user_can('manage_options'))   exit(wp_json_encode(array('sts'=>404,'data'=>array('name'=>$name,'id'=>$id),'msg'=>'You don\'t have permission to do this!')));
	}
}
// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals
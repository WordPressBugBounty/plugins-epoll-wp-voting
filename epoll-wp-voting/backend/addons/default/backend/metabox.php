<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(!function_exists('it_epoll_default_add_pro_metadata')){
    
    add_action('it_epoll_poll_option_meta_ui','it_epoll_default_add_pro_metadata',0);
    add_action('it_epoll_opinion_option_meta_ui','it_epoll_default_add_pro_metadata',0);
    
    function it_epoll_default_add_pro_metadata($args){
        $post_id = $args['poll_id'];
        ?>
        <table class="form-table">
            <thead>
                <tr>
                    <th colspan="4">
                            <label><?php esc_attr_e('Advance Settings','epoll-wp-voting');?></label>
                        </th>
                    </tr>
            </thead>
                <tbody>
                  
                    <tr>
                       
                        <td colspan="2">   
                                    <label>
                                        <input class="it_epoll_has_oncheck_div" type="checkbox" name="it_epoll_poll_enable_private_voting" value="1"<?php if(get_post_meta($post_id,'it_epoll_poll_enable_private_voting',true)) echo esc_attr(' checked','epoll-wp-voting');?>> <?php esc_attr_e('Enable Private Voting','epoll-wp-voting');?></label>
                                        <div class="it_epoll_oncheck_div<?php if(get_post_meta($post_id,'it_epoll_poll_enable_private_voting',true)) echo esc_attr(' it_epoll_oncheck_div_show','epoll-wp-voting');?>" style="margin-top: 10px;">
                                        <table>
                                            <tr>
                                            <td>
                                                <label><?php esc_attr_e('Voting Access Code','epoll-wp-voting');?></label>
                                            </td>
                                            <td>
                                                <input type="text" class="widefat" name="it_epoll_poll_private_voting_pin" id="it_epoll_poll_private_voting_pin" value="<?php echo esc_attr(get_post_meta($post_id,'it_epoll_poll_private_voting_pin',true),'epoll-wp-voting');?>">
                                            </td>
                                            <td>
                                                <button class="button button-primary" type="button" onclick="generateVotingAccessCode();">
                                                <span class="btn-inner--icon">
                                                    <i class="fa-solid fa-lock"></i> <?php esc_attr_e('Generate Pin','epoll-wp-voting');?></span>
                                                </button>
                                            </td>
                                            </tr>
                                        </table>
                                        </div>
                                </td>

                    
                    </tr> 
                    <tr>
                        <td>
                            <?php esc_attr_e('Poll Start Date','epoll-wp-voting');?>
                        </td>
                        <td>
                            <input type="date" id="it_epoll_vote_start_date_time" name="it_epoll_vote_start_date_time" value="<?php echo esc_attr( get_post_meta( $post_id, 'it_epoll_vote_start_date_time', true ), 'epoll-wp-voting' ); ?>"/>
                        </td>
                        <td>
                            <?php esc_attr_e('Poll End Date','epoll-wp-voting');?> 
                        
                        </td>
                        <td>
                            <input type="date" min="<?php echo esc_attr(gmdate('Y-m-d', strtotime('+1 day')),'epoll-wp-voting'); ?>" id="it_epoll_vote_end_date_time" name="it_epoll_vote_end_date_time"  value="<?php echo esc_attr(get_post_meta($post_id,'it_epoll_vote_end_date_time',true),'epoll-wp-voting');?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?php esc_attr_e('Result Visibility','epoll-wp-voting');?>
                        </td>
                        <td>
                            <select name="it_epoll_poll_result_visibility" class="widefat">
                                <option value="public"<?php if(get_post_meta($post_id,'it_epoll_poll_result_visibility',true) == 'public') echo esc_attr(' selected','epoll-wp-voting');?>><?php esc_attr_e('Always Public','epoll-wp-voting');?></option>
                                <option value="after_vote_end"<?php if(get_post_meta($post_id,'it_epoll_poll_result_visibility',true) == 'after_vote_end') echo esc_attr(' selected','epoll-wp-voting');?>><?php esc_attr_e('After Voting Ends','epoll-wp-voting');?></option>
                            </select>
                        </td>
                        
                        <td>
                            <?php esc_attr_e('Voting restrictions','epoll-wp-voting');?>
                        </td>
                        <td>
                            <select name="it_epoll_poll_voting_restriction" class="widefat">
                                <option value=""<?php if(!get_post_meta($post_id,'it_epoll_poll_voting_restriction',true)) echo esc_attr(' selected','epoll-wp-voting');?>><?php esc_attr_e('Unlimited votes per user','epoll-wp-voting');?></option>
                                <option value="session"<?php if(get_post_meta($post_id,'it_epoll_poll_voting_restriction',true) == 'session') echo esc_attr(' selected','epoll-wp-voting');?>><?php esc_attr_e('One vote per browser session','epoll-wp-voting');?></option>
                                <option value="cookie"<?php if(get_post_meta($post_id,'it_epoll_poll_voting_restriction',true) == 'cookie') echo esc_attr(' selected','epoll-wp-voting');?>><?php esc_attr_e('Detect voter Via Cookie','epoll-wp-voting');?></option>
                               
                                <?php do_action('it_epoll_poll_option_meta_ui_voting_restriction_options',array('poll_id'=>$post_id));?>
                            </select>
                        </td>
                    </tr>
                   
                    <?php  do_action('it_epoll_poll_option_meta_ui_after_advanced',array('poll_id'=>$post_id));?>
                </tbody>
            </table>
            <script type="text/javascript">
            jQuery.noConflict();
            jQuery(document).ready(function($) {

            
                jQuery('.it_epoll_has_oncheck_div').on('change',function(){
                    if(jQuery(this).is(":checked")){
                        generateVotingAccessCode();
                        jQuery(this).parent().parent().find('.it_epoll_oncheck_div').addClass('it_epoll_oncheck_div_show');
                    }else{
                        jQuery(this).parent().parent().find('.it_epoll_oncheck_div').removeClass('it_epoll_oncheck_div_show');
                    }
                
                });

        function generateVotingAccessCode(){
        var pin =    Math.floor(100000 + Math.random() * 900000);
            jQuery('#it_epoll_poll_private_voting_pin').val(pin);
        }
    });
    </script>
        <?php 
    }
}


if(!function_exists('it_epoll_poll_option_meta_save_basic_field_data')){
    
    add_action('it_epoll_poll_option_meta_save','it_epoll_poll_option_meta_save_basic_field_data');
    add_action('it_epoll_opinion_option_meta_save','it_epoll_poll_option_meta_save_basic_field_data');
    function it_epoll_poll_option_meta_save_basic_field_data($args){ 
        $post_id = $args['poll_id'];

        // Check if our nonce is set.
        if ( ! isset( $_POST['it_epoll_poll_metabox_id_nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['it_epoll_poll_metabox_id_nonce'] ) ), 'it_epoll_poll_metabox_id' ) ) {
            return;
        }
        //Update OTP Option
        if(isset($_POST['it_epoll_vote_end_date_time'])){
            $it_epoll_vote_end_date_time =  sanitize_text_field( wp_unslash( $_POST['it_epoll_vote_end_date_time'] ) );
            update_post_meta( $post_id, 'it_epoll_vote_end_date_time', $it_epoll_vote_end_date_time );
        }

        if(isset($_POST['it_epoll_vote_start_date_time'])){
            $it_epoll_vote_start_date_time = sanitize_text_field( wp_unslash( $_POST['it_epoll_vote_start_date_time'] ) );
            update_post_meta( $post_id, 'it_epoll_vote_start_date_time', $it_epoll_vote_start_date_time );
        } else {
            delete_post_meta( $post_id, 'it_epoll_vote_start_date_time' );
        }


        if(isset($_POST['it_epoll_poll_result_visibility'])){
            $it_epoll_poll_result_visibility =  sanitize_text_field( wp_unslash( $_POST['it_epoll_poll_result_visibility'] ) );
            update_post_meta( $post_id, 'it_epoll_poll_result_visibility', $it_epoll_poll_result_visibility );
        }

        
        if(isset($_POST['it_epoll_poll_voting_restriction'])){
            $it_epoll_poll_voting_restriction =  sanitize_text_field( wp_unslash( $_POST['it_epoll_poll_voting_restriction'] ) );
            update_post_meta( $post_id, 'it_epoll_poll_voting_restriction', $it_epoll_poll_voting_restriction );
        }
        
        if(isset($_POST['it_epoll_poll_enable_private_voting'])){
            $it_epoll_poll_enable_private_voting =  sanitize_text_field( wp_unslash( $_POST['it_epoll_poll_enable_private_voting'] ) );
            update_post_meta( $post_id, 'it_epoll_poll_enable_private_voting', $it_epoll_poll_enable_private_voting );
        }else{
           delete_post_meta( $post_id, 'it_epoll_poll_enable_private_voting');
        }

        if(isset($_POST['it_epoll_poll_private_voting_pin'])){
            $it_epoll_poll_private_voting_pin =  sanitize_text_field( wp_unslash( $_POST['it_epoll_poll_private_voting_pin'] ) );
            update_post_meta( $post_id, 'it_epoll_poll_private_voting_pin', $it_epoll_poll_private_voting_pin );
        }

        
        if(isset($_POST['it_epoll_poll_container_color_secondary'])){
            $it_epoll_poll_container_color_secondary =  sanitize_text_field( wp_unslash( $_POST['it_epoll_poll_container_color_secondary'] ) );
            update_post_meta( $post_id, 'it_epoll_poll_container_color_secondary', $it_epoll_poll_container_color_secondary );
        }

        do_action('it_epoll_opinion_advance_meta_save',$post_id);
        do_action('it_epoll_poll_advance_meta_save',$post_id);
        do_action('it_epoll_poll_schedule_cron_event',$post_id);

    }
}

if ( ! function_exists( 'it_epoll_save_shared_poll_editor_meta' ) ) {
	function it_epoll_save_shared_poll_editor_meta( $args ) {
		$post_id = $args['poll_id'];

		if ( isset( $_POST['it_epoll_poll_multichoice'] ) ) {
			update_post_meta( $post_id, 'it_epoll_poll_multichoice', absint( wp_unslash( $_POST['it_epoll_poll_multichoice'] ) ) );
		} else {
			delete_post_meta( $post_id, 'it_epoll_poll_multichoice' );
		}

		$it_epoll_color_fields = array(
			'it_epoll_poll_color_primary',
			'it_epoll_poll_color_secondary',
			'it_epoll_poll_color_mouseover',
			'it_epoll_poll_color_result_color',
			'it_epoll_poll_option_text_color',
			'it_epoll_poll_button_text_color',
		);
		foreach ( $it_epoll_color_fields as $it_epoll_color_field ) {
			if ( isset( $_POST[ $it_epoll_color_field ] ) ) {
				update_post_meta( $post_id, $it_epoll_color_field, sanitize_text_field( wp_unslash( $_POST[ $it_epoll_color_field ] ) ) );
			}
		}

		if ( isset( $_POST['it_epoll_indi_vote'], $_POST['it_epoll_poll_option_id'] ) && is_array( $_POST['it_epoll_indi_vote'] ) && is_array( $_POST['it_epoll_poll_option_id'] ) ) {
			$it_epoll_manual_votes   = array_map( 'absint', wp_unslash( $_POST['it_epoll_indi_vote'] ) );
			$it_epoll_manual_options = array_map( 'sanitize_text_field', wp_unslash( $_POST['it_epoll_poll_option_id'] ) );
			foreach ( $it_epoll_manual_options as $it_epoll_manual_index => $it_epoll_manual_option_id ) {
				if ( isset( $it_epoll_manual_votes[ $it_epoll_manual_index ] ) ) {
					update_post_meta( $post_id, 'it_epoll_vote_count_' . $it_epoll_manual_option_id, $it_epoll_manual_votes[ $it_epoll_manual_index ] );
				}
			}
		}
	}
	add_action( 'it_epoll_poll_option_meta_save', 'it_epoll_save_shared_poll_editor_meta' );
	add_action( 'it_epoll_opinion_option_meta_save', 'it_epoll_save_shared_poll_editor_meta' );
}
<?php
class Share_Theme_Plugin_About_Me_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Share_Theme_Plugin_About_Me_Widget',
			esc_html__( 'Share - About me', 'share-theme-plugin' )
		);
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
		$this->initFields();
	}

	protected function initFields() {
		$this->widget_fields[] = array(
			'label' => __('Your name', 'share-theme-plugin'),
			'id' => 'srwf_your_name',
			'type' => 'text',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Link', 'share-theme-plugin'),
			'id' => 'srwf_link',
			'type' => 'url',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Description', 'share-theme-plugin'),
			'id' => 'srwf_desc',
			'type' => 'textarea',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Avatar', 'share-theme-plugin'),
			'id' => 'srwf_avatar',
			'type' => 'media',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Facebook', 'share-theme-plugin'),
			'id' => 'srwf_facebook',
			'type' => 'url',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Twitter', 'share-theme-plugin'),
			'id' => 'srwf_twitter',
			'type' => 'url',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Linkedin', 'share-theme-plugin'),
			'id' => 'srwf_linkedin',
			'default' => '',
			'type' => 'url',
		);
		$this->widget_fields[] = array(
			'label' => __('Google Plus', 'share-theme-plugin'),
			'id' => 'srwf_google',
			'type' => 'url',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Pinterest', 'share-theme-plugin'),
			'id' => 'srwf_pinterest',
			'type' => 'url',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Instagram', 'share-theme-plugin'),
			'id' => 'srwf_instagram',
			'type' => 'url',
			'default' => '',
		);
		$this->widget_fields[] = array(
			'label' => __('Youtube', 'share-theme-plugin'),
			'id' => 'srwf_youtube',
			'type' => 'url',
		);
		$this->widget_fields[] = array(
			'label' => __('Skype', 'share-theme-plugin'),
			'id' => 'srwf_skype',
			'type' => 'url',
		);
		$this->widget_fields[] = array(
			'label' => __('Github', 'share-theme-plugin'),
			'id' => 'srwf_github',
			'type' => 'url',
		);
	}

	public function widget( $args, $instance ) {
		echo wp_kses_post($args['before_widget']);
		$social_media = sr_get_social_media();
		?>

		<div class="sr-about-me-widget">
			<a href="<?php echo esc_attr($instance['srwf_link']);?>">
				<span class="sr-avatar-wrapper">
					<img src="<?php echo esc_attr(wp_get_attachment_url($instance['srwf_avatar']))?>" alt="<?php echo esc_attr(__('Avatar', 'share'))?>">
					<span class="sr-name"><?php echo esc_html($instance['srwf_your_name']); ?></span>
				</span>
				
				<span class="sr-desc">
					<?php echo esc_html($instance['srwf_desc']); ?>
				</span>

				<ul class="sr-social-media">
					<?php if(!empty($instance['srwf_facebook'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_facebook'])?>"><i class="<?php echo esc_attr($social_media['facebook'])?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>

					<?php if(!empty($instance['srwf_twitter'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_twitter'])?>"><i class="<?php echo esc_attr($social_media['twitter'])?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if(!empty($instance['srwf_linkedin'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_linkedin'])?>"><i class="<?php echo esc_attr($social_media['linkedin'])?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if(!empty($instance['srwf_google'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_google'])?>"><i class="<?php echo esc_attr($social_media['google-plus'])?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if(!empty($instance['srwf_pinterest'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_pinterest'])?>"><i class="<?php echo esc_attr($social_media['pinterest'])?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if(!empty($instance['srwf_instagram'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_instagram'])?>"><i class="<?php echo esc_attr($social_media['instagram'])?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if(!empty($instance['srwf_youtube'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_youtube'])?>"><i class="<?php echo esc_attr($social_media['youtube']) ?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if(!empty($instance['srwf_skype'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_skype'])?>"><i class="<?php echo esc_attr($social_media['skype'])?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if(!empty($instance['srwf_github'])): ?>
						<li><a href="<?php echo esc_attr($instance['srwf_github'])?>"><i class="<?php echo esc_attr($social_media['github']) ?>" aria-hidden="true"></i></a></li>
					<?php endif; ?>
				</ul>
			</a>
		</div>

	<?php
		
		echo wp_kses_post($args['after_widget']);
	}

	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$(document).on('click','.custommedia',function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.id);
								$('span#preview'+id).css('background-image', 'url('+attachment.url+')');
								$('input#'+id).trigger('change');
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
					$('.remove-media').on('click', function(){
						var parent = $(this).parents('p');
						parent.find('input[type="text"]').val('');
						parent.find('span').css('background-image', 'url()');
					});
				}
			});
		</script><?php
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : '';
			switch ( $widget_field['type'] ) {
				case 'media':
					$media_url = '';
					if ($widget_value) {
						$media_url = wp_get_attachment_url($widget_value);
					}
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'share' ).':</label> ';
					$output .= '<input style="display:none;" class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.$widget_value.'">';
					$output .= '<span id="preview'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" style="margin-right:10px;border:2px solid #eee;display:block;width: 100px;height:100px;background-image:url('.$media_url.');background-size:contain;background-repeat:no-repeat;"></span>';
					$output .= '<button id="'.$this->get_field_id( $widget_field['id'] ).'" class="button select-media custommedia">Add Media</button>';
					$output .= '<input style="width: 19%;" class="button remove-media" id="buttonremove" name="buttonremove" type="button" value="Clear" />';
					$output .= '</p>';
					break;
				case 'textarea':
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'share' ).':</label> ';
					$output .= '<textarea class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" rows="6" cols="6" value="'.esc_attr( $widget_value ).'">'.$widget_value.'</textarea>';
					$output .= '</p>';
					break;
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'share' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}
?>
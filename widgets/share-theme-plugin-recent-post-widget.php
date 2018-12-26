<?php
class Share_Theme_Plugin_Recent_Post_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'share_Theme_Plugin_Recent_Post_widget',
			esc_html__( 'Share - Recent Posts With Thumbnail', 'share-theme-plugin' )
		);

		$this->initFields();
	}

	private $widget_fields = array();

	protected function initFields() {
		$this->widget_fields[] = array(
			'label' =>  __( 'Number of posts to show:' , 'share-theme-plugin' ),
			'id' => 'srwf_post_count',
			'type' => 'number',
		);
		$this->widget_fields[] = array(
			'label' => __( 'Display post date?', 'share-theme-plugin' ),
			'id' => 'srwf_show_post_date',
			'type' => 'checkbox',
		);
	}

	public function widget( $args, $instance ) {
		echo wp_kses_post($args['before_widget']);
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] :'';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['srwf_post_count'] ) ) ? absint( $instance['srwf_post_count'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['srwf_show_post_date'] ) ? $instance['srwf_show_post_date'] : true;

        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );

        $count = 1;

        if ($r->have_posts()) :
        ?>
        <?php if ( !empty($title) ) {
            echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
        } ?>
        <ul>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <?php if (has_post_thumbnail()) : 
                $class = 'has-thumbnail';
                else:
                $class = 'no-thumbnail';
                endif;
            ?>
            <li class="<?php echo esc_attr($class); ?>">
                <?php $url_thumbnail = get_the_post_thumbnail_url() ?>
				
				<?php if (has_post_thumbnail()) : ?>
	               <div class="post-image" style="<?php echo (esc_attr('background-image: url(\''.esc_url($url_thumbnail)).'\')');?>">
	                </div>
                <?php endif; ?>
                <div class="post-item">
                <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                <?php if ( $show_date ) : ?>
                    <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
                <?php endif; ?>
               </div>
            </li>
            <?php $count++; ?>
        <?php endwhile; ?>
        </ul>
        <?php echo wp_kses_post($args['after_widget']); ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();   

        endif;
        echo wp_kses_post($args['after_widget']);
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : '';
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$output .= '<p>';
					$output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'share' ).'</label>';
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'share' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'share' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
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
<?php
/*
Plugin Name: Widget plugin name
Description: Widget plugin description text
*/
/* Start Adding Functions Below this Line */
// Register and load the widget
function load_widget_plugin_name() {
  register_widget( 'widget_plugin_name' );
}
add_action( 'widgets_init', 'load_widget_plugin_name' );

// Creating the widget 
class widget_plugin_name extends WP_Widget {
  function __construct() {
    parent::__construct(
      // Base ID of your widget
      'widget_plugin_name', 
      // Plugin name will appear in UI
      __('Plugin Template', 'widget_plugin_name_domain'), 
      // Widget description
      array( 'description' => __( 'Simple plugin template', 'widget_plugin_name_domain' ), ) 
    );
  }

  // Creating widget front-end
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
    echo __( $instance[ 'title' ], 'widget_plugin_name_domain' );
    echo $args['after_widget'];
  }
        
  // Widget Backend 
  public function form( $instance ) {
    if ( isset( $instance['title'] ) ) {
      $title = $instance['title'];
    } else {
      $title = __( 'New title', 'widget_plugin_name_domain' );
    }
    // Widget admin form
    ?>
    <p>
<!-- Widget Title Form Entry -->    
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
      <hr>
    </p>
    <?php 
  }
  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
  }
} // Class widget_plugin_name ends here  
/* Stop Adding Functions Below this Line */
?>

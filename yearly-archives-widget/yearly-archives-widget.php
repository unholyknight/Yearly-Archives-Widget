<?php
/*
Plugin Name: Yearly Archives Widget
Description: Widget to list monthly archives under their associated year. This widget is great for adding custom JavaScript to create yearly dropdowns for lengthy monthly archives.
Version: 1.0
Author: Eric Lorentz
Author URI: http://www.ericlorentz.com/
*/

class Yearly_Archives_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'Yearly_Archives_Widget', 
      __( 'Yearly Archives' ), 
      array( 'description' => __( 'An archive list of the site\'s posts with months separated by year.' ) )
    );
  }
  
  private function _string_to_array( $string ) {
    $array = explode( ',', $string );
    array_pop( $array );
    return $array;
  }

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    echo $args['before_widget'];
    
    if ( ! empty( $title ) ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    
    $yearly_archives = wp_get_archives(
      array(
        'type'   => 'yearly',
        'format' => 'custom',
        'after'  => ',',
        'echo'   => 0,
      )
    );
    $yearly_archives = $this->_string_to_array( $yearly_archives );
    
    $monthly_archives = wp_get_archives(
      array(
        'type'   => 'monthly',
        'format' => 'custom',
        'after'  => ',',
        'echo'   => 0,
      )
    );
    $monthly_archives = $this->_string_to_array( $monthly_archives );

    if ( count( $yearly_archives ) > 0 ) {
      echo '<ul class="yearly-archives">';

      foreach ( $yearly_archives as $year_key => $year_string ) {
        $year = trim( strip_tags( $year_string ) );

        echo '<li>' . $year_string;
          echo '<ul class="monthly-archives">';

          foreach ( $monthly_archives as $month_key => $month_string ) {
            if ( strpos( $month_string, $year ) > 0 ) {
              echo '<li>' . $month_string . '</li>';
              unset( $monthly_archives[$month_key] );
            }
          }

          echo '</ul>';
        echo '</li>';
      }

      echo '</ul>';
    }
    
    echo $args['after_widget'];
  }
		
  public function form( $instance ) {
    if ( isset( $instance['title'] ) ) {
      $title = $instance['title'];
    } else {
      $title = __( 'Archives' );
    }
    
    echo '<p>
      <label for="' . $this->get_field_id( 'title' ) . '">' . _e( 'Title:' ) . '</label> 
      <input class="widefat" id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="text" value="' . esc_attr( $title ) . '" />
    </p>';
  }
	
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
  }
}

function wpb_load_widget() {
  register_widget( 'Yearly_Archives_Widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
?>
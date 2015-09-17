<?php
/*
Plugin Name: WP Job Manager Salary Field
Plugin URI: https://wpjobmanager.com/
Description: Adds salary field to the frontend and backend for WP Job Manager.
Version: 1.0
Author: Mike Jolley
Author URI: http://mikejolley.com
Requires at least: 4.1
Tested up to: 4.3
Text Domain: wp-job-manager
Domain Path: /languages

	Copyright: 2015 Mike Jolley
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Add your own function to filter the fields
add_filter( 'job_manager_job_listing_data_fields', 'admin_add_salary_field' );

    // Here we create the function for this custom field   
    function admin_add_salary_field( $fields ) {
  $fields['_job_salary'] = array(
    'label'       => __( 'Salary ($)', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => 'e.g. 20000',
    'description' => ''
  );
  return $fields;
}

// Add your own function to filter the fields
add_filter( 'submit_job_form_fields', 'frontend_add_salary_field' );

    // Here we create the function for this custom field   
function frontend_add_salary_field( $fields ) {
  $fields['job']['job_salary'] = array(
    'label'       => __( 'Salary ($)', 'job_manager' ),
    'type'        => 'text',
    'required'    => true,
    'placeholder' => 'e.g. 20000',
    'priority'    => 7
  );
  return $fields;
}

// Add your own function to filter the fields
add_action( 'single_job_listing_meta_end', 'display_job_salary_data' );

    // Here we create the function for this custom field   
   function display_job_salary_data() {
  global $post;

  $salary = get_post_meta( $post->ID, '_job_salary', true );

  if ( $salary ) {
    echo '<li>' . __( 'Salary:' ) . ' $' . esc_html( $salary ) . '</li>';
  }
}
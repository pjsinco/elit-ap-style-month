<?php
/**
 * Plugin Name: Elit AP Style Month
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Modify the month so it conforms to AP style
 * Version: 1.0.0
 * Author: Patrick Sinco
 * License: GPL2
 */

function elit_ap_style_month( $the_date, $d ) {
  // make sure we have a month to replace
  if ( elit_has_month_format( $d ) === False ) {
    return $the_date;
  }

  return elit_sub_in_ap_month( $d, $the_date );
}
add_filter( 'get_the_date', 'elit_ap_style_month', 90, 3 );

function elit_sub_in_ap_month( $d, $the_date ) {
  $month_info = elit_month_info( $the_date );
  $new_date = elit_replace_month( $the_date, $month_info );
  return $new_date;
}

function elit_replace_month( $the_date, $month_info ) {
  $new_date = str_replace( 
    $month_info['found_month'],  
    $month_info['ap_month'],
    $the_date
  );
  return $new_date;
}

function elit_month_info( $the_date ) {
  $elit_ap_months = array( 
    array(
    'abbrev_month' => 'Jan.',
    'full_month' => 'January',
    'ap_month' => 'Jan.',
    ),
    array(
    'abbrev_month' => 'Feb.',
    'full_month' => 'February',
    'ap_month' => 'Feb.',
    ),
    array(
    'abbrev_month' => 'Mar.',
    'full_month' => 'March',
    'ap_month' => 'March',
    ),
    array(
    'abbrev_month' => 'Apr.',
    'full_month' => 'April',
    'ap_month' => 'April',
    ),
    array(
    'abbrev_month' => 'May.',
    'full_month' => 'May',
    'ap_month' => 'May',
    ),
    array(
    'abbrev_month' => 'Jun.',
    'full_month' => 'June',
    'ap_month' => 'June',
    ),
    array(
    'abbrev_month' => 'Jul.',
    'full_month' => 'July',
    'ap_month' => 'July',
    ),
    array(
    'abbrev_month' => 'Aug.',
    'full_month' => 'August',
    'ap_month' => 'Aug.',
    ),
    array(
    'abbrev_month' => 'Sep.',
    'full_month' => 'September',
    'ap_month' => 'Sept.',
    ),
    array(
    'abbrev_month' => 'Oct.',
    'full_month' => 'October',
    'ap_month' => 'Oct.',
    ),
    array(
    'abbrev_month' => 'Nov.',
    'full_month' => 'November',
    'ap_month' => 'Nov.',
    ),
    array(
    'abbrev_month' => 'Dec.',
    'full_month' => 'December',
    'ap_month' => 'Dec.',
    ),
  );
  
  foreach ( $elit_ap_months as $month ) {

    $info = array();
   
    if ( stripos( $the_date, $month['abbrev_month'] ) !== False ) {
      
      $info['found_month'] = $month['abbrev_month'];
      $info['ap_month'] = $month['ap_month'];
      return $info;

    } elseif ( stripos( $the_date, $month['full_month'] ) !== False ) {

      $info['found_month'] = $month['full_month'];
      $info['ap_month'] = $month['ap_month'];
      return $info;

    }

  }

  return false;
}

function elit_has_month_format( $format ) {
  // case insensitive 
  return stripos( $format, 'm' );
}

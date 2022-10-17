<?php
/*
Plugin Name: List Orders
Description: Plugin that lists all orders from current month and total orders.
Version: 1.0.0
Author: Fernando Gomes
License: GPLv2 or later
*/


defined( 'ABSPATH' ) || exit;


add_shortcode( 'list_all' , 'list_all_orders' );
function list_all_orders(){
    $orders = wc_get_orders(
        array(
            'numberposts' => -1,  
             'billing_first_name' => 'FERNANDO',) 
    );

// Loop through each WC_Order object
echo "<h2>";
echo "Current Month" ;
echo "</h2>";
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Date Created</th>';
echo '<th>Total</th>';
echo '<th>Status</th>';
echo '</tr>';

foreach( $orders as $order ){
    $current_month = date('m');
    $order_data = $order->get_data(); 
    $month_created = $order_data['date_created']->date('m');
if($current_month == $month_created) {
    echo '<tr>';
    echo '<td>';
    echo $order->get_id(); // The order ID
    echo '</td>';
    echo '<td>';
    $order_data = $order->get_data(); 
    echo $order_data['billing']['first_name'];
    echo '</td>';
    echo '<td>';
    echo  $order_date_created = $order_data['date_created']->date('Y-m-d');
    echo '</td>';
    echo '<td>';
    echo $order_total = $order_data['total'];
    echo '</td>';
    echo '<td>';
    echo $order->get_status() . '<br>'; // The order status
    echo '</td>';
     echo '</tr>';
}
else {
    echo'your code';
}
}
echo '</table>';
echo '<br>';
echo "<h2>";
echo 'All Orders';
echo "</h2>";
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Date Created</th>';
echo '<th>Total</th>';
echo '<th>Status</th>';
echo '</tr>';

foreach( $orders as $order ){

    echo '<tr>';
    echo '<td>';
    echo $order->get_id(); // The order ID
    echo '</td>';
    echo '<td>';
    $order_data = $order->get_data(); 
    echo $order_data['billing']['first_name'];
    echo '</td>';
    echo '<td>';
    echo  $order_date_created = $order_data['date_created']->date('Y-m-d');
    echo '</td>';
    echo '<td>';
    echo $order_total = $order_data['total'];
    echo '</td>';
    echo '<td>';
    echo $order->get_status() . '<br>'; // The order status
    echo '</td>';
     echo '</tr>';

}
echo '</table>';
}




function add_my_custom_page() {
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( 'Orders List' ),
      'post_content'  => "[list_all]",
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
    );

    // Insert the post into the database
    wp_insert_post( $my_post );
}

register_activation_hook(__FILE__, 'add_my_custom_page');



?>
<?php

// Shortcode functions here
function _get_products(){
    $query = new WC_Product_Query(array(
        'post_type' => 'product',						
           'limit' => 8,
            'order' => 'DESC'
                ));
}
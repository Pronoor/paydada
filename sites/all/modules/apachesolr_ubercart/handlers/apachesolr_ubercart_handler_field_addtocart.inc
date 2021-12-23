<?php

/**
 * @file
 * Views handler: Product add to cart form field.
 */

class apachesolr_ubercart_handler_field_addtocart extends views_handler_field_node {

  function render($values) {
    // Implement rendering, if needed
    $output = "";
    if (uc_product_is_product($values->fields['bundle'])) {
      $type = node_type_get_type($values->fields['bundle']);
      $base = $type->base;
      $product = node_load($values->fields['entity_id']);
      if (function_exists($base . '_add_to_cart_form')) {
        $form = drupal_get_form($base . '_add_to_cart_form_' . $values->fields['entity_id'], $product);
        return drupal_render($form);
      }
    }
    return $output;
  }
}
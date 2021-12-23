<?php

/**
 * @file
 * Exposes apachesolr ubercart fields in views UI.
 *
 */

/**
 * Implementation of hook_views_data_alter()
 *
 * Exposes Ubercart fields and sorts to apachesolr views
 */
function apachesolr_ubercart_views_data_alter(&$data) {
  $data['apachesolr_node']['fss_sell_price'] = array(
    'title' => t('Product Sell Price'),
    'help' => t('Product Sell Price'),
    'field' => array(
      'handler' => 'apachesolr_ubercart_handler_field_money_amount',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
  
  $data['apachesolr_node']['ss_uc_addcart'] = array(
    'title' => t('Add to Cart'),
    'help' => t('Add to Cart Button'),
    'field' => array(
      'handler' => 'apachesolr_ubercart_handler_field_addtocart',
    )
  );
  $data['apachesolr_node']['fss_list_price'] = array(
    'title' => t('Product List Price'),
    'help' => t('Product List Price'),
     'field' => array(
      'handler' => 'apachesolr_ubercart_handler_field_money_amount',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
  
  $data['apachesolr_node']['sm_uc_product_image'] = array(
    'title' => t('Product Image'),
    'help' => t('Default image for products.'),
    'field' => array(
      //'string' => TRUE,
      'handler' => 'apachesolr_ubercart_handler_field_solr_image',
      'click sortable' => FALSE,
    )
  );
  $data['apachesolr_node']['ss_uc_sku'] = array(
    'title' => t('Product Model (SKU)'),
    'help' => t('Product Model'),
     'field' => array(
      'handler' => 'apachesolr_views_handler_field',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
  $data['apachesolr_node']['fss_uc_weight'] = array(
    'title' => t('Product Weight'),
    'help' => t('Product Weight'),
     'field' => array(
      'handler' => 'apachesolr_views_handler_field',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
  $data['apachesolr_node']['fss_uc_length'] = array(
    'title' => t('Product Length'),
    'help' => t('Product Length'),
    'field' => array(
      'handler' => 'apachesolr_views_handler_field',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
  $data['apachesolr_node']['fss_uc_width'] = array(
    'title' => t('Product Width'),
    'help' => t('Product Width'),
    'field' => array(
      'handler' => 'apachesolr_views_handler_field',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
  $data['apachesolr_node']['fss_uc_height'] = array(
    'title' => t('Product Height'),
    'help' => t('Product Height'),
    'field' => array(
      'handler' => 'apachesolr_views_handler_field',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
  $data['apachesolr_node']['fss_uc_position'] = array(
    'title' => t('Product List Position'),
    'help' => t('Product List Position'),
    'field' => array(
      'handler' => 'apachesolr_views_handler_field',
    ),
    'argument' => array(
      'handler' => 'apachesolr_views_handler_argument',
    ),
    'sort' => array(
      'handler' => 'apachesolr_views_handler_sort',
    ),
  );
}

<?php

/**
 * @file
 * Views handler: Product price field.
 */

/**
 * Return a formatted price value to display in the View.
 */
class apachesolr_ubercart_handler_field_money_amount extends views_handler_field_node {
  function query() {
    $this->field_alias = $this->query->add_field('apachesolr_node' , $this->options['id']);
  }
  
  
  function option_definition() {
    $options = parent::option_definition();
     $options['format'] = array('numeric' => TRUE);
    return $options;
  }
  
  function options_form(&$form, &$form_state) {
    $price_format = array(
      'numeric' => t('Numeric'),
      'uc_price' => t('Currency')
    );
    $form['format'] = array(
      '#title' => t('Format'),
      '#type' => 'select',
      '#options' => $price_format,
      '#default_value' => $this->options['format'],
    );
  }  
  /**
   *
   */
  function render($values) {
    if ($this->options['format'] == 'numeric') {
      return $values->fields[$this->options['id']];
    }

    if ($this->options['format'] == 'uc_price') {
      return uc_currency_format($values->fields[$this->options['id']]);
    }
  }

}

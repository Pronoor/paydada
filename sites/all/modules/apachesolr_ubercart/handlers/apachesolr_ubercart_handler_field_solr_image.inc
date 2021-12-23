<?php

/**
 * @file
 * Views handler: Product image field.
 */
 
class apachesolr_ubercart_handler_field_solr_image extends views_handler_field_node {
  function query() {
    $this->field_alias = $this->query->add_field('apachesolr_node' , $this->options['id']);
  }
  
  function option_definition() {
    $options = parent::option_definition();
    $options['image_style'] = array(t('None (original image)') => FALSE);
    $options['image_link'] = array(t('Nothing') => "nothing");
    return $options;
  }
  
  function options_form(&$form, &$form_state) {
    $image_styles = image_style_options(FALSE);
    $form['image_style'] = array(
      '#title' => t('Image style'),
      '#type' => 'select',
      '#default_value' => $this->options['image_style'],
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
    );

    $link_types = array(
      'content' => t('Content'),
      'file' => t('File'),
    );
    $form['image_link'] = array(
      '#title' => t('Link image to'),
      '#type' => 'select',
      '#default_value' => $this->options['image_link'],
      '#empty_option' => t('Nothing'),
      '#options' => $link_types,
    );

    parent::options_form($form, $form_state);
  }
  
  function render($values) {
    // Implement rendering, if needed
    $output = '';
    // TODO: put link to the image
    if ($this->options['image_style']) {
      if (count($values->fields[$this->options['id']])) {
        foreach ($values->fields[$this->options['id']] as $value) {
          if ($this->options['image_link']) {
            switch ($this->options['image_link']) {
              case 'content':
                $output = l(theme('image_style', array( 'path' =>  $value, 'style_name' => $this->options['image_style'])), $values->fields['url'], array('html' => TRUE));
              break;
              case 'file':
                $output = l(theme('image_style', array( 'path' =>  $value, 'style_name' => $this->options['image_style'])), file_create_url(file_build_uri($value)), array('html' => TRUE));
              break;
            }
          }
          elseif ($this->options['link_to_node']) {
            $output = l(theme('image_style', array( 'path' =>  $value, 'style_name' => $this->options['image_style'])), $values->fields['url'], array('html' => TRUE)); 
          }
          else {
            $output = theme('image_style', array( 'path' =>  $value, 'style_name' => $this->options['image_style'])); 
          }
        }
      }
    } 
    else {
      if (count($values->fields[$this->options['id']])) {
        foreach ($values->fields[$this->options['id']] as $value) {
          $image_path = file_create_url(file_build_uri($value));
          if ($this->options['image_link']) {
            switch ($this->options['image_link']) {
              case 'content':
                $output = l(theme('image', array('path' => $image_path)), $values->fields['url'], array('html' => TRUE));
              break;
              case 'file':
                $output = l(theme('image', array('path' => $image_path)), $image_path, array('html' => TRUE));
              break;
            }
          }
          elseif ($this->options['link_to_node']) {
            $output = l(theme('image', array('path' => $image_path)), $values->fields['url'], array('html' => TRUE)); 
          }
          else {
            $output = theme('image', array('path' => $image_path)); 
          }
        }
      }
    }
    return $output;
  }
}
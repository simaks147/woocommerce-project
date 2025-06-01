<?php

add_action('customize_register', 'wooprj_customizer');

function wooprj_customizer($wp_customize)
{
  // theme options section
  $wp_customize->add_section('wooprj_theme_options', array(
    'title' => __('Theme Options', 'wooprj'),
    'priority' => 10
  ));

  // phone
  $wp_customize->add_setting('wooprj_phone');
  $wp_customize->add_control('wooprj_phone', array(
    'label' => __('Phone Number', 'wooprj'),
    'section' => 'wooprj_theme_options',
  ));

  // youtube
  $wp_customize->add_setting('wooprj_youtube');
  $wp_customize->add_control('wooprj_youtube', array(
    'label' => __('Youtube', 'wooprj'),
    'section' => 'wooprj_theme_options',
  ));

  // facebook
  $wp_customize->add_setting('wooprj_facebook');
  $wp_customize->add_control('wooprj_facebook', array(
    'label' => __('Facebook', 'wooprj'),
    'section' => 'wooprj_theme_options',
  ));

  // instagram
  $wp_customize->add_setting('wooprj_instagram');
  $wp_customize->add_control('wooprj_instagram', array(
    'label' => __('Instagram', 'wooprj'),
    'section' => 'wooprj_theme_options',
  ));
}
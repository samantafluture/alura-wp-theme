<?php

function alura_registrando_post_customizado(){
    register_post_type('destinos', 
        array(
            'labels' => array('name' => 'Destindos'),
            'public' => true,
            'menu_position' => 0,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-admin-site'
        )
    );
}

add_action('init', 'alura_registrando_post_customizado');

function alura_adicionando_recursos_ao_tema(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'alura_adicionando_recursos_ao_tema');

function alura_registrando_menu(){
    register_nav_menu( 
        'menu-navegacao',
        'Menu navegação'
     );
}

add_action('init', 'alura_registrando_menu');
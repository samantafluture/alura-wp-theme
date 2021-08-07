<?php

function alura_registrando_taxonomia(){
    register_taxonomy(
        'paises',
        'destinos',
        array(
            'labels' => array('name' => 'Países'),
            'hierarchical' => true
        )
    );
}

add_action('init', 'alura_registrando_taxonomia');

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

function alura_registrando_post_customizado_banner(){
    register_post_type('banners', array(
        'labels' => array('name' => 'Banner'),
        'public' => true,
        'menu_position' => 1,
        'menu_icon' => 'dashicons-format-image',
        'supports' => array('title', 'thumbnail')
    ));
}

add_action('init', 'alura_registrando_post_customizado_banner');

function alura_registrando_metabox(){
    add_meta_box(
        'alura_registrando_metabox',
        'Texto para a home',
        'alura_funcao_callback',
        'banners'
    );
}

add_action('add_meta_boxes', 'alura_registrando_metabox');

function alura_funcao_callback($post){
    $texto_home_1 = get_post_meta($post->ID, '_texto_home_1', true);
    $texto_home_2 = get_post_meta($post->ID, '_texto_home_2', true);
    ?>
    <label for="texto_home_1">Texto 1</label>
    <input type="text" name="texto_home_1" style="width: 100%"/ value="<?= $texto_home_1 ?>">
    <br>
    <br>
    <label for="texto_home_2">Texto 2</label>
    <input type="text" name="texto_home_2" style="width: 100%"/ value="<?= $texto_home_1 ?>">
    <?php
}

function alura_salvando_dados_metabox($post_id){
    foreach($_POST as $key=>$value){
        if($key !== 'texto_home_1' && $key !== 'texto_home_2'){
            continue;
        }

        update_post_meta(
            $post_id,
            '_' . $key,
            $_POST[$key]
        );
    }
}

add_action('save_post', 'alura_salvando_dados_metabox');
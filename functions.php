<?php

function alura_registrando_menu(){
    register_nav_menu( 
        'menu-navegacao',
        'Menu navegação'
     );
}

add_action('init', 'alura_registrando_menu');
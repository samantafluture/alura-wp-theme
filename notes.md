# Como criar um tema Wordpress do zero

## Preparar ambiente

**MAMP**

- Fazer o download do [Mamp](https://www.mamp.info/en/mac/)
- Clicar em "start" para colocar o servidor no ar
- Visite `localhost:8888` para confirmar que subiu

**Banco de dados**

- Criar um banco de dados a ser usado no Wordpress
- No Mamp, clique na aba `databases`, clique no `+` e nomeie seu banco de dados (exemplo: `wordpress`)
- Dê um restart no servidor Mamp
- Vá em `localhost:8888/phpMyAdmin` e veja se seu banco de dados foi criado

**Wordpress**

- Baixe o zip com a última versão do [Wordpress](https://br.wordpress.org/download/)
- Extraia a pasta `wordpress`
- Copie e cole a pasta para dentro da pasta `localhost` no `(usuario do mac)/Sites`
- Dentro desta pasta, abra o arquivo `wp-config-sample.php`
- Substiua os parâmetros `database_name`, `username` e `password` para o nome do seu banco de dados criado anteriormente (exemplo: `wordpress`)
- Substitui o restante por `root`
- Salve e renomeie o arquivo para `wp-config.php`
- Restart o servidor Mamp
- Visite `localhost:8888/wordpress`
- Faça a instalação seguindo os passos e preenchendo seus dados (os mesmos da configuração e também seu usuário, senha e acesso ao painel de administração)
- Visite `localhost:8888/wordpress/wp-admin` para fazer o login!

## Acessos

- Acessar banco de dados [phpMyAdmin](http://localhost:8888/phpMyAdmin5/)
- Acessar [painel do Wordpress](http://localhost:8888/wordpress/wp-admin/)
- Acessar [blog Wordpress](http://localhost:8888/wordpress/)

## Onde os temas ficam armazenados?

Os temas ficam dentro da sua pasta, acessando ``wp-content/themes`. Exemplo de caminho completo: `/wordpress/wp-content/themes.

Este tema está como o diretório `alura-theme`, dentro da pasta 'themes'.

Para o tema aparecer na área de Temas do painel, adicione os seguintes arquivos na pasta:
- style.css
- index.php
- screenshot.jpg (para ser a thumbnail do tema)

Dentro do `style.css`, incluir a descrição do seu tema dentro de comentários:

```css
/*
Theme Name: 
Author: 
Description: 
Version: 
Tags: 
*/  
```

## Header 

- inserir as tags html de um documento comum (até o `<body>`)
- dentro do `<title>`, torná-lo dinâmico para que o usuário possa mudar o título depois

### Título dinâmico

- inserir a função do WP `bloginfo();` dentro da tag `<title>`

`<title><?php bloginfo( 'name' ); ?></title>`

- antes de fechar o `<header>`, inserir uma tag do WP de cabeçalho, para que ele reconheça

`<?php wp_head(); ?>`

## Footer

- fechar as tags `</body>` e `</html>`
- entre elas, antes de fechar o html, inserir uma tag do WP para ele reconhecer que é um footer

`<?php wp_footer(); ?>`

## Index.php

- importar aqui os dois arquivos criados
- usar `require_once`




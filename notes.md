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
- Substitua o restante por `root`
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

## Primeiros arquivos

### header.php 

- inserir as tags html de um documento comum (até o `<body>`)
- dentro do `<title>`, torná-lo dinâmico para que o usuário possa mudar o título depois

**Título dinâmico**

- inserir a função do WP `bloginfo();` dentro da tag `<title>`

`<title><?php bloginfo( 'name' ); ?></title>`

- antes de fechar o `<header>`, inserir uma tag do WP de cabeçalho, para que ele reconheça

`<?php wp_head(); ?>`

### footer.php

- fechar as tags `</body>` e `</html>`
- entre elas, antes de fechar o html, inserir uma tag do WP para ele reconhecer que é um footer

`<?php wp_footer(); ?>`

### index.php

- importar aqui os dois arquivos criados
- usar `require_once`

### functions.php

- toda vez que quisermos adicionar uma funcionalidade que não está no painel, devemos criar uma função dentro do arquivo `functions.php`
- um exemplo seria adicionar menus

## Fazendo o header

### Menu

- criar uma função com um nome que já diz o que fará e referencia o tema (exemplo: `alura_registrando_menu()`)
- chamar dentro dela a função wordpress que registra um menu de navegação: `register_nav_menu()`

```php
function alura_registrando_menu(){
    register_nav_menu( 
        'menu-navegacao',
        'Menu navegação'
     );
}
```

**Action hooks**

- para funcionar, deve-se depois adicionar um `action hook`
- quando o wp executa seu código interno, nós podemos enganchar novas funções
- sem o `action hook`, o wp não sabe em que momento o código deverá ser executado
- por isso, depois de registrar o menu, temos que adicioná-lo
- neste hook, colocamos quando a função deve ser executada (exemplo: ao iniciar, `init`), e qual esta função (exemplo: a função criada acima `alura_registrando_menu`)

```php
add_action('init', 'alura_registrando_menu');
```

- em seguida, já irá aparecer a seção `Menu` dentro de `Aparência` no painel
- porém mesmo após criar o menu no painel, ele ainda não vai aparecer no site
- pois ainda precisamos falar onde

**Especificar onde menu deverá ser exibido**

- ir ao header.php onde está o html
- abaixo da tag `<body>`, inserir uma função php que irá chamar o menu neste local
- a função será `wp_nav_menu()`
- essa função espera receber um array
- temos certas chaves que podemos passar dentro deste array
- por exemplo: `menu` (o menu que desejamos, aceita id, slug, nome ou objeto); `menu_class` e `menu_id` (para fins de css -> vamos fazer isso depois), entre outros
- neste caso, vamos usar o `slug` que adicionamos na função (`menu-navegação`) como valor da chave `menu` para ser exibido

```php
<?php wp_nav_menu(
    array(
        'menu' => 'menu-navegacao'
    )
); ?>
```

### Logo

- precisamos acionar a função de adicionar o logo dentro do menu `personalizar`
- para que o usuário possa mudar o logo assim como ele pode mudar o título
- deve ser dinâmico
- precisamos criar uma nova função para dar suporte a isso

**Criar função para adicionar diferentes recursos ao tema**

- iremos criar uma função que pode ter outras funções, cada uma para adicionar novos recursos ao tema
- uma destas funções será a de `add_theme_support`, que poderá receber como argumento as features/recursos a serem acrescentados
- neste caso, recebe a feature `custom-logo` como argumento

```php
function alura_adicionando_recursos_ao_tema(){
    add_theme_support( 'custom-logo' );
}
```

**Action hooks**

- precisa adicionar um action hook para falar quando isso deverá ser executado
- o hook será o `add_action('after_setup_theme');`
- ou seja, será executado após o tema ser carregado
- como segundo argumento, linkar a função a ser chamada

```php
add_action('after_setup_theme', 'alura_adicionando_recursos_ao_tema');
```

**Mostrar o logo na tela**

- depois de falar onde deverá ser executado, deveremos no `header.php` adicionar a função no lugar onde isso deverá ser mostrado
- dentro da tag php, acima do menu navegação, adicionar `the_custom_logo();`

### Estilização

- colocar a referência dos arquivos no header.php em tag html de link:css
- fazer o link ser dinâmico (o caminho url)
- abrir tags dentro das aspatas `<?= ?>`
- colocar a função php que vai imprimir o diretório raiz do meu tema
- `<?= get_template_directory_uri() ?>`
- depois concatenar com o diretório /css a ser acessado e o arquivo em questão

```html
<link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/normalize.css' ?>">
<link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/bootstrap.css' ?>">
<link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/header.css' ?>">
```

- precisamos pedir agora para que o wordpress adicione classes em nossos componentes
- para que possamos puxar os estilos nos css
- `<body <?php body_class(); ?>> ` 
- as classes fixas, adicionamos à mão nas tags html

## Fazendo as páginas

### Suporte à imagem

**Criar função**

- ao fazer uma postagem de página, não há suporte para colocar imagem como destaque
- precisamos adicionar este recurso em nossa função de recursos
- adicionar `add_theme_support('post-thumbnails');`

**Adicionar na tela**

- porém ainda não está aparecendo o conteúdo após publicar!
- isso porque precisamos ir no arquivo `index.php` e falar onde as coisas vão aparecer

### Loop do Wordpress

- tem como objetivo mostrar o conteúdo na página
- mesmo que seja uma página, é tratado como `post` em nomenclatura 

```php
if(have_posts()):
    while(have_posts()): the_post();
        the_post_thumbnail();
        the_title();
        the_content();
    endwhile;
endif;
```

1. se tem conteúdo -> vou pedir pro wp mostra este conteúdo pra mim
2. enquanto tiver conteúdo -> wp vai mostrar pra mim
3. o wp vai referencer os conteúdo colocando um "ponteiro" em cada post 
4. esta referência feita é o `the_post`
5. dentro, deve-se referenciar em ordem do que deve aparecer na tela: a imagem em destaque, o título e o conteúdo (corpo do texto)

### Estilização

- criar uma variável $estiloPagina e usá-la para carregar o arquivo .css da página em que o usuário estiver
- dessa forma, fica dinâmico e não carrega todas ao mesmo tempo
- apenas a que estiver referente à página atual

- assim como no header.php, o index deve ser envolvido com tags html e classes para aplicação do css
- quando um elemento dinâmico precisa de classes de estilo, estas devem ser passadas como argumento

Exemplos:

`the_post_thumbnail('post-thumbnail', array('class' => 'imagem-sobre-nos'));`
`the_title('<h2>', '</h2>');`

- se precisa de tags html as está dentro do código/loop php
- pode inserir estas usando o comando `echo`

Exemplo

`echo '<div class="conteudo container-alura">';`
`echo '</div>';`

- o loop wp final com estilos ficará assim, para uma das páginas

```php
if(have_posts()):
    ?>
    <main class="main-sobre-nos">
        <?php
        while(have_posts()): the_post();
            the_post_thumbnail('post-thumbnail', array('class' => 'imagem-sobre-nos'));
            echo '<div class="conteudo container-alura">';
                the_title('<h2>', '</h2>');
                the_content();
            echo '</div>';
        endwhile;
        ?>
    </main>
<?php
endif;
```

## Fazendo o rodapé

- usar a função `date()` para imprimir o ano 
- `<?= date("Y") ?>`

## Hierarquia dos templates

- existe algum arquivo específico para a página x?
- se sim, exibir template mais específico para esta página x
- se não, vai exibir template mais genérico para a página x (outros possíveis)
- até chegar no mais genérico de todos = `index.php`

![hierarquia-template-wordpress](https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png)

- cortar e colar tudo o que está na `index.php` para a página `page-sobre-nos.php`
- o `sobre-nos` é o `slug da página`
- assim esta é uma página específica e só será mostrada quando o usuário entrar nela
- agora temos que construir as outras páginas

## Posts customizados

### Criando tipos de posts customizados

- podemos criar uma área no painel para adicionar um tipo de post customizado
- criar uma função que registra esse recurso
- dentro dela, chamar a função `register_post_type` que receberá dois parâmetros: o nome entre '' deste custom post e um array
- este array deverá conter tudo o que terá features: qual o nome, se é público, qual posição irá aparecer, quais recursos irá suportar (ex: título, texto/editor e imagem thumbnail de destaque), e um ícone para o menu

```php
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
```

- em seguida, criar o action hook

`add_action('init', 'alura_registrando_post_customizado');`

### Taxonomia

- conceito de agrupar dados de acordo com uma característica em comum
- neste caso, vamos agrupar os posts customizados por países

**Criar a função de taxonomia**

- podemos criar nosso próprio agrupamento dentro dos posts customizados
- para isso, usar a função `regiter_taxinomy()`
- recebe 3 parâmetros: 
    - um string como o nome da taxonomia em questão (neste caso, `paises`)
    - o tipo de post a qual ela vai se vincular (o custom post criado acima, ou seja, 'destinos)
    - um array passando o `label` a ser usado (que irá aparecer no painel, neste caso, `Destinos`), e se é hierárquico ('true')

```php
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
```

- em seguida, o action hook: `add_action('init', 'alura_registrando_taxonomia');`

### WP_Query

- mesmo adicionando o `wp loop` na página `page-destinos.php`, os posts customizados do tipo `destinos` ainda não aparecem
- isso porque o loop não está referenciando o tipo de post `destinos`
- mas sim o padrão, que seria o conteúdo da página em si
- por isso, é preciso modificar o loop

1. instaciar a classe `WP_Query`, guardando seu valor na variável `$query` e recebendo uma variável `$args`

`$query = new WP_Query($args);`

2. passar para a variável `$args` um array que determina o tipo de post que deverá ser buscado / referenciado

`$args = array('post_type' => 'destinos');`

3. vincular o loop com esta query, a chamando em cada uma das 3 etapas

```php
if ($query->have_posts()):
    while($query->have_posts()): $query->the_post();
        the_post_thumbnail();
        the_title();
        the_content();
    endwhile;
endif;
```

### Formulários

- quando é Objects eu atribuo valor com `->`
- quando é array eu atribuo valor com `[]`
- criar um form com tags html

**Deixando o form dinâmico**

- a primeira coisa é usar a função `get_terms()` que recebe um array
- este array deverá ter a taxonomia criada como chave e valor
- guardar o resultado desta função (ou seja, as tags de países) dentro da variável `$paises`
- depois, abrir um for each
- este for earch irá criar tags `<option>` para cada `tag` de país criada pelo usuário no sistema
- para imprimir o nome da tag de forma correta, deve-se passar o valor do objeto usando uma `->` 

```php
<?php 
    $paises = get_terms(array('taxonomy' => 'paises'));
    foreach($paises as $pais): 
    ?>
        <option value="<?= $pais->name ?>">
            <?= $pais->name ?>
        </option>
    <?php 
    endforeach;
    ?>
```

- a função `get_terms()` é responsável por trazer os campos de uma determinada taxonomia

### Aplicando filtro no form

- para criar um filtro no form, temos que acrecentar um novo parâmetro na `$query`
- além de pegar o tipo de post, temos que pegar a taxonomia via busca (`tax_query`)
- dessa forma somos capazes de buscar os destinos que foram vinculados ao país filtrado
- guardamos esse valor em uma variável `$paisSelecionado`

```php
$args = array(
    'post_type' => 'destinos',
    'tax_query' => $paisSelecionado
);
```

- em seguida, vamos criar essa variável, que recebe um array dentro de outro array
- neste array vai ter: a taxonomia que queremos, o campo que queremos, e o que queremos fazer (no caso, faz um método `GET` para pegar os posts que estão com determina taxonomia via busca) usando o `$_GET`

```php
$paisSelecionado = array(array(
    'taxonomy' => 'paises',
    'field' => 'name',
    'terms' => $_GET['paises']
));
```

- porém o filtro não deve ser ativado se estivermos na opção "selecione"
- nesta opção, ainda devem aparecer todos os países/conteúdos
- colocar o array `$paisSelecionado` dentro de um if condicional
- o filtro deverá funcionar apenas se estiver sendo feita uma requisição GET
- caso contrário, mostrar tudo como anteriormente

```php
if(!empty($_GET['paises'])) {
    $paisSelecionado = array(array(
        'taxonomy' => 'paises',
        'field' => 'name',
        'terms' => $_GET['paises']
    ));
}
```

- além disso, a variável `$paisSelecionado`, se não tiver GET, deve ser vazia no array cuja sua chave é `tax_query`
- ao filtrar um dterminado país, a chave `paises` terá como valor o país sendo filtrado
- assim o valor da chave não seria vazio e a primeira condição acima será executada
- trazendo todos os posts do país filtrado

```php
$args = array(
    'post_type' => 'destinos',
    'tax_query' => !empty($_GET['paises']) ? $paisSelecionado : ''
);
```

- por fim, devemos manter o nome do país quando filtramos
- então o option deve ter o atribute `selected` dentro de sua tag html
- faremos mais um ternário para imprimir esta condição dentro do html

```php
<?= !empty($_GET['paises']) && $_GET['paises'] == $pais->name ? 'selected' : '' ?>>
```

## Home

**Home como página estática**

- criar uma págona `front-page.php` onde vai tudo o que aparecerá na home estática
- mudar a configuração de `leitura` no painel para `página estática` -> `home`

**Novo recurso de banner para home**

- mais uma função para criar um `custom post type`
- seguindo os mesmos passos do tipo `Destinos`
- chama a função `register_post_type`
- no primeiro argumento, chama este tipo de post de `banners`
- no segundo, passa todas as configs dele (o nome 'Banner', seu vai aparecer a todos, qual posição que vai aparecer no painel, o ícone e o que irá ter de recursos)

```php
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
```

### Configurando metabox

**Criar metaboxes customizados**

- o recurso de adicionar um banner na home também deve ter, além de imagem e título, dois campos de textos
- ou seja, ao entrar na área de banners, deverão ter campos de textos 
- estes campos serão criados através de metaboxes customizados
- para isso, temos que configurar metaboxes
- criar uma função que execute a `add_meta_box()`
- ela deverá receber como parâmetros:
    - o id deste metabox (uma string)
    - a descrição deste metabox (uma string)
    - o nome de uma função callback que deverá executar (uma string)
    - o tipo de post customizado criado ao qual estará linkado (uma string)
- depois, adicionar o action hook específico de metaboxes

```php
function alura_registrando_metabox(){
    add_meta_box(
        'alura_registrando_metabox',
        'Texto para a home',
        'alura_funcao_callback',
        'banners'
    );
}
add_action('add_meta_boxes', 'alura_registrando_metabox');
```

- em seguida, criar a função callback que demos nome acima
- ela recebe uma variáve; $post do próprio wp
- dentro dela, tags html para criar inputs onde o usuário irá digitar textos

```php
function alura_funcao_callback($post){
    ?>
    <label for="texto_home_1">Texto 1</label>
    <input type="text" name="texto_home_1" style="width: 100%"/>
    <br>
    <br>
    <label for="texto_home_2">Texto 2</label>
    <input type="text" name="texto_home_2" style="width: 100%"/>
    <?php
}
```

**Salvar dados metabox**

- agora precisamos falar para o wp o que fazer com estes inputs recebidos


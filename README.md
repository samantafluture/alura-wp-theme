# Criando um tema Wordpress do zero

Tecnologias usadas:

- PHP
- Wordpress
- Mamp (MySQL, Apache, PHP no macOs)

## Tutorial completo

Junto do código, é possível ler o passo a passo de como criar o projeto nos links abaixo.

1. [Preparar ambiente](https://github.com/samantafluture/alura-wp-theme/blob/main/notes.md#preparar-ambiente)
2. [Primeiros arquivos](https://github.com/samantafluture/alura-wp-theme/blob/main/notes.md#primeiros-arquivos)
3. [Fazendo o header](https://github.com/samantafluture/alura-wp-theme/blob/main/notes.md#fazendo-o-header)
4. [Fazendo as páginas](https://github.com/samantafluture/alura-wp-theme/blob/main/notes.md#fazendo-as-p%C3%A1ginas)
5. [Fazendo o rodapé](https://github.com/samantafluture/alura-wp-theme/blob/main/notes.md#fazendo-o-rodap%C3%A9)
6. [Posts customizados](https://github.com/samantafluture/alura-wp-theme/blob/main/notes.md#posts-customizados)
7. [Criando uma home estática](https://github.com/samantafluture/alura-wp-theme/blob/main/notes.md#posts-customizados)


## Instalar MAMP e Wordpress no macOS

Como tive difuldade de início para ter um ambiente no macOs preparado para produção local de Wordpress, fiz um breve tutorial abaixo.

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
- Copie e cole a pasta para dentro da pasta `htdocs` no `Applications/Mamp` ou na pasta `localhost` no `(usuario do mac)/Sites` (dependendo de onde seu servidor estiver)
- Dentro desta pasta, abra o arquivo `wp-config-sample.php`
- Substiua os parâmetros `database_name`, `username` e `password` para o nome do seu banco de dados criado anteriormente (exemplo: `wordpress`)
- Substitui o restante por `root`
- Salve e renomeie o arquivo para `wp-config.php`
- Restart o servidor Mamp
- Visite `localhost:8888/wordpress`
- Faça a instalação seguindo os passos e preenchendo seus dados (os mesmos da configuração e também seu usuário, senha e acesso ao painel de administração)
- Visite `localhost:8888/wordpress/wp-admin` para fazer o login!

---

Projeto desenvolvido seguindo os [cursos e materias da Alura](https://www.alura.com.br/) sobre PHP e Wordpress.
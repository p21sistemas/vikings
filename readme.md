# Gerenciador de Cartórios

O Gerenciador de Cartórios é uma pequena aplicação em PHP orientado a objeto utilizando framework laravel. Serve para gerenciar cartórios, importar dados via XML e exportar lista de cartórios em Excel.

Foi desenvolvida para fazer parte da seleção da vaga de Desenvolvedor(a) PHP Pleno oferecida pela empresa P21 Sistemas.

## Requesitos do Sistema

Para o ideal funcionamento da aplicação será necessário que o servidor atenda aos seguintes requesitos:
1. Servidor Apache;
2. Banco de Dados MySQL;
3. PHP >= 7.2.5;
    - BCMath PHP Extension
    - Ctype PHP Extension
    - Fileinfo PHP extension
    - JSON PHP Extension
    - Mbstring PHP Extension
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
4. Composer;

## Instalação do Sistema

Procedimentos para instalação do sistema:

1. Clonar o repositório do projeto no GitHub:
```
git clone https://github.com/luizrjunior/vikings.git
```
2. Criar o schema <i>"cartorios_db_desenv"</i> no banco de dados (MySQL);
3. Configurar no arquivo <i>".env"</i> a conexão com banco de dados. Exemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cartorios_db_desenv
DB_USERNAME=root
DB_PASSWORD=
```
4. Instalar as dependencias
```
composer install
```
5. Gerar as Tabelas do Banco de Dados
``` 
php artisan migrate
```
6. Acessar no navegador
``` 
http://localhost/vikings/public
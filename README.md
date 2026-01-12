## BrasilAPI CEP v2 Consumer 🌎

Este projeto é um CRUD, feito em Laravel 12, voltado para o estudo do consumo de API's no ambiente de desenvolvimento, fazendo o uso da CEP v2, da BrasilAPI, que retorna informações sobre endereços, e também sua localidade (longitude e latitude).

## Pré-Requisitos 🎯

- PHP 8.3
- Composer

## Passo a passo 🧑🏻‍💻

- Dentro de um ambiente Linux:
    - *Instalar o PHP e Composer*
        - sudo apt update && sudo apt upgrade -y
        - sudo apt install -y php8.3
        - sudo apt install -y composer
        - Para clonar o projeto: git clone https://github.com/KelvinPilger/CEP-API-Consumer.git
    - *Instalar e inicializar o projeto (Laravel)*
        - composer require laravel/sail --dev
        - php artisan sail:install (Escolher apenas o PostgreSQL)
        - Ajustar o .env para os dados do banco de dados.
        - Inicializar o contâiner Docker acoplado do Laravel com o comando: **./vendor/bin/sail up**
        - Ao inicializar, rodar o comando: **sail artisan migrate**, para rodar as migrations.

- *_Link da Collection do Postman para testar as rotas:_* https://drive.google.com/file/d/1CYPFzCcOQzEca26MuZxzDwhH5FrrIz2O/view?usp=sharing

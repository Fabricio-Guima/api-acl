# Projeto feito em laravel para associar determinadas permissões a um ou vários usuários
O que você encontrará neste projeto:
- Camada de repositório
- Camada DTO
- Criação de middleware para validar se ou usuário tem ou não tal permissão
- Super admins tem controle total do sistema
- CRUD de usuários
- CRUD de permissões
- Vincular N permissões a um usuário
- Validação do que vem na request utilizando "request validation"
- Formatar os dados de saída utilizando "resource"
- utilização de "with" para carregar certos relacionamentos
- utilização do load para carregar um certo relacionamento
- Login/Logout
- Recuperar informações do usuário pela rota "/me" caso o token dado esteja válido
- Docker e alguns containers para o funcionamento do sistema

## Setup Docker Laravel 10 com PHP 8.1

### Passo a passo

Clone Repositório

```sh
git clone https://github.com/Fabricio-Guima/api-acl.git
```

```sh
cd api-acl
```

Crie o Arquivo .env

```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env

```dosini
APP_NAME="api-acl"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Suba os containers do projeto

```sh
docker-compose up -d
```

Acesse o container app

```sh
docker-compose exec app bash
```

Instale as dependências do projeto

```sh
composer install
```

Gere a key do projeto Laravel

```sh
php artisan key:generate
```

## Instalando o Pest para testar o código:
```sh
composer remove phpunit/phpunit
composer require pestphp/pest --dev --with-all-dependencies
```

```sh
./vendor/bin/pest --init
```

```sh
composer require pestphp/pest-plugin-laravel --dev
```
Rodar os testes após serem feitos:
```sh
./vendor/bin/pest
```
Crie no arquivo "composer.json" um atalho para o comando "./vendor/bin/pest" dentro de scripts

```sh
"test": [
            "./vendor/bin/pest"
        ]
```

Agora em seu terminal será necessário rodar o comando abaixo para ver seus testes em ação:
```sh
composer test
```

Acesse o projeto
[http://localhost:8989](http://localhost:8989)

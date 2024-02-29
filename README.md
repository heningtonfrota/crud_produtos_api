
# Crud Api Laravel 10 com PHP 8.2

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/heningtonfrota/crud_produtos_api.git api
```
```sh
cd api
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="API CRUD"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

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

Após o projeto configurado:
```sh
php artisan migrate --seed
```

Obs: O usuario que é criado na factory é: 
    - email: super_user@example.com
    - senha: password

Usuario gerado pela factory já esta cadastrado como super_user no arquivo: config/acl.php

Pode-se adicionar outros emails para transformar outros usuarios em super_user

O cadastro de permissoes por tela ainda não implementado. Mas pode ser realizado direto no banco de dados.

Acesse o projeto
[http://localhost](http://localhost)

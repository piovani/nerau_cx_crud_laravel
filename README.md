

# Executar Aplicação com Docker

1 .
```
docker network create nerau_cx_crud_laravel-network
```

2 .
```
docker volume create --name=nerau_cx_crud_laravel-database
```

3 .
```
docker-compose up -d
```


# Configurações Iniciais da Aplicação

1 .
Na pasta da aplicação. Copie o arquivo ".env.example" criando um novo arquivo chamado ".env'

2 .
Execute o seguinte comando:
```
php artisan migrate
```

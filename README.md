# gerenciador-de-tarefas

## Começando

## Clone o repositório para sua máquina local
```
git clone https://github.com/your-username/your-project.git
```

## Mude para o diretório do projeto
```
cd your-project
```

## Instale as dependências do Node.js
```
npm install
```

## Instale as dependências do PHP
```
composer install
```

## Configuração

### Crie uma cópia do arquivo .env.example e renomeie-o para .env
```
cp .env.example .env
```

### Abra o arquivo .env em um editor de texto e modifique as seguintes configurações para corresponder ao seu ambiente:
```
DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=your-database-port
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

## Configuração do banco de dados

## Migre as tabelas do banco de dados executando o seguinte comando:
```
php artisan migrate
```

## Construir e Executar

## Compile o front-end usando o seguinte comando
```
Navegue até a pasta gerenciador-de-tarefas com cd gerenciador-de-tarefas

npm run serve
```

## Inicie o servidor de desenvolvimento executando o seguinte comando
```
Navegue até a pasta back-end com cd gerenciador-de-tarefas/back-end

php artisan serve
```

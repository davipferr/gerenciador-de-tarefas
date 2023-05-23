# gerenciador-de-tarefas

## Guia de Configuração e Execução do Projeto
```
Bem-vindo ao guia de configuração e execução do projeto Gerenciador de Tarefas. Este guia fornecerá instruções claras sobre como configurar e executar o projeto com sucesso. O projeto utiliza Vue.js 2 para o front-end e PHP Laravel para o back-end.

Por favor, siga os passos abaixo para começar:
```

## Pré-requisitos
```
Antes de prosseguir com a configuração do projeto, verifique se você possui os seguintes pré-requisitos instalados em seu sistema:

Node.js (versão 14.15.4): certifique-se de ter o Node.js instalado. Você pode baixá-lo no site oficial: https://nodejs.org

Composer: O Composer é necessário para gerenciar as dependências PHP do projeto. Você pode baixar e instalar o Composer em: https://getcomposer.org

PHP (versão 7.4.11): Instale o PHP em seu sistema. Você pode consultar o site oficial do PHP para obter instruções de instalação: https://www.php.net

Banco de dados MySQL: Configure um servidor de banco de dados MySQL. Você pode baixar o MySQL em: https://www.mysql.com. Certifique-se de ter as credenciais necessárias para acessar o banco de dados.
```

## Começando

### Clone o repositório para sua máquina local
```
git clone https://github.com/davipferr/gerenciador-de-tarefas.git
```

### Navegue até a pasta front-end do projeto:
```
cd gerenciador-de-tarefas/front-end
```

### Instale as dependências do Node.js
```
npm install
```

### Navegue até a pasta de back-end do projeto:
```
cd ../back-end
```

### Instale as dependências do PHP
```
composer install
```

## Configuração

### Crie uma cópia do arquivo .env.example e renomeie-o para .env
```
cp .env.example .env
```

### Abra o arquivo .env e modifique as seguintes configurações para corresponder ao seu ambiente:
```
DB_CONNECTION=mysql
DB_HOST=seu-host-do-banco-de-dados
DB_PORT=sua-porta-do-banco-de-dados
DB_DATABASE=seu-nome-do-banco-de-dados
DB_USERNAME=seu-nome-de-usuário-do-banco-de-dados
DB_PASSWORD=sua-senha-do-banco-de-dados
```

## Configuração do banco de dados

### Migre as tabelas do banco de dados executando o seguinte comando:
```
php artisan migrate
```

## Executar o Projeto

### Execute o servidor de desenvolvimento front-end usando o seguinte comando na pasta front-end:
```
npm run serve
```

### Inicie o servidor de desenvolvimento Laravel executando o seguinte comando na pasta back-end:
```
php artisan serve
```

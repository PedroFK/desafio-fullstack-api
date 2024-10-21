## Serviço de Assinaturas - Backend
Este projeto é o backend de uma aplicação de gerenciamento de assinaturas, desenvolvido utilizando o framework Laravel. Ele fornece uma API RESTful para o frontend, gerencia usuários, planos de assinatura, contratos e pagamentos. A aplicação utiliza PostgreSQL como banco de dados e segue boas práticas de arquitetura, utilizando Resources para formatação de respostas JSON, Requests para validação de dados, e Services para concentrar a lógica de negócios.

### Tecnologias Utilizadas
- PHP 8+
- Laravel 9:
- MySQL (ou outro banco de dados relacional)
- Laravel Resources: Para formatação das respostas JSON da API.
- Laravel Requests: Para validação das requisições HTTP.
- Service Layer: Para encapsular a lógica de negócios da aplicação.

### Funcionalidades
1. Cadastro de Usuários
2. Listagem de Planos
3. Contratação de Planos
4. Troca de Planos

### Instalação e Configuração
Siga os passos abaixo para configurar e rodar o backend localmente.
#### Passo a Passo 
1. Clone o repositório `git clone https://github.com/seu-usuario/seu-repositorio.git`
2. Navegue até o diretório do backend `cd seu-repositorio/backend`
3. Instale as dependências do projeto `composer install`
4. Configuração do Banco de Dados. Configure o arquivo .env com as informações do banco de dados PostgreSQL
5. Gere a chave da aplicação `php artisan key:generate`
6. Migre o banco de dados `php artisan migrate`
7. Inicie o servidor de desenvolvimento `php artisan serve`

### Um exemplo de como o sistema lida com a troca de plano:

- Plano atual: R$ 100,00 por mês.
- Data de contratação: 01/09/2023.
- Data de troca: 15/09/2023, para um plano de R$ 200,00 por mês.
- Cálculo de crédito: O sistema calcula que o usuário utilizou metade do mês do plano atual (15 dias), o que gera um crédito de R$ 50,00. O valor do novo plano é de R$ 200,00, então o usuário paga apenas R$ 150,00.
- Essa lógica é processada na camada de Service, permitindo que o backend mantenha a separação entre regras de negócio e a camada de controladores.
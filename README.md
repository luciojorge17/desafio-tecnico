
# Desafio Técnico — Desenvolvedor Full Stack

## Tecnologias Utilizadas

- PHP
- MySQL
- CodeIgniter 4
- XAMPP
- Bootstrap

---

## Instruções para Rodar o Projeto

1. **Clone este repositório:**

   ```bash
   git clone https://github.com/luciojorge17/desafio-tecnico.git
   cd desafio-tecnico
   ```

2. **Crie o banco de dados no MySQL:**

   ```sql
   CREATE DATABASE desafiotecnico CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```

3. **Configure o ambiente no arquivo `.env`:**

   Renomeie o arquivo `.env.example` (se existir) para `.env` e configure as credenciais do banco de dados:

   ```ini
   CI_ENVIRONMENT = development

   database.default.hostname = localhost
   database.default.database = desafiotecnico
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.DBPrefix =
   database.default.port = 3306
   ```

4. **Execute as migrações:**

   No terminal, navegue até a pasta do projeto e rode os comandos:

   ```bash
   php spark migrate
   ```

5. **Inicie o servidor de desenvolvimento:**

   ```bash
   php spark serve
   ```

6. **Acesse o projeto:**

   Abra o navegador e acesse:  
   [http://localhost:8080](http://localhost:8080)

---

## Verificações Adicionais

- Verifique se a extensão **intl** está habilitada no arquivo `php.ini`.  
  (Ela é essencial para o funcionamento do CodeIgniter 4.)
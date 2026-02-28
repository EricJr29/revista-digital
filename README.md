# 📖 Revista Digital Escolar (Laravel Edition)

Este projeto é uma **Revista Digital** desenvolvida em Laravel, criada para substituir uma versão anterior feita em PHP "puro". O objetivo é transformar um sistema que antes era baseado em scripts manuais em uma aplicação robusta, segura e seguindo os padrões de arquitetura **MVC**.

O sistema foi pensado para o ambiente escolar, permitindo que alunos produzam conteúdo sob a supervisão e aprovação dos professores.

---

## 🚀 Funcionalidades Principais

* **Sistema de Usuários com 4 Níveis:**
    * 🛡️ **Nível 3 (ADM):** Gestão total do sistema, permissões e configurações.
    * 🎓 **Nível 2 (Professor):** Revisão e aprovação de projetos/postagens.
    * ✍️ **Nível 1 (Aluno):** Criação de projetos e gestão do próprio perfil.
    * ⏳ **Nível 0 (Pendente):** Usuários aguardando aprovação para acessar o sistema.
* **Fluxo de Aprovação:** Posts criados não aparecem no feed principal até que passem pelo filtro de aprovação.
* **Perfil Interativo:** Upload de foto em tempo real e edição de Bio com Livewire.
* **Sistema de Likes:** Interação direta nas postagens dos alunos.

---

## 🛠️ Tecnologias Utilizadas

* **Framework:** Laravel 11
* **Linguagem:** PHP 8.x
* **Frontend Interativo:** Livewire 3
* **Template Engine:** Blade
* **Banco de Dados:** MySQL
* **Autenticação:** Laravel Breeze
* **Estilização:** Bootstrap 5 / Icons

---

## 📈 Evolução: PHP Puro vs Laravel

Este projeto marca o meu amadurecimento como desenvolvedor, onde substituí práticas antigas por recursos nativos do framework:
* **Migrations:** Em vez de SQL manual, o banco é versionado por código.
* **Eloquent ORM:** Consultas ao banco seguras contra SQL Injection e muito mais legíveis.
* **Middleware:** Controle de acesso feito de forma centralizada.
* **Blade:** Organização de layouts com componentes e herança de arquivos.

---

## 🔧 Como Rodar o Projeto (Passo a Passo)

Siga estas instruções para configurar o ambiente local:

### 1. Clonar o Repositório
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio

### 2. Instalar Dependências do PHP (Composer)
composer install

### 3. Instalar Dependências de Frontend (NPM)
npm install

### 4. Configurar o Ambiente
Crie o arquivo .env a partir do exemplo:
cp .env.example .env

(Atenção: Abra o .env e coloque o nome do seu banco de dados em DB_DATABASE, além do seu usuário e senha do MySQL)

### 5. Gerar Chave e Migrar Banco
php artisan key:generate
php artisan migrate
php artisan storage:link

### 6. Iniciar a Aplicação
Você precisará de dois terminais rodando simultaneamente:

Terminal 1: php artisan serve
Terminal 2: npm run dev

Acesse: http://localhost:8000

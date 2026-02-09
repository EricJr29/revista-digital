# 📖 Revista Digital Escolar (Laravel Edition)

Este projeto é uma **Revista Digital** desenvolvida em Laravel, criada para substituir uma versão anterior feita em PHP "puro". O objetivo é transformar um sistema que antes era baseado em scripts manuais em uma aplicação robusta, segura e seguindo os padrões de arquitetura **MVC**.

O sistema foi pensado para o ambiente escolar, permitindo que alunos produzam conteúdo sob a supervisão e aprovação dos professores.

---

## 🚀 Funcionalidades Principais

* **Sistema de Usuários com 3 Níveis:**
    * 🛡️ **Administradores (Professores):** Gestão total, edição de usuários e aprovação de novos posts.
    * ✍️ **Autores (Alunos):** Podem criar e editar seus próprios textos (que ficam pendentes de revisão).
    * 📖 **Leitores (Público):** Acesso à leitura dos posts aprovados.
* **Fluxo de Aprovação:** Posts criados por alunos não aparecem no feed principal até que um professor os filtre e aprove.
* **Gestão de Conteúdo (CRUD):** Criação, leitura, atualização e exclusão de matérias e categorias.
* **Interface Responsiva:** Desenvolvida para ser lida tanto em computadores quanto em celulares.

---

## 🛠️ Tecnologias Utilizadas

* **Framework:** Laravel 11
* **Linguagem:** PHP 8.x
* **Template Engine:** Blade
* **Banco de Dados:** MySQL
* **Autenticação:** Laravel Breeze
* **Estilização:** Tailwind CSS

---

## 📈 Evolução: PHP Puro vs Laravel

Este projeto marca o meu amadurecimento como desenvolvedor, onde substituí práticas antigas por recursos nativos do framework:
* **Migrations:** Em vez de SQL manual, o banco é versionado por código.
* **Eloquent ORM:** Consultas ao banco seguras contra SQL Injection e muito mais legíveis.
* **Middleware:** Controle de acesso (quem pode ver o quê) feito de forma centralizada.
* **Blade:** Organização de layouts com componentes e herança de arquivos.

---

## 🔧 Como Rodar o Projeto

1. Clone o repositório:
   ```bash
   git clone [https://github.com/seu-usuario/revista-digital.git](https://github.com/seu-usuario/revista-digital.git)
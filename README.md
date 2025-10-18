<p align="center">
    <a href="#"><img src="https://raw.githubusercontent.com/yourusername/ishop/main/logo.png" width="300" alt="iShop Logo"></a>
</p>

<p align="center">
    <a href="#"><img src="https://img.shields.io/badge/Livewire-3-blue" alt="Livewire 3"></a>
    <a href="#"><img src="https://img.shields.io/badge/Flowbite-v1.7-purple" alt="Flowbite"></a>
    <a href="#"><img src="https://img.shields.io/badge/TailwindCSS-v3.3-teal" alt="TailwindCSS"></a>
    <a href="#"><img src="https://img.shields.io/badge/MySQL-8.0-orange" alt="MySQL"></a>
    <a href="#"><img src="https://img.shields.io/badge/FontAwesome-v6-gray" alt="FontAwesome"></a>
</p>

# iShop - Loja Online

iShop é uma **plataforma de e-commerce moderna** criada para simplificar a experiência de compra online em Angola e no mundo. A aplicação é rápida, responsiva e fácil de gerenciar, permitindo que comerciantes gerenciem produtos, categorias, estoque e vendas de forma intuitiva.

---

## 🛠 Ferramentas utilizadas

- **Laravel 12 | Breeze** – Framework PHP moderno e robusto.  
- **Livewire 3** – Componentes dinâmicos sem necessidade de JS manual.  
- **Flowbite** – Biblioteca de componentes prontos com TailwindCSS.  
- **TailwindCSS** – Estilização moderna baseada em classes utilitárias.  
- **MySQL** – Banco de dados relacional para armazenar produtos, clientes e pedidos.  
- **FontAwesome** – Ícones elegantes para botões, menus e indicadores.

---

## ⚡ Como rodar o projeto

### 1. Clonar o repositório

git clone https://github.com/antoniomiguel-77/ishop.git
cd ishop
### 2. Instalar as Depencias

composer install
npm install
npm run dev


### 3. Configurar o banco de dados
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ishop
DB_USERNAME=root
DB_PASSWORD=

### 4. crias as Tabelas no banco de dados
php artisan migrate --seed


### 5. Usuário e senha inicial
Após rodar os seeders, use o usuário padrão para acessar o painel administrativo:

Email: admin@example.com

Senha: password


### 
# 🐾 VeterinariaApp - Sistema de Gestión Veterinaria

**VeterinariaApp** es una aplicación web desarrollada en **Laravel** que permite la gestión integral de una veterinaria.  
Incluye módulos para **agendar citas**, **gestionar productos**, **registrar clientes y mascotas**, y un **dashboard administrativo** para el control general del negocio.

---

## 🚀 Características principales

- 🗓️ **Agenda de citas:** registro, edición, cancelación y seguimiento de citas.
- 🧍 **Gestión de clientes y mascotas:** CRUD completo para clientes, veterinarios y mascotas.
- 💊 **Gestión de productos:** control de inventario, precios, categorías y stock.
- 📊 **Dashboard administrativo:** vista general de estadísticas y métricas de la veterinaria.
- 🔐 **Autenticación de usuarios:** registro, inicio de sesión y control de roles (administrador / empleado).
- 💾 **Base de datos relacional:** implementada en MySQL o PostgreSQL.
- 📱 **Interfaz moderna y responsiva** con Blade y Bootstrap/Tailwind.

---

## 🧩 Tecnologías utilizadas

| Tipo | Tecnología |
|------|-------------|
| Lenguaje principal | PHP 8.x |
| Framework backend | Laravel 10 |
| Base de datos | MySQL / PostgreSQL |
| Frontend | Blade, Bootstrap / TailwindCSS |
| Servidor local | XAMPP / Laravel Sail |
| Control de versiones | Git / GitHub |

---

## ⚙️ Instalación y configuración

### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/AndresCarvajal-dev/project-veterinaria-php
cd veterinariaapp
```

### 2️⃣ Instalar dependencias de Laravel
```bash
composer install
npm install && npm run dev
```

### 3️⃣ Configurar el archivo `.env`
Copia el archivo de ejemplo y ajusta los parámetros de conexión:
```bash
cp .env.example .env
```
Edita las siguientes variables según tu entorno:
```
APP_NAME=VeterinariaApp
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=admin
DB_PASSWORD=admin123
```

### 4️⃣ Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5️⃣ Ejecutar las migraciones y seeders
```bash
php artisan migrate --seed
```

### 6️⃣ Levantar el servidor local
```bash
php artisan serve
```

Abre tu navegador en [http://localhost:8000](http://localhost:8000)

---

## 🧑‍💻 Roles y permisos

- **Administrador:** puede acceder a todos los módulos, CRUDs y reportes.  
- **Empleado / Veterinario:** puede registrar citas y gestionar mascotas y productos según permisos asignados.

---

## 🗃️ Estructura del proyecto (carpetas principales)

```
app/
├── Http/
│   ├── Controllers/     # Controladores principales
│   └── Middleware/
├── Models/              # Modelos Eloquent
database/
├── migrations/          # Migraciones de la base de datos
├── seeders/             # Datos iniciales
resources/
├── views/               # Vistas Blade
├── css / js             # Archivos front-end
routes/
└── web.php              # Rutas principales
```

---

## 🧠 Autores y créditos

**Desarrollado por:**  
👨‍💻 Andres carvajal - Jhon carvajal - Santiago grueso   
📧 afelipecarvajal@estudiante.uniajc.edu.co
📧 jedisoncarvajal@estudiante.uniajc.edu.co 
📧 sagrueso@estudiante.uniajc.edu.co 
📅 Proyecto integrador - UNIAJC

---

## 🪪 Licencia

Este proyecto está bajo la licencia **MIT**, lo que permite su uso, modificación y distribución libre con fines educativos o comerciales.

---

## 💬 Contacto

Si tienes preguntas o sugerencias, no dudes en contactarme.  
¡Toda contribución es bienvenida! 🐶🐱

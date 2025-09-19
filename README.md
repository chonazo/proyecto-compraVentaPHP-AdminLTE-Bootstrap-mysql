# 📌 SysWeb - Sistema Web en PHP (MVC + PDO + MySQL)

Este proyecto es un **sistema web básico** desarrollado en **PHP nativo** utilizando el **patrón MVC**, **PDO** para la conexión a base de datos y **Bootstrap + AdminLTE** para el diseño.  
Incluye un **módulo de autenticación de usuarios** con login/logout, manejo de sesiones, permisos de acceso y un **panel de administración (Dashboard)**.

---

## 🚀 Características principales

- 🔑 Inicio de sesión con validación de usuario/contraseña (MD5 en la BD).
- 👥 Manejo de sesiones seguras con cierre de sesión (`logout`).
- 🛡️ Permisos de acceso por roles (ejemplo: `super_admin`, otros roles).
- 🗂️ Estructura **MVC** clara: separación de controladores, modelos y vistas.
- 🎨 Interfaz con **Bootstrap 3**, **Font Awesome** y **AdminLTE**.
- 📊 Dashboard inicial con bienvenida al usuario.
- 📂 Menú lateral dinámico según permisos del usuario.

---

## 📂 Estructura del proyecto

```
.
├── config/
│   └── conexion.php          # Configuración y conexión PDO a MySQL
├── controller/
│   ├── DashboardController.php
│   ├── LoginController.php
│   └── MainController.php
├── model/
│   └── UserModel.php         # Consultas relacionadas a usuarios
├── view/
│   ├── login.php             # Vista del login
│   ├── dashboard.php         # Vista principal del sistema
│   └── template/
│       ├── main_menu.php     # Layout principal
│       ├── sidebar_menu.php  # Menú lateral dinámico
│       └── top_menu.php      # Menú superior con perfil/cerrar sesión
├── assets/                   # CSS, JS, imágenes y plugins
├── index.php                 # Enrutador principal del sistema
└── README.md                 # Documentación del proyecto
```

---

## ⚙️ Requisitos

- **PHP >= 8.0.30 **.
- **MySQL**.
- Extensión **PDO** habilitada.
- Servidor local como **XAMPP**.
- Navegador moderno (Chrome, Firefox, Edge).

---

## 🛠️ Instalación

1. **Clonar o descargar el repositorio** en tu servidor local:
   ```bash
   git clone https://github.com/chonazo/proyecto-compraVentaPHP-AdminLTE-Bootstrap-mysql.git
   ```

2. **Configurar la base de datos** en `config/conexion.php`:
   ```php
   $server   = "localhost";
   $username = "root";
   $password = "1234";
   $database = "sysweb";
   ```

3. **Importar la base de datos**  
   - Crea la base de datos `sysweb` en MySQL.
   - Importa el archivo SQL (pendiente incluirlo en `/database/sysweb.sql`).

   Ejemplo en terminal:
   ```bash
   mysql -u root -p sysweb < database/sysweb.sql
   ```

4. **Iniciar el servidor local**:
   - Si usas PHP directamente:
     ```bash
     php -S localhost:8000
     ```
   - O bien, iniciar Apache desde XAMPP.

5. **Acceder al sistema**:
   ```
   http://localhost/sysweb
   ```

---

## 👤 Usuarios de prueba

Asegúrate de tener un usuario activo en la tabla `usuarios`:

| username | password (MD5) | permisos_acceso | estado  |
|----------|----------------|-----------------|---------|
| admin    | 21232f297a57a5a743894a0e4a801fc3 | super_admin | Activo |

👉 **Nota:** `21232f297a57a5a743894a0e4a801fc3` corresponde a la contraseña **admin** en MD5.

---

## 📸 Capturas de pantalla

### Pantalla de Login
![Login](./assets/img/screenshots/login.png)

### Dashboard
![Dashboard](./assets/img/screenshots/dashboard.png)

---

## 📖 Créditos

- 💻 **Desarrollado por:** Jorge Ibarrola (Chono Pesoa).
- 🎨 Plantilla basada en [AdminLTE](https://adminlte.io).
- 🗄️ Base de datos: MySQL.
- 🛠️ Backend: PHP (PDO + MVC).

---

## 📜 Licencia

Este proyecto se distribuye bajo la licencia **MIT**.  
Eres libre de usarlo, modificarlo y adaptarlo para tus propios proyectos 🚀.

---

## 📝 Changelog / Historial de avances

### ✅ Versión inicial
- Creación del proyecto **SysWeb** con la base de datos `sysweb` y archivo `conexion.php`.
- Se implementó `index.php` como **ruteador principal** del proyecto.
- Se creó la vista **Login (`login.php`)**, junto con el modelo `UserModel.php` y el controlador `LoginController.php`.
  - Se probó conexión a la base de datos y logueo exitoso.
  - Se integró **AdminLTE** con diseño de página inicial.
- Se creó la vista **Dashboard (`dashboard.php`)** con los templates:
  - `main.php`
  - `top_menu.php`
  - `sidebar_menu.php`
  - `DashboardController.php` y `MainController.php`
- En este estado, el proyecto ya está preparado para albergar las **clases CRUD principales**.

---

# Prueba Técnica PHP – Gestión de Tareas

Este repositorio contiene la resolución de la prueba técnica de PHP solicitada para el proceso de selección.

El objetivo del ejercicio es implementar una pequeña aplicación backend para la gestión de tareas, incluyendo operaciones CRUD y un endpoint API para la consulta de datos.

---

## 🛠️ Tecnologías utilizadas

- PHP 8
- SQLite (base de datos local)
- PDO para acceso a datos
- HTML básico para formularios
- Git / GitHub para control de versiones

---

## 📁 Estructura del proyecto

- `config.php` → Configuración y conexión a la base de datos  
- `index.php` → Listado de tareas  
- `create.php` → Creación de nuevas tareas  
- `edit.php` → Edición de tareas existentes  
- `delete.php` → Eliminación de tareas  
- `api.php` → Endpoint API que devuelve las tareas en formato JSON  
- `database.sqlite` → Base de datos SQLite  
- `log.txt` → Registro simple de acciones  

---

## ▶️ Ejecución del proyecto

1. Clonar el repositorio:
```bash
git clone https://github.com/gpadillan/gpe-app-BE-CALL.git


2. Acceder al directorio del proyecto:
cd gpe-app-BE-CALL

3.Levantar el servidor de desarrollo PHP:
php -S localhost:8000

4.Acceder desde el navegador:
App: http://localhost:8000
API JSON: http://localhost:8000/api.php


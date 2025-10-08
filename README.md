# Puente Papel

<p align="center">
  <img src="public/storage/images/puente_papel_icon.png" alt="Puente Papel Logo" width="200">
</p>

<p align="center">
  <strong>Materiales educativos especializados para el desarrollo del lenguaje y la comunicación</strong>
</p>

## 📚 Sobre Puente Papel

Puente Papel es una plataforma web que ofrece libros y material didáctico adaptado a todo tipo de necesidades lectoras y comunicativas. Nuestro objetivo es conectar a cada niño y a cada joven con historias y experiencias que enriquezcan su vida y expandan su imaginación.

### 🎯 Características principales

- **Productos educativos especializados** con pictogramas y herramientas visuales
- **Blog educativo** con contenido sobre desarrollo del lenguaje
- **Sistema de usuarios** con roles de administrador y usuario
- **Panel de administración** para gestión de productos y contenido
- **Diseño responsive** optimizado para todos los dispositivos

## 🚀 Instalación y Configuración

### Requisitos previos

- PHP 8.1 o superior
- Composer
- Node.js y NPM
- MySQL/MariaDB
- Servidor web (Apache/Nginx)

### Pasos de instalación

1. **Clonar el repositorio**
   ```bash
   git clone [URL_DEL_REPOSITORIO]
   cd puente-papel
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**
   ```bash
   npm install
   ```

4. **Configurar variables de entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar la base de datos**
   - Crear una base de datos MySQL
   - Actualizar las credenciales en el archivo `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=puente_papel
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

6. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Crear enlace simbólico para storage**
   ```bash
   php artisan storage:link
   ```

8. **Compilar assets**
   ```bash
   npm run build
   ```

9. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

## 👥 Usuarios de prueba

El sistema incluye usuarios predefinidos para testing:

### Usuario Administrador
- **Email:** `test@puentepapel.com`
- **Contraseña:** `puentepapel`
- **Rol:** Admin
- **Acceso:** Panel de administración completo

### Usuario Regular
- **Email:** `leitoorellana58@gmail.com`
- **Contraseña:** `leonardoorellana2`
- **Rol:** User
- **Acceso:** Funcionalidades de usuario

## 🛠️ Tecnologías utilizadas

- **Backend:** Laravel 11
- **Frontend:** Blade Templates, Tailwind CSS
- **Base de datos:** MySQL/MariaDB
- **Autenticación:** Laravel Breeze
- **Assets:** Vite
- **Animaciones:** GSAP

## 📁 Estructura del proyecto

```
puente-papel/
├── app/
│   ├── Http/Controllers/     # Controladores
│   ├── Models/              # Modelos Eloquent
│   ├── Services/            # Servicios de negocio
│   └── View/Components/     # Componentes Blade
├── database/
│   ├── migrations/          # Migraciones de BD
│   └── seeders/            # Seeders con datos iniciales
├── resources/
│   ├── views/              # Vistas Blade
│   ├── css/                # Estilos CSS
│   └── js/                 # JavaScript
├── storage/
│   └── app/public/         # Archivos públicos (imágenes)
└── public/
    └── storage/            # Enlace simbólico a storage
```

## 🎨 Características de diseño

- **Paleta de colores:** Rosa y rojo como colores principales
- **Responsive design:** Mobile-first approach
- **Accesibilidad:** Cumple estándares WCAG
- **Animaciones:** Transiciones suaves con GSAP

## 📝 Funcionalidades

### Para usuarios
- Navegación por productos educativos
- Lectura de blog educativo
- Sistema de autenticación
- Perfil de usuario

### Para administradores
- Panel de administración
- Gestión de productos
- Gestión de posts del blog
- Gestión de usuarios
- Subida de imágenes

## 🔧 Comandos útiles

```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Regenerar autoload
composer dump-autoload

# Ejecutar tests
php artisan test

# Compilar assets en modo desarrollo
npm run dev

# Compilar assets para producción
npm run build
```

## 📞 Soporte

Para soporte técnico o consultas sobre el proyecto, contacta al equipo de desarrollo.

## 📄 Licencia

Este proyecto es privado y está protegido por derechos de autor de Puente Papel.
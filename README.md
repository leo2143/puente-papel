# 🌉 Puente Papel

<div align="center">
  <h3>Materiales educativos especializados para el desarrollo del lenguaje y la comunicación</h3>
  <p>Conectando a cada niño y joven con historias que enriquecen su vida y expanden su imaginación</p>
</div>

---

## 📖 ¿Qué es Puente Papel?

Puente Papel nace de una necesidad real: **facilitar el acceso a materiales educativos especializados** para niños y jóvenes con necesidades de comunicación diversas. Es mucho más que una tienda online de libros; es una plataforma diseñada con propósito educativo y social en mente.

La idea central del proyecto es crear un "puente" entre los materiales didácticos especializados (como libros con pictogramas, herramientas visuales de comunicación alternativa, etc.) y las personas que los necesitan. No solo vendemos productos, sino que también **compartimos conocimiento** a través de nuestro blog educativo, creando una comunidad alrededor del desarrollo del lenguaje y la comunicación.

---

## 🎯 ¿Por qué existe este proyecto?

### El Problema que Resuelve

En el mercado actual, encontrar materiales educativos especializados puede ser complicado. Las opciones suelen estar dispersas, no siempre son fáciles de encontrar, y muchas veces falta información clara sobre cómo utilizarlos. Puente Papel centraliza estos recursos y los presenta de manera accesible y organizada.

### Nuestra Misión

- **Democratizar el acceso** a materiales educativos especializados
- **Proporcionar información valiosa** sobre desarrollo del lenguaje a través del blog
- **Facilitar la gestión** para educadores, terapeutas y familias
- **Crear una experiencia de usuario** amigable e inclusiva

---

## 🏗️ ¿Cómo se desarrolló?

### Enfoque de Desarrollo

Este proyecto se construyó siguiendo **mejores prácticas de desarrollo web moderno**, priorizando:

1. **Código limpio y mantenible**: Se utilizaron estándares de Laravel y PHP 8+ para garantizar que el código sea fácil de entender y modificar en el futuro.

2. **Seguridad desde el inicio**: El sistema incluye validación de datos, protección contra ataques comunes (XSS, CSRF), y autenticación robusta.

3. **Experiencia de usuario**: Se diseñó pensando primero en móviles (mobile-first) y luego se adaptó para tablets y escritorio, garantizando que todos puedan acceder fácilmente.

4. **Organización lógica**: El código está estructurado de manera que cada parte tiene una responsabilidad clara, facilitando el trabajo en equipo y futuras mejoras.

### Arquitectura del Sistema

El proyecto utiliza una arquitectura **MVC (Modelo-Vista-Controlador)** que separa claramente las responsabilidades:

- **Modelos**: Representan los datos (Productos, Usuarios, Posts del blog) y contienen la lógica de negocio relacionada
- **Vistas**: Son las páginas que ve el usuario, construidas con componentes reutilizables para mantener consistencia
- **Controladores**: Manejan las peticiones del usuario, validan datos y coordinan entre modelos y vistas

### Tecnologías Elegidas y Por Qué

#### **Laravel (Framework PHP)**

Se eligió Laravel porque:

- Es robusto y maduro, con una comunidad activa
- Facilita el desarrollo rápido sin sacrificar calidad
- Incluye características de seguridad integradas
- Permite escribir código más limpio y legible

#### **Blade (Motor de Plantillas)**

- Permite crear vistas dinámicas de manera intuitiva
- Facilita la reutilización de componentes (como headers, footers, formularios)
- Integra perfectamente con Laravel

#### **Tailwind CSS (Framework de Estilos)**

- Permite estilos consistentes sin escribir CSS personalizado extenso
- Facilita el diseño responsive
- Acelera el desarrollo visual manteniendo flexibilidad

#### **MySQL (Base de Datos)**

- Confiable y ampliamente utilizado
- Excelente rendimiento para este tipo de aplicaciones
- Fácil de mantener y hacer respaldos

---

## 🎨 Decisiones de Diseño

### Paleta de Colores: Rosa y Rojo

La elección de rosa (`bg-pink-100`) y rojo (`text-red-600`) como colores principales fue intencional:

- El **rosa** transmite calidez, accesibilidad y un ambiente acogedor, importante para una plataforma educativa
- El **rojo** se usa estratégicamente para elementos importantes (botones, enlaces activos, alertas), creando contraste y guiando la atención del usuario

### Enfoque Mobile-First

Se diseñó primero para móviles porque:

- La mayoría de los usuarios acceden desde dispositivos móviles
- Es más fácil escalar de móvil a desktop que al revés
- Garantiza que la experiencia básica funcione en todos los dispositivos

### Componentes Reutilizables

Se crearon componentes Blade reutilizables (como `nav-link`, `button`, `product-grid`) porque:

- **Mantienen consistencia**: Un cambio en un componente se refleja en toda la aplicación
- **Ahorran tiempo**: No hay que reescribir código similar múltiples veces
- **Facilitan el mantenimiento**: Si hay un error, se corrige en un solo lugar

---

## 🔐 Seguridad y Buenas Prácticas

### Validación de Datos

**Todos los datos que ingresan al sistema son validados** antes de ser procesados. Esto previene:

- Entrada de información incorrecta
- Ataques maliciosos
- Errores que podrían afectar la base de datos

**Ejemplo**: Cuando un usuario se registra, se verifica que:

- El email tenga un formato válido
- La contraseña tenga al menos 8 caracteres
- El email no esté ya registrado en el sistema

### Protección contra Ataques Comunes

- **XSS (Cross-Site Scripting)**: Todos los datos se "escapan" automáticamente al mostrarse en pantalla
- **CSRF (Cross-Site Request Forgery)**: Se generan tokens únicos para cada formulario
- **Inyección SQL**: Se utilizan consultas preparadas que previenen la manipulación de la base de datos

### Autenticación Segura

El sistema utiliza autenticación basada en sesiones y tokens JWT:

- Las contraseñas **nunca** se almacenan en texto plano, siempre encriptadas
- Al cerrar sesión, se invalida la sesión y se regenera el token de seguridad
- Solo los usuarios autenticados pueden acceder a áreas protegidas

---

## 📂 Estructura y Organización

### ¿Por qué esta organización?

El proyecto sigue las convenciones de Laravel, lo que significa que cualquier desarrollador familiarizado con Laravel puede entender rápidamente cómo está estructurado:

```
app/
├── Http/Controllers/    # Manejan las peticiones del usuario
├── Models/              # Representan los datos (Productos, Usuarios, etc.)
├── Services/            # Contienen lógica de negocio compleja (como manejo de imágenes)
└── View/Components/     # Componentes reutilizables para las vistas

resources/
├── views/               # Las páginas que ve el usuario
├── css/                 # Estilos
└── js/                  # JavaScript

database/
├── migrations/          # Definen la estructura de la base de datos
└── seeders/            # Datos iniciales para desarrollo y pruebas
```

### Servicios Especializados

Se creó un **ImageService** dedicado al manejo de imágenes porque:

- Centraliza toda la lógica de imágenes en un solo lugar
- Facilita cambiar cómo se manejan las imágenes en el futuro
- Permite reutilizar código en diferentes partes de la aplicación
- Incluye validaciones de seguridad (tipos de archivo permitidos, tamaños máximos)

---

## 🚀 Funcionalidades Principales

### Para Visitantes

- **Catálogo de Productos**: Navegación intuitiva por todos los materiales educativos disponibles
- **Blog Educativo**: Artículos sobre desarrollo del lenguaje, técnicas de comunicación, y más
- **Información de la Empresa**: Página "Sobre Nosotros" con la misión y visión

### Para Usuarios Registrados

- **Perfil Personal**: Gestión de información personal
- **Autenticación Segura**: Sistema de login y registro protegido

### Para Administradores

- **Panel de Control**: Dashboard con información relevante
- **Gestión de Productos**: Crear, editar y eliminar productos con imágenes
- **Gestión de Blog**: Publicar y administrar artículos educativos
- **Gestión de Usuarios**: Administrar cuentas de usuario y sus permisos

## 🎓 Tecnologías y Herramientas

- **Backend**: Laravel 11 (PHP 8+)
- **Frontend**: Blade Templates, Tailwind CSS, JavaScript
- **Base de Datos**: MySQL/MariaDB
- **Autenticación**: Laravel Authentication + JWT
- **Gestión de Archivos**: Laravel Storage
- **Desarrollo**: Vite (compilación de assets), Composer (dependencias PHP)


# Cotizaciones

Este es un proyecto desarrollado para gestionar cotizaciones de productos de manera interactiva y eficiente. Permite seleccionar clientes, agregar productos a un carrito y visualizar las compras realizadas por cliente. Está construido utilizando tecnologías modernas como **Laravel**, **Vue.js**, y **Tailwind CSS**, y aprovecha la integración de **Inertia.js** para una experiencia de usuario fluida.

## Tecnologías utilizadas

### Backend
- **Laravel 11.31**: Framework PHP para la gestión del backend.
- **Inertia.js**: Proporciona una experiencia tipo SPA (Single Page Application) utilizando Laravel y Vue.js.
- **PHP 8.2**: Versión mínima requerida para el proyecto.

### Frontend
- **Vue.js 3.5**: Para construir componentes interactivos con Composition API.
- **Tailwind CSS 3.4**: Framework de utilidades CSS para diseño rápido y eficiente.
- **Headless UI**: Componentes accesibles y sin estilos prediseñados.

### Dependencias adicionales
- **Axios**: Para realizar solicitudes HTTP.
- **Ziggy**: Manejo de rutas de Laravel desde el frontend.
- **Vite**: Empaquetador rápido para JavaScript y CSS.

## Funcionalidades principales

### Pantalla de Cotización
1. **Selección de cliente**: 
   - Selecciona un cliente existente de la lista o crea uno nuevo.
2. **Visualización de productos**:
   - Muestra productos disponibles que se pueden agregar al carrito.
3. **Carrito de compras**:
   - Agrega productos con cantidades específicas al carrito.
   - Guarda la compra al presionar el botón "Guardar".
4. **Gestión de stock**:
   - Solo se permite agregar productos disponibles.
5. **Resumen total**:
   - Muestra el total de la cotización en tiempo real.

### Historial de Compras
- Visualiza las compras realizadas agrupadas por cliente.
- Detalla los productos comprados, cantidades y totales acumulados.

## Requisitos previos

- **PHP >= 8.2**
- **Node.js >= 16** y **npm**
- **Composer**
- **MySQL** o **MariaDB**

## Instalación y configuración

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/YohanRVV/cotizaciones.git
   cd cotizaciones
   ```

2. **Instalar dependencias:**
   ```bash
   composer install
   npm install
   ```

3. **Configurar entorno:**
   - Copia el archivo `.env.example` a `.env` y configura tu base de datos:
     ```bash
     cp .env.example .env
     ```
   - Genera una clave de aplicación:
     ```bash
     php artisan key:generate
     ```

4. **Importar la base de datos:**
   - El archivo `database_dump.sql` en el repositorio contiene el esquema y datos iniciales de la base de datos. Impórtalo utilizando tu cliente MySQL (como DBeaver o phpMyAdmin):
     ```sql
     SOURCE /path/to/database_dump.sql;
     ```

5. **Ejecutar el proyecto:**
   - Compilar assets y ejecutar el servidor:
     ```bash
     npm run dev
     php artisan serve
     ```

6. **Abrir en el navegador:**
   - Abre `http://localhost:8000` para acceder a la aplicación.

## Uso de la aplicación

1. Selecciona un cliente de la lista o crea uno nuevo.
2. Agrega productos al carrito con las cantidades deseadas.
3. Guarda la compra desde el carrito.
4. Visualiza el historial de compras desde el botón correspondiente.

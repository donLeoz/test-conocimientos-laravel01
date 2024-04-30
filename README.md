# Test Conocimientos Laravel

Este proyecto es una demostración de habilidades en Laravel, incluyendo la integración y manejo de APIs externas con Laravel Collections.

## Requisitos Previos

Para ejecutar este proyecto, necesitas tener instalado PHP y Composer en tu máquina. Además, es recomendable tener instalado Laravel CLI.

## Instalación

Sigue estos pasos para configurar el entorno de desarrollo:

1. **Clonar el Repositorio**

   Clona este repositorio en tu máquina local usando:

   ```bash
   git clone https://github.com/donLeoz/test-conocimientos-laravel01.git
   
2. **Instalar Dependencias**

    Navega al directorio del proyecto y ejecuta el siguiente comando para instalar todas las dependencias requeridas:

    `composer install`    

## Ejecuta la aplicación:

    Para iniciar el servidor de desarrollo, ejecuta:
    
    `php artisan serve`
    
    Esto pondrá en marcha el servidor de desarrollo en http://localhost:8000.

## Probar la aplicación con POSTMAN

Para probar la API utilizando Postman, sigue estos pasos:


1. Abre Postman.
2. Haz clic en Import en la esquina superior izquierda.
3. Selecciona File y haz clic en Upload Files.
4. Busca y selecciona el archivo laravel-test.postman_collection.json en tu directorio del proyecto.
5. Haz clic en Import para cargar la colección en Postman.

Ahora puedes enviar solicitudes a la API utilizando las rutas configuradas en la colección de Postman.

**La ruta `http://localhost:8000/api/beneficios` muestra los datos requeridos en el test.**


## Documentación de la API (SWAGGER)

Puedes encontrar la documentación detallada de la API en la ruta /api/documentation una vez que el servidor 
esté en funcionamiento. 

Esto te proporcionará información sobre todos los endpoints, parámetros y respuestas esperadas.

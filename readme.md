## Programa base para juego de el rival más debil

## Instalación

Laravel 5 es la base de este programa por lo cual para su instalación debes de contar con **composer** en tu SO, además de MySQL como gestor de base de datos.

1. Primero lo que se debe de hacer el copiar el archivo .env.example al archivo .env a la misma altura del directorio y dentro del archivo nuevo configurar la base de datos.
2. Con el comando **composer update** se instalaran las dependencias.
3. Con el uso del comando **php artisan key:generate** se aplicará la llave.
4. Con el comando **php artisan migrate** se creará la base de datos del juego.

**Nota:** Recuerda otorgar permisos de lectura y escritura sobre las carpetas storage/ y bootstrap/ para que no cause ningun problema el acceso a programa.
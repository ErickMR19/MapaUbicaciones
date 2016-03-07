# Instrucciones de instalación
* Agregar el archivo .env con la llave de aplicacion y las opciones de MySQL
* Ejecutar el comando *composer install*
* Ejecutar el comando *php artisan migrate* para crear las tablas de la base de datos
* Ejecutar el comando *php artisan db:seed* para rellenar la base de datos con los valores necesarios para la aplicación de Santa Ana (deben estar todas las tablas en blanco, por asunto de valores de identificación)
* Ejecutar el comando *php artisan serve* para poder acceder al servidor
 
# Acceder a la aplicación
Se debe acceder por un navegador web a la dirección **localhost:8000**. Con el seed se crea un usuario Administrador, con el correo admin@example.com y la contraseña *123456*

# Problemas conocidos
* La instalación da errores si se realiza en una base de datos SQLite. Además se ha probado unicamente con base de datos MySQL

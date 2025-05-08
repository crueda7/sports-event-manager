# sports-event-manager

Aplicativo web que permite la creación y gestión eficiente de eventos deportivos.

## Empezando

Estas instrucciones le proporcionarán una copia del proyecto en funcionamiento en su máquina local.

### Contenido

- [Requisitos previos](#install)
- [Clonar proyecto](#Usage)
- [Configuración](#Configuración)
- [Instalación](#Instalación)

### Requisitos previos

- [PHP >= 8.4](https://www.php.net/manual/en/getting-started.php)
- [Laravel 12.x](https://laravel.com/docs/12.x/installation)
- [Composer](https://getcomposer.org/doc/00-intro.md)
- [Node.js 22.x](https://nodejs.org/en/docs/guides/getting-started-guide/)
- [MySQL](https://dev.mysql.com/doc/mysql-getting-started/en/)

### Clonar proyecto

Para generar una copia del proyecto ejecute en su máquina local:
`git clone https://github.com/crueda7/sports-event-manager.git`

### Configuración

Cree una base de datos MySQL con el nombre que desee,  posteriormente deberá configurar los parámetros de conexión en el archivo **.env**.

`DB_CONNECTION=mysql`    
`DB_HOST=127.0.0.1`    
`DB_PORT=3306`    
`DB_DATABASE=sports-event-manager`    
`DB_USERNAME=root`    
`DB_PASSWORD=`    


> En la raíz del proyecto existe un archivo de configuración de ejemplo con la estructura requerida **.env.example** si desea puede utilizarlo renombrándolo a **.env** y dentro del mismo agregar/modificar los parámetros faltantes.
> O puede ejecutar el siguiente comando:
> `cp .env.example .env`  

Por último genere la llave identificador de su proyecto con el comando:  
`php artisan key:generate`

### Instalación

Ubíquese en la carpeta de su proyecto y ejecute las siguientes instrucciones.

Instalar de las dependencias:  
`composer install`  
`npm install`

Ejecutar las migraciones:  
`php artisan migrate`

Ejecutar los seeders:  
`php artisan db:seed`

Inicializar el proyecto:  
`composer run dev`

Ahora puede visualizar el proyecto en su navegador de preferencia con el puerto [8000](http://127.0.0.1:8000).

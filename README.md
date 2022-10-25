# Agendamiento de cursos

El sistema se encarga de permitir a un administrador crear los horarios de las clases y permitirá a los demás usuarios inscribirse en dichas clases desde que estén vigentes.

## Requisitos

* Composer
* Npm / yarn
* Tener creada la BD mysql llamada "courses"

## Preparación

Dentro del fichero .env se pueden configurar las credenciales para la BD.

## Instalación

Estando dentro de la carpeta del prouecto 

```bash
composer update
npm install
```
--- 
Opcional (si descarga el fichero courses_db.sql y configura manualmente, puede omitir estos pasos).
```bash
php artisan migrate
php artisan db:seed
```

## Ejecución

Para correr localmente el programa basta ejecutar:

```bash
php artisan serve
npm run dev
```

## Credenciales
En los seeders de las migraciones están los detalles de usuario creados, aquí están resumidos:

### Administrador
correo: admin@getnada.com
pass: adminpass

### Estudiante
correo: student_one@getnada.com /
pass: student_one_pass

correo: student_two@getnada.com / pass: student_two_pass


## License
[MIT](https://choosealicense.com/licenses/mit/)
<h1>Primeros comandos para el funcionamiento</h1>
* cd backend
* composer install
* cp .env.example .env
*dentro el archivo .env*
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=devchallenge
* DB_USERNAME=root
* DB_PASSWORD=
* php artisan key:generate
* (xampp, wampp, etc en ejecución activado MySQL y Apache)
* php artisan migrate --seed
* php artisan serve

*En otra consola, para poder correr el Frontend*
* npm install
* npm run dev

<h1>Backend</h1>
* **Explicación de solución limitante de 10 request por minuto:**
* Uso de Caché: 
* Cache::get('key'): Intenta obtener los datos desde la caché. 
* Cache::put('key', value, duration): Almacena los datos en la caché con una duración especificada (1 minuto).
* El uso de caché evita realizar solicitudes innecesarias a la API externa si los datos ya están disponibles. Solo se realiza la solicitud a la API externa si no se encuentra en la caché, lo que limita el número de solicitudes realizadas. El valor de la caché se actualiza después de cada solicitud exitosa a la API externa.

**Endpoint API Backend**
* /competitions - Debe obtener el detalle de todas las ligas
* /competitions/<competition_id> - Obtiene el detalle de una liga específica (Equipos y jugadores que luego serán almacenados localmente)
* /team - Muestra todos los equipos que se han almacenado hasta el momento
* /team/<team_id> -> Muestra el detalle de los equipo seleccionado
* /players - Muestra todos los jugadores almacenados hasta el momento

<h1>Frontend</h1>
* Cuenta con vista responsive de los datos, principalmente la barra de navegación o navbar, cambia para dispositivos móviles o pantallas inferiores a 850px, de ser una lista de items a ser un menú desplegable o toggle. Luego tenemos la tabla de Competencias, Equipos y Detalle del jugador, que se ajustan para el desplazamiento de la pantalla.

<h1>Screenshots desktop</h1>
<img width=800 src="https://res.cloudinary.com/lvaldivia/image/upload/v1737851262/staffboom/1.png"/>
<img width=800 src="https://res.cloudinary.com/lvaldivia/image/upload/v1737851275/staffboom/2.png"/>
<img width=800 src="https://res.cloudinary.com/lvaldivia/image/upload/v1737851285/staffboom/3.png"/>
<img width=800 src="https://res.cloudinary.com/lvaldivia/image/upload/v1737851311/staffboom/4.png"/>

<h1>Screenshots mobile</h1>
<img width=800 src="https://res.cloudinary.com/lvaldivia/image/upload/v1737851325/staffboom/5.png"/>
<img width=800 src="https://res.cloudinary.com/lvaldivia/image/upload/v1737851335/staffboom/6.png"/>
<img width=800 src="https://res.cloudinary.com/lvaldivia/image/upload/v1737851415/staffboom/7.png"/>


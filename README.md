**Primeros comandos para el funcionamiento**
cd backend
composer install
cp .env.example .env
*dentro el archivo .env*
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=devchallenge
DB_USERNAME=root
DB_PASSWORD=
php artisan key:generate
(xampp, wampp, etc en ejecución activado MySQL y Apache)
php artisan migrate --seed
php artisan serve

*en otra consola, para poder correr el frontend*
npm install
npm run dev

**Backend**
Explicación de solución limitante de 10 request por minuto: 
Uso de Caché: 
Cache::get('key'): Intenta obtener los datos desde la caché. 
Cache::put('key', value, duration): Almacena los datos en la caché con una duración especificada (1 minuto).
El uso de caché evita realizar solicitudes innecesarias a la API externa si los datos ya están disponibles. Solo se realiza la solicitud a la API externa si no se encuentra en la caché, lo que limita el número de solicitudes realizadas. El valor de la caché se actualiza después de cada solicitud exitosa a la API externa.

**Frontend** 
Cuenta con vista responsive de los datos, principalmente la barra de navegación o navbar, cambia para dispositivos móviles o pantallas inferiores a 850px, de ser una lista de items a ser un menú desplegable o toggle. Luego tenemos la tabla de Competencias, Equipos y Detalle del jugador, que se ajustan para el desplazamiento de la pantalla. 
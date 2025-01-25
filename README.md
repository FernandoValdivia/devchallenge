**Backend**
Explicación de solución limitante de 10 request por minuto: Uso de Caché: Cache::get('key'): Intenta obtener los datos desde la caché. Cache::put('key', value, duration): Almacena los datos en la caché con una duración especificada (1 minuto). El uso de caché evita realizar solicitudes innecesarias a la API externa si los datos ya están disponibles. Solo se realiza la solicitud a la API externa si no se encuentra en la caché, lo que limita el número de solicitudes realizadas. El valor de la caché se actualiza después de cada solicitud exitosa a la API externa.

**Frontend** 
Responsive a 850px con toogle menú para dispositivos móviles, desplazamiento de tablas
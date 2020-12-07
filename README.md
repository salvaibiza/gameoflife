# Conway's Game Of Life

## Instalar dependencias (autoload)
```php
 Ejecutar: composer install
```

## Uso desde terminal
```php
../app$ php main.php -r [rows] -c [columns]  
```
![alt text](https://i.ibb.co/bs29vnH/image.png "Uso de la app")

Tras propocionar unas filas y columnas para el tablero, el juego da comienzo:
1. Se genera un tablero aleatorio con `r` filas y `c` columnas.
2. Se imprime la generación inicial #0.
3. Tras cada evolución, podemos decidir si avanzar a la siguiente generación introduciendo `yes` en el terminal

![alt text](https://i.ibb.co/fr3QFDF/image.png "Ejecución")

## Testing
Se incluye una testsuite
```php
../app$ phpunit --testsuite game
```

## Acerca de
+ He utilizado composer para el autoload de clases
+ Validación de los argumentos de entrada

### Archivos de la app
+ ``main.php`` - Arranque de la app
+ ``class GameOfLife.php`` - Lógica principal del juego
+ ``class GameOfLifeHelper.php`` - Clase auxiliar que contiene principalmente la lógica sobre el estado de las celdas 
+ ``class BoardGenerator.php`` - Proporciona una tablero aleatorio para la generación inicial


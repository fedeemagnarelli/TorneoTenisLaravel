# 🎾 TorneoTenis
Modelado de como se comportaría un torneo de tenis con eliminación directa en PHP-laravel

## 🚀 Características

- Inscripción de jugadores
- Creación automática de emparejamientos
- Registro de resultados de los partidos
- Visualización del progreso del torneo
- Determinación del ganador

## 📋 Requisitos

- PHP >= 8
- Servidor web (Apache, Nginx, etc.)
- Base de datos MySQL
- Docker
- Composer

## ⚙️ Instalación

1. Clona este repositorio:
    ```bash
    git clone https://github.com/fedeemagnarelli/TorneoTenisLaravel.git
    ```

2. Navega al directorio del proyecto:
    ```bash
    cd TorneoTenisLaravel
    ```

3. Configura la base de datos:
    - Crea una base de datos en MySQL llamada "torneo_tenis".
    - Ejecuta las migraciones con el comando ``php aritsan migrate``


## Imagenes de Docker 🐋

Las imagenes tanto de apache como de mysql estan en un repositorio de Azure. 
Link del repositorio: "torneotenislaravel.azurecr.io"

Una vez realizado el pull a las imagenes podemos seguir los siguientes comandos para crear y levantar las mismas 🎉


Las generamos con: 
    
    docker compose up --build

Ingresamos en la imagen: 

    docker exec -it app bash


Ingresamos a la terminal de la imagen de mysql:

    docker exec -it Torneo-Tenis-SQL bash


Ejecutamos las migraciones a la base de datos con:

    php artisan migrate
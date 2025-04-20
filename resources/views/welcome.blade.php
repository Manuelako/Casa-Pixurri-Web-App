<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Pixurri - Bienvenidos</title>
    
    <!-- Incluyendo recursos de Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Fondo con imagen personalizada */
        body {
            background: black; /* Color de fondo negro */
            background: url('{{ asset("imagenes/14.png") }}') no-repeat center center fixed;
            background-size: cover; /* La imagen cubrirá todo el ancho y alto de la pantalla */
            color: green;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa toda la altura de la pantalla */
            width: 100vw; /* Ocupa todo el ancho de la pantalla */
        }

        /* Contenedor principal */
        .main-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        /* Título */
        .main-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: black; /* Cambiado a negro */
            text-align: center;
            text-shadow: none; /* Eliminando el efecto de sombra */
        }

        /* Contenedor del cubo */
        .cube-container {
            position: relative;
            width: 100px; /* Tamaño reducido del cubo */
            height: 100px;
            perspective: 1500px;
        }

        /* Cubo 3D */
        .cube {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            animation: rotate-cube 10s infinite linear;
        }

        /* Animación de rotación constante */
        @keyframes rotate-cube {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }

        /* Caras del cubo */
        .cube-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            overflow: hidden;
            border-radius: 0px;
        }

        /* Posiciones de las caras */
        .cube-face.front { transform: rotateY(0deg) translateZ(50px); } /* Reducido para ajustarse al tamaño */
        .cube-face.back { transform: rotateY(180deg) translateZ(50px); }
        .cube-face.left { transform: rotateY(-90deg) translateZ(50px); }
        .cube-face.right { transform: rotateY(90deg) translateZ(50px); }

        /* Ajusta las imágenes dentro de las caras del cubo */
        .cube-face img {
            width: 100%; /* Asegura que las imágenes llenen las caras */
            height: 100%;
            object-fit: cover; /* Ajusta las imágenes para que cubran completamente el espacio */
            display: block;
        }
    </style>
</head>

<body>
    <!-- Contenedor principal -->
    <div class="main-container">
        <!-- Título -->
        <h1 class="main-title">¡Pulsa en el cubo para ver lo que nos espera!</h1>

        <!-- Contenedor del cubo -->
        <div class="cube-container" id="cube">
            <div class="cube">
                <!-- Cara: Frontal -->
                <div class="cube-face front">
                    <img src="{{ asset('imagenes/casapixurri.JPG') }}" alt="Imagen Frontal">
                </div>
                <!-- Cara: Trasera -->
                <div class="cube-face back">
                    <img src="{{ asset('imagenes/casapixurri.JPG') }}" alt="Imagen Trasera">
                </div>
                <!-- Cara: Izquierda -->
                <div class="cube-face left">
                    <img src="{{ asset('imagenes/casapixurri.JPG') }}" alt="Imagen Izquierda">
                </div>
                <!-- Cara: Derecha -->
                <div class="cube-face right">
                    <img src="{{ asset('imagenes/casapixurri.JPG') }}" alt="Imagen Derecha">
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para redirección -->
    <script>
        const cube = document.getElementById('cube');

        cube.addEventListener('click', () => {
            window.location.href = "{{ route('menu') }}"; // Redirige al menú
        });
    </script>
</body>
</html>
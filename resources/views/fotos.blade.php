<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Pixurri - Galería</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #2c2c2c;
            color: white;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* 🎇 Contenedor del título con efecto de luz */
        .title-container {
            width: 90%;
            max-width: 1300px;
            background: transparent;
            border-radius: 50px;
            padding: 20px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin: 20px auto;
            backdrop-filter: blur(8px);
            opacity: 1; /* Inicialmente visible */
            transition: opacity 0.3s ease-in-out; /* Transición de opacidad */
        }

        /* 🔥 Letras animadas con efecto de luz */
        .title-text {
            display: inline-block;
            color: rgba(255, 255, 255, 0.05); /* Inicialmente casi invisible */
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.5); /* Efecto de brillo */
            animation: fadeInGlow 2s ease-in-out forwards;
        }

        /* 🌟 Efecto de luz en las letras */
        @keyframes fadeInGlow {
            0% {
                color: rgba(255, 255, 255, 0.05);
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            }
            50% {
                color: white;
                text-shadow: 0 0 30px rgba(255, 255, 255, 1);
            }
            100% {
                color: rgba(255, 255, 255, 0.2); /* Se queda gris */
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.2);
            }
        }

        /* 📸 Contenedor principal */
        .gallery-container {
            position: relative;
            width: 100vw;
            height: 100vh;
        }

        /* 🖼️ Estilo base para imágenes y videos con control manual */
        .controlled-media {
            position: absolute;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
                /* 📍 Posición de imágenes */
        #img1 { width: 250px; top: 100px; left: 155px; }
        #img2 { width: 220px; top: 410px; left: 1270px; }
        #img3 { width: 300px; top: 645px; left: 960px; }
        #img4 { width: 230px; top: 100px; left: 410px; }
        #img6 { width: 230px; top: 425px; left: 410px; }
        #img7 { width: 240px; top: 280px; left: 160px; }
        #img8 { width: 250px; top: 100px; left: 1450px; }
        #img9 { width: 280px; top: 640px; left: 670px; }
        #img10 { width: 490px; top: 660px; left: 170px; }
        #img11 { width: 280px; top: 860px; left: 670px; }
        #img13 { width: 280px; top: 1715px; left: 1270px; }
        #img14 { width: 280px; top: 1615px; left: 1270px; }
        #img15 { width: 140px; top: 1060px; left: 1120px; }
        #img16 { width: 280px; top: 715px; left: 1270px; }
        #img17 { width: 180px; top: 950px; left: 480px; }
        

        /* 📍 Posición de videos */
        #video1 { width: 300px; top: 100px; left: 650px; }
        #video2 { width: 300px; top: 100px; left: 960px; }
        #video3 { width: 170px; top: 100px; left: 1270px; }
        #video4 { width: 300px; top: 1060px; left: 810px; }

    </style>
</head>
<body>
    @include('partials.menu') <!-- ✅ Esto incluye la barra de navegación en la vista de apartamentos -->

    <!-- 🎉 Título épico arriba de las imágenes -->
    <div class="title-container" id="title-container">
        <span class="title-text">¡Pulsa en la época que te gustaría venir!</span>
    </div>

    <div class="gallery-container">
        <!-- Imágenes con control de posición -->
        <img id="img1" class="controlled-media" src="{{ asset('/imagenes/lanuza2.jpg') }}" alt="Lanuza">
        <img id="img2" class="controlled-media" src="{{ asset('imagenes/casapixurri10.jpg') }}" alt="Casa Pixurri 10">
        <img id="img3" class="controlled-media" src="{{ asset('imagenes/casapixurri11.jpg') }}" alt="Casa Pixurri 11">
        <img id="img4" class="controlled-media" src="{{ asset('imagenes/casapixurri12.jpg') }}" alt="Casa Pixurri 12">
        <img id="img6" class="controlled-media" src="{{ asset('imagenes/casapixurri14.jpg') }}" alt="Casa Pixurri 14">
        <img id="img7" class="controlled-media" src="{{ asset('imagenes/casapixurri15.jpg') }}" alt="Casa Pixurri 15">
        <img id="img8" class="controlled-media" src="{{ asset('imagenes/casapixurri16.jpg') }}" alt="Casa Pixurri 16">
        <img id="img9" class="controlled-media" src="{{ asset('imagenes/apartamento4.0.avif') }}" alt="Casa Pixurri 16">
        <img id="img10" class="controlled-media" src="{{ asset('imagenes/2.jpg') }}" alt="Casa Pixurri 16">
        <img id="img11" class="controlled-media" src="{{ asset('imagenes/lanuza.jpg') }}" alt="Casa Pixurri 16">
        <img id="img13" class="controlled-media" src="{{ asset('imagenes/midi.jpg') }}" alt="Casa Pixurri 16">
        <img id="img14" class="controlled-media" src="{{ asset('imagenes/ski2.jpg') }}" alt="Casa Pixurri 16">
        <img id="img15" class="controlled-media" src="{{ asset('imagenes/terraza.jpg') }}" alt="Casa Pixurri 16">
        <img id="img16" class="controlled-media" src="{{ asset('imagenes/terraza2.jpg') }}" alt="Casa Pixurri 16">
        <img id="img17" class="controlled-media" src="{{ asset('imagenes/cuat.jpg') }}" alt="Casa Pixurri 16">


        
        
        
        

        <!-- Videos con control de posición -->
        <video id="video1" class="controlled-media" autoplay muted loop>
            <source src="{{ asset('videos/casapixurri.mp4') }}" type="video/mp4">
        </video>

        <video id="video4" class="controlled-media" autoplay muted loop>
            <source src="{{ asset('videos/otono.mp4') }}" type="video/mp4">
        </video>

        <video id="video2" class="controlled-media" autoplay muted loop>
            <source src="{{ asset('videos/casapixurri2.mp4') }}" type="video/mp4">
        </video>

        <video id="video3" class="controlled-media" autoplay muted loop>
            <source src="{{ asset('videos/ski.mp4') }}" type="video/mp4">
        </video>
    </div>

    <!-- 🔥 JavaScript para el parpadeo del título -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const title = document.getElementById("title-container");

            setTimeout(() => {
                title.style.opacity = "0";
                setTimeout(() => {
                    title.style.opacity = "1";
                }, 300); // Duración del parpadeo (0.3s)

                // Luego, parpadea cada 5 segundos
                setInterval(() => {
                    title.style.opacity = "0";
                    setTimeout(() => {
                        title.style.opacity = "1";
                    }, 300);
                }, 5000); // Parpadeo cada 5 segundos
            }, 2000); // Primera espera de 2 segundos antes de iniciar el parpadeo
        });
    </script>

</body>
</html>

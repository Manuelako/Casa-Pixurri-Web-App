<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Pixurri - Contacto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: black;
            text-align: center;
            padding: 20px;
        }

        /* Contenedor principal */
        .contact-container {
            max-width: 1000px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            margin-top: 200px;
        }

        /* Estilos del mapa */
        .map-container {
            width: 50%;
        }

        .map-container iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 10px;
        }

        /* 🎥 Estilos del video */
        .video-container {
            position: absolute;
            left: -180px; /* Ajusta la posición horizontal (X) */
            top: 20px; /* Ajusta la posición vertical (Y) */
            width: 170px;
        }
                /* 🎥 Estilos del video */
        .video-container2 {
            position: absolute;
            left: 1000px; /* Ajusta la posición horizontal (X) */
            top: 20px; /* Ajusta la posición vertical (Y) */
            width: 200px;
        }

        .video-container video {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* 📞 Información de Contacto */
        .contact-info {
            text-align: left;
            font-size: 1rem;
            width: 45%;
        }

        .contact-info h2 {
            font-size: 1.8rem;
            color: #333;
        }

        .contact-info p {
            margin: 10px 0;
            font-size: 1rem;
        }

        .contact-info a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .contact-info ul {
            list-style: none;
            padding: 0;
        }

        .contact-info ul li {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .contact-info ul li i {
            margin-right: 10px;
            color: #007bff;
        }


    </style>
</head>
<body>

    @include('partials.menu') <!-- ✅ Barra de navegación -->

    <h2>Contacto</h2>

    <div class="contact-container">
        <!-- 📍 Mapa de Google -->
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2873.946789268803!2d-0.3180123!3d42.7556012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5647b6216e39e1%3A0x1e8bba7c927acb5f!2sC.%20Juan%20de%20Lanuza%2C%204%2C%2022640%20Lanuza%2C%20Huesca%2C%20España!5e0!3m2!1ses!2ses!4v1707083098470"
                width="100%"
                height="300"
                style="border:0; border-radius:10px;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>

        <!-- 🎥 Video en Loop -->
        <div class="video-container">
            <video autoplay loop muted playsinline>
                <source src="{{ asset('videos/ubi.MP4') }}" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
        </div>
                <!-- 🎥 Video en Loop -->
        <div class="video-container2">
            <h1>¡Pulsa en el movil para descargar nuesrtra App!</h1>
            <video autoplay loop muted playsinline>
                <source src="{{ asset('videos/appCasapixurri2.mp4') }}" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
        </div>

        <!-- 📞 Información de Contacto -->
        <div class="contact-info">
            <h2>Casa Pixurri</h2>
            <p>Estamos en el Sur de Los Pirineos, en Huesca, entre Panticosa y Formigal.</p>
            <ul>
                <li><i class="fas fa-phone"></i> <strong>616 28 03 10</strong></li>
                <li><i class="fas fa-envelope"></i> <a href="mailto:info@casapixurri.com">info@casapixurri.com</a></li>
                <li><i class="fas fa-map-marker-alt"></i> Juan de Lanuza, 4, 22640 Lanuza, Huesca</li>
            </ul>
            <p><i class="fas fa-globe"></i> <a href="https://www.casapixurri.com" target="_blank">www.casapixurri.com</a></p>
        </div>
    </div>



</body>
</html>

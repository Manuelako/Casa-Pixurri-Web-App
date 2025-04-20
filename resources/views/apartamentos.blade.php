<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Pixurri - Apartamentos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: rgb(177, 190, 158);
            color: white;
            overflow-x: hidden;
            text-align: center;
        }

        /* 🔥 Animación de entrada */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* 🏡 Estilo del título */
        .title {
            font-size: 2.8rem;
            color: rgb(151, 151, 151);
            margin-top: 30px;
            animation: fadeIn 1.5s ease-in-out;
        }

        /* 🔥 Contenedor de las tarjetas - En fila horizontal */
        .cards-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 50px;
            max-width: 1600px;
            margin: auto;
            flex-wrap: nowrap;
            overflow-x: auto; /* Permite desplazamiento horizontal */
        }

        /* 📸 Tarjetas con efecto 3D */
        .card {
            background: rgb(182, 196, 176);
            border-radius: 15px;
            overflow: hidden;
            text-align: center;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);
            width: 260px;
            height: 380px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 20px;
            transform: perspective(1000px) rotateY(0deg);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        /* ✨ Hover con efecto 3D */
        .card:hover {
            transform: perspective(1000px) rotateY(10deg) scale(1.05);
            box-shadow: 10px 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* 📷 Imagen dentro de la tarjeta */
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        }

        /* 🏠 Título del apartamento */
        .card h3 {
            font-size: 1.4rem;
            color: #333;
            margin: 10px 0;
        }

        /* 📜 Descripción del apartamento */
        .card p {
            font-size: 0.9rem;
            color: #555;
            padding: 0 15px;
        }

        /* 🎯 Botón de ver más en verde */
        .card a {
            display: inline-block;
            margin: 10px;
            padding: 10px 15px;
            background: rgb(132, 158, 127);
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s, transform 0.2s;
        }

        .card a:hover {
            background: #218838;
            transform: scale(1.1);
        }

        /* 🌊 Tarjeta especial para el apartamento de la playa (Xeraco) */
        .xeraco-container {
            margin-top: 50px;
        }

        .card.xeraco {
            background: white;
            border-radius: 15px;
            text-align: center;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);
            width: 260px;
            height: 380px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 20px;
            transform: perspective(1000px) rotateY(0deg);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            margin: auto;
        }

        .card.xeraco:hover {
            transform: perspective(1000px) rotateY(10deg) scale(1.05);
            box-shadow: 10px 10px 25px rgba(0, 0, 0, 0.2);
        }

        .card.xeraco img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        }

        .card.xeraco h3 {
            color: rgb(211, 206, 141);
        }

        .card.xeraco p {
            color: #555;
        }

        .card.xeraco a {
            background: rgb(211, 206, 141);
            color: white;
        }

        .card.xeraco a:hover {
            background: #0056b3;
            transform: scale(1.1);
        }

        /* 📌 Mensaje especial para la playa */
        .playa-message {
            font-size: 1.4rem;
            color: rgb(80, 78, 54);
            margin-top: 60px;
            animation: fadeIn 2s ease-in-out;
        }
    </style>
</head>
<body>
    @include('partials.menu') <!-- ✅ Esto incluye la barra de navegación en la vista de apartamentos -->

    <!-- Título -->
    <h1 class="title">Descubre Nuestros Apartamentos en CasaPixurri 🏡</h1>

    <!-- Tarjetas de apartamentos -->
    <section class="cards-container fade-in">
        @foreach ($apartamentos as $apartamento)
            @if (!str_contains(strtolower($apartamento->nombre), 'playa'))
                <div class="card">
                    <img src="{{ url('imagenes/' . ($apartamento->imagen ?? 'default.jpg')) }}" alt="{{ $apartamento->nombre }}">
                    <h3>{{ $apartamento->nombre }}</h3>
                    <p>
                        {{ $apartamento->habitaciones }} habitaciones, 
                        {{ $apartamento->banos }} baños 
                        @if ($apartamento->duplex)
                            - Dúplex
                        @endif
                        <br>
                        Capacidad: {{ $apartamento->capacidad }} personas
                    </p>
                    <a href="{{ route('apartamentos.detalle', $apartamento->id) }}">Ver más</a>
                </div>
            @endif
        @endforeach
    </section>

    <!-- Sección de apartamentos en la playa -->
    <div class="playa-message">
        También tenemos playa! 🌊
    </div>

    <section class="cards-container fade-in">
        @foreach ($apartamentos as $apartamento)
            @if (str_contains(strtolower($apartamento->nombre), 'playa'))
                <div class="card xeraco">
                    <img src="{{ url('imagenes/' . ($apartamento->imagen ?? 'default.jpg')) }}" alt="{{ $apartamento->nombre }}">
                    <h3>{{ $apartamento->nombre }}</h3>
                    <p>
                        <span>{{ $apartamento->habitaciones }} habitaciones, {{ $apartamento->banos }} baños</span> 
                        @if ($apartamento->duplex)
                            - Dúplex
                        @endif
                        <br>
                        <span>Capacidad: {{ $apartamento->capacidad }} personas</span>
                    </p>
                    <a href="{{ route('apartamentos.detalle', $apartamento->id) }}">Ver más</a>
                </div>
            @endif
        @endforeach
    </section>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $apartamento->nombre }} - Casa Pixurri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .images-container {
            display: flex;
            gap: 10px;
        }

        .main-image {
            width: 65%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .side-images {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 35%;
        }

        .side-images img {
            width: 100%;
            height: 195px;
            object-fit: cover;
            border-radius: 10px;
        }

        .details {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .info {
            width: 60%;
        }

        .reservation {
            width: 35%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .reservation button {
            background: #ff5a5f;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        .reservation button:hover {
            background: #e0474c;
        }

        /* Estilos para los inputs del calendario */
        .date-picker {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>{{ $apartamento->nombre }}</h1>

        <!-- 🏡 Galería de imágenes -->
        <div class="images-container">
            <img class="main-image" src="{{ asset('imagenes/' . ($apartamento->imagen ?? 'default.jpg')) }}" alt="{{ $apartamento->nombre }}">
            <div class="side-images">
                @foreach ($apartamento->imagenes as $imagen)
                    <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $apartamento->nombre }}">
                @endforeach
            </div>
        </div>

        <!-- ℹ️ Información del apartamento -->
        <div class="details">
            <div class="info">
                <h2>Detalles del alojamiento</h2>
                <p>{{ $apartamento->descripcion }}</p>
                <p><strong>Capacidad:</strong> 8 personas</p> <!-- Capacidad fija -->
                <p><strong>Habitaciones:</strong> {{ $apartamento->habitaciones }}</p>
                <p><strong>Baños:</strong> {{ $apartamento->banos }}</p>
                @if ($apartamento->duplex)
                    <p><strong>Tipo:</strong> Dúplex</p>
                @endif
            </div>

            <!-- 📅 Formulario de reserva con calendario -->
            <div class="reservation">
                <h2>Reservar</h2>
                <p><strong>Precio por noche:</strong> {{ $apartamento->precio }}€</p>
                <form>
                    <label for="datepicker">Selecciona tu estancia:</label>
                    <input type="text" id="datepicker" class="date-picker" placeholder="Selecciona las fechas" readonly>

                    <p><strong>Capacidad: 8 personas</strong></p> <!-- Capacidad fija -->

                    <button type="submit">Reservar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr("#datepicker", {
                mode: "range", // Permite seleccionar un rango de fechas
                dateFormat: "d/m/Y", // Formato de fecha
                minDate: "today", // No permite seleccionar fechas pasadas
                locale: {
                    firstDayOfWeek: 1, // Comenzar la semana en lunes
                    weekdays: {
                        shorthand: ["D", "L", "M", "X", "J", "V", "S"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado",
                        ],
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dic",
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre",
                        ],
                    },
                },
            });
        });
    </script>

</body>
</html>

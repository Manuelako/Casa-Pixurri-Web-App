<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $apartamento->nombre }} - Casa Pixurri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
            gap: 20px;
            align-items: flex-start;
        }

        .info {
            flex: 1;
        }

        .reservation-area {
            flex: 2;
            display: flex;
            gap: 20px;
            position: relative;
        }

        .reservation,
        .formulario-wrapper,
        .payment-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .reservation {
            flex: 1;
        }

        .formulario-wrapper {
            flex: 1;
            opacity: 0;
            transform: translateX(0);
            display: none;
        }

        .formulario-wrapper.active {
            display: block;
            opacity: 1;
        }

        .payment-box {
            flex: 1;
            opacity: 0;
            transform: translateX(0);
            display: none;
        }

        .payment-box.active {
            display: block;
            opacity: 1;
        }

        .reservation.shifted {
            transform: translateX(-20%);
        }

        .formulario-wrapper.shifted {
            transform: translateX(-10%);
        }

        .reservation button,
        .formulario-wrapper button,
        .payment-box button {
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

        .date-picker {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }

        .formulario-wrapper input {
            margin-bottom: 10px;
            width: 100%;
            padding: 6px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 18px;
            color: #aaa;
        }

        .close-btn:hover {
            color: #000;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $apartamento->nombre }}</h1>

    <div class="images-container">
        <img class="main-image" src="{{ asset('imagenes/' . ($apartamento->imagen ?? 'default.jpg')) }}" alt="{{ $apartamento->nombre }}">
        <div class="side-images">
            @foreach ($apartamento->imagenes as $imagen)
                <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $apartamento->nombre }}">
            @endforeach
        </div>
    </div>

    <div class="details">
        <div class="info">
            <h2>Detalles del alojamiento</h2>
            <p>{{ $apartamento->descripcion }}</p>
            <p><strong>Capacidad:</strong> {{ $apartamento->capacidad }} personas</p>
            <p><strong>Habitaciones:</strong> {{ $apartamento->habitaciones }}</p>
            <p><strong>Baños:</strong> {{ $apartamento->banos }}</p>
            @if ($apartamento->duplex)
                <p><strong>Tipo:</strong> Dúplex</p>
            @endif
        </div>

        <div class="reservation-area">
            <div class="reservation" id="bloqueReserva">
                <h2>Reservar</h2>
                <p><strong>Precio por noche:</strong> {{ $apartamento->precio }}€</p>
                <form id="formReserva">
                    <label for="datepicker">Selecciona tu estancia:</label>
                    <input type="text" id="datepicker" class="date-picker" placeholder="Selecciona las fechas" data-room-id="{{ $apartamento->room_id }}">
                    <p><strong>Capacidad: {{ $apartamento->capacidad }}</strong></p>
                    <button type="submit">Reservar</button>
                </form>
            </div>

            <div class="formulario-wrapper" id="formularioCliente">
                <span class="close-btn" id="cerrarFormulario">×</span>
                <h2>Formulario de Reserva</h2>
                <input type="text" id="nombre" placeholder="Nombre">
                <input type="text" id="apellido" placeholder="Apellido">
                <input type="email" id="email" placeholder="Email">
                <input type="tel" id="telefono" placeholder="Teléfono">
                <button id="confirmarReserva">Confirmar Reserva</button>
            </div>

            <div class="payment-box" id="paymentBox">
                <h2>Pago</h2>
                <p>Aquí aparecerá la integración de pago</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("datepicker");
    const roomId = dateInput.dataset.roomId;
    const formulario = document.getElementById("formularioCliente");
    const paymentBox = document.getElementById("paymentBox");
    const reservaBox = document.getElementById("bloqueReserva");
    const cerrarFormulario = document.getElementById("cerrarFormulario");

    dateInput.addEventListener("focus", async () => {
        try {
            const response = await fetch(`/disponibilidad/${roomId}`);
            const raw = await response.text();
            const data = JSON.parse(raw);
            const fechasOcupadas = [];

            if (data && data[roomId]) {
                for (const fecha in data[roomId]) {
                    if (data[roomId][fecha].availability === 0) {
                        fechasOcupadas.push(fecha);
                    }
                }
            }

            flatpickr("#datepicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: fechasOcupadas,
                clickOpens: true,
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["D", "L", "M", "X", "J", "V", "S"],
                        longhand: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    },
                    months: {
                        shorthand: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        longhand: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    },
                },
            });
        } catch (error) {
            console.error("Error al cargar disponibilidad", error);
        }
    }, { once: true });

    document.getElementById("formReserva").addEventListener("submit", function (e) {
        e.preventDefault();
        const fechas = dateInput.value;
        if (!fechas) {
            alert("Por favor selecciona una fecha primero.");
            return;
        }
        reservaBox.classList.add("shifted");
        formulario.classList.add("active");
    });

    document.getElementById("confirmarReserva").addEventListener("click", function () {
        const nombre = document.getElementById("nombre").value;
        const apellido = document.getElementById("apellido").value;
        const email = document.getElementById("email").value;
        const telefono = document.getElementById("telefono").value;
        const fechas = dateInput.value;

        console.log("Datos a enviar:", { roomId, fechas, nombre, apellido, email, telefono });

        formulario.classList.add("shifted");
        paymentBox.classList.add("active");
    });

    cerrarFormulario.addEventListener("click", () => {
        formulario.classList.remove("active", "shifted");
        reservaBox.classList.remove("shifted");
        paymentBox.classList.remove("active");
    });
});
</script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const confirmarBtn = document.getElementById('confirmarReserva');

        if (confirmarBtn) {
            confirmarBtn.addEventListener('click', async () => {
                const roomId = document.getElementById("datepicker")?.dataset.roomId;
                const fechas = document.getElementById("datepicker")?.value;
                const nombre = document.getElementById("nombre")?.value;
                const apellido = document.getElementById("apellido")?.value;
                const email = document.getElementById("email")?.value;
                const telefono = document.getElementById("telefono")?.value;

                if (!roomId || !fechas || !nombre || !apellido || !email || !telefono) {
                    alert("Por favor, completa todos los campos de la reserva.");
                    return;
                }

                try {
                    const response = await fetch('/crear-checkout-session', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ roomId, fechas, nombre, apellido, email, telefono })
                    });

                    const data = await response.json();

                    if (data?.url) {
                        window.location.href = data.url;
                    } else {
                        alert("Error al redirigir al pago. Inténtalo más tarde.");
                    }
                } catch (error) {
                    console.error("Error al iniciar el pago con Stripe:", error);
                    alert("Ocurrió un error. Revisa los datos o intenta más tarde.");
                }
            });
        }
    });
</script>



</body>
</html>
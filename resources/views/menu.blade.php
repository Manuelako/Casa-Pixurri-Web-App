<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Pixurri - Menú Principal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #2c2c2c;
            color: white;
            overflow-x: hidden;
        }
        /* Buscador */
        .search-bar {
            display: flex;
            align-items: center;
            background: white;
            padding: 10px;
            border-radius: 20px;
            width: 50%;
            margin: 20px auto;
            justify-content: center;
        }

        .search-bar input {
            border: none;
            outline: none;
            padding: 10px;
            font-size: 1.1rem;
            border-radius: 20px;
            width: 90%;
            color:rgb(12, 12, 12);
        }

        .search-bar button {
            background:rgb(53, 172, 73);
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
        }

        /* Chatbot desplegable */
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
        }
        /* Chatbot desplegable */
        .chatbot-container {
            position: fixed;
            bottom: 0;
            left: 20px;
            width: 350px;
            height: calc(100vh - 100px); /* Ocupará casi toda la pantalla */
            background: white;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        .chatbot-header {
            background:rgb(0, 83, 18);;
            color: white;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .chatbot-body {
            padding: 10px;
            flex-grow: 1; /* Hace que el cuerpo del chat ocupe todo el espacio disponible */
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 120px); /* Ajusta el tamaño al resto del contenedor */
        }

        .chatbot-message {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 80%;
        }

        .user-message {
            background:rgb(0, 117, 26);
            color: white;
            align-self: flex-end;
        }

        .bot-message {
            background: #e0e0e0;
            color: black;
            align-self: flex-start;
        }
        .chatbot-footer {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
            align-items: center;
            height: 60px;
        }

        .chatbot-footer input {
            flex: 1;
            padding: 10px;
            border: none;
            outline: none;
            font-size: 1rem;
            color: black;
        }

        .chatbot-footer button {
            background:rgb(0, 117, 26);
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 1rem;
        }
        .chatbot-message a {
            color: blue; /* Color azul */
            text-decoration: underline; /* Subrayado para que parezca un link */
            font-weight: bold; /* Negrita para más visibilidad */
        }
        .chatbot-message a:hover {
            color: darkblue; /* Cambia a azul más oscuro al pasar el mouse */
        }


        /* Menú superior */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color:rgb(0, 117, 26);
        }

        .logo img {
            height: 40px;
        }

        /* Contenedor de bienvenida */
        .welcome-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
            text-align: center;
            padding: 20px;
            margin-top: 80px;
        }

        .welcome-container h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: rgb(0, 168, 22);
        }

        .welcome-container p {
            font-size: 1.2rem;
            color: #e0e0e0;
        }

        /* Fondo con imagen */
        body {
            background-color: #2c2c2c;
            background-size: cover;
        }

        /* Slideshow (Imágenes alternantes) */
        .slideshow-container {
            position: relative;
            width: 600px;
            height: 350px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .slideshow-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slideshow-image:first-child {
            opacity: 1;
        }

        /* Contenedor de descripción */
        .description-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            text-align: justify;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .description-container h2 {
            text-align: center;
            color: rgb(0, 168, 22);
            font-size: 2rem;
        }

        .description-container p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
 @include('partials.menu') <!-- ✅ Esto incluye la barra de navegación en la vista de apartamentos -->

    <!-- Buscador en la barra de navegación -->
    <div class="search-bar">
        <input type="text" id="search-query" placeholder="Escribe a la IA para saber qué apartamento y fecha te conviene y ver la disponibilidad">
        <button onclick="startChat()">🔍</button>
    </div>

<!-- Chatbot desplegable -->
<div class="chatbot-container" id="chatbot">
    <div class="chatbot-header">
        Buscador de Apartamentos
        <span style="float: right; cursor: pointer;" onclick="closeChat(event)">❌</span>
    </div>
    <div class="chatbot-body" id="chat-content"></div>
    <div class="chatbot-footer">
        <input type="text" id="chat-input" placeholder="Escribe tu pregunta...">
        <button onclick="sendMessage()">Enviar</button>
    </div>
</div>


    <!-- Contenedor de bienvenida -->
    <div class="welcome-container">
        <h1>Bienvenido a Casa Pixurri</h1>
        <p>Descubre un lugar único lleno de experiencias inolvidables.</p>

        <!-- Slideshow de imágenes -->
        <div class="slideshow-container">
            <img class="slideshow-image img-1" src="{{ asset('imagenes/casapixurri2.jpg') }}" alt="Imagen 1">
            <img class="slideshow-image img-2" src="{{ asset('imagenes/lanuza2.jpg') }}" alt="Imagen 2">
        </div>
    </div>

    <!-- Contenedor de descripción -->
    <div class="description-container">
        <h2>Sobre Casa Pixurri</h2>
        <p>
            La casa consta de 5 apartamentos y está situada en el <strong>Pirineo Aragonés</strong>, en el pintoresco pueblo de <strong>Lanuza</strong>, junto a Sallent de Gállego.
            Este lugar es un <strong>emblema del Valle de Tena</strong>, gracias a su espectacular emplazamiento y su imagen única.
        </p>
        <p>
            La ubicación de Casa Pixurri es privilegiada, situada entre las estaciones de esquí de <strong>Formigal</strong> y <strong>Panticosa</strong>.
            En primavera y verano, el entorno ofrece multitud de senderos para hacer excursiones y rutas, además de su cercanía con el <strong>Parque Nacional de Ordesa</strong>, en Huesca.
        </p>
        <p>
            Lanuza es un pueblo con aproximadamente treinta casas que <strong>ofrece la paz y tranquilidad</strong> que hoy en día es difícil encontrar.  
            Su arquitectura mantiene el estilo tradicional del Pirineo, con <strong>piedra, pizarra y madera</strong>, creando un ambiente acogedor entre montañas, agua y naturaleza.
        </p>
        <p>
            Casa Pixurri se encuentra a tan solo <strong>1.8 km de Sallent de Gállego</strong>, la cabecera del valle, donde encontrarás comercios y servicios.  
            Además, estamos a tan solo <strong>6 km de las estaciones de esquí</strong> de Formigal y Panticosa.
        </p>
    </div>

    <!-- Script para cambiar imágenes automáticamente -->
    <script>
        let index = 0;
        const images = document.querySelectorAll(".slideshow-image");
        setInterval(() => {
            images.forEach((img, i) => img.style.opacity = i === index ? "1" : "0");
            index = (index + 1) % images.length;
        }, 3000);
    </script>

<script>
    function toggleChatbot() {
        const chatbot = document.getElementById('chatbot');
        chatbot.style.display = chatbot.style.display === 'none' ? 'flex' : 'none';
    }

    function startChat() {
    const query = document.getElementById('search-query').value.trim();
    if (query) {
        document.getElementById('chatbot').style.display = 'flex';
        sendMessage(query); // <-- enviar el mensaje del buscador
    }
}


    let chatHistory = [
  {
    role: "system",
    content: `Eres el recepcionista y asistente virtual de Casa Pixurri. Tu tarea es ayudar a los visitantes que preguntan por disponibilidad, detalles o características de los apartamentos, así como informar sobre las actividades disponibles en la zona. Debes responder con naturalidad, cercanía y precisión, como si fueras una persona real que trabaja en recepción.

Actualmente hay 6 apartamentos disponibles:
1. Apartamento 1 – 3 habitaciones, 2.0 baños (Dúplex) – Capacidad: 8 personas
2. Apartamento 2 – 1 habitación, 1.0 baño – Capacidad: 4 personas
3. Apartamento 3 – 2 habitaciones, 1.0 baño – Capacidad: 5 personas
4. Apartamento 4 – 3 habitaciones, 1.5 baños (Dúplex) – Capacidad: 7 personas
5. Apartamento 5 – 3 habitaciones, 1.5 baños (Dúplex) – Capacidad: 7 personas
6. Apartamento Playa de Xeraco – 3 habitaciones, 2.0 baños – Capacidad: 7 personas

❌ Fechas ya ocupadas (estas fechas están reservadas y no pueden ofrecerse):
- Apartamento 1: del 15 al 20 de mayo, y del 5 al 10 de junio.
- Apartamento 2: del 1 al 7 de julio.
- Apartamento 3: del 10 al 15 de agosto.
- Apartamento 4: del 22 al 30 de junio.
- Apartamento 5: del 1 al 6 de junio.
- Playa de Xeraco: del 10 al 14 de julio.

✅ El resto de fechas se consideran disponibles.

Además de la información sobre los apartamentos, también puedo proporcionarte detalles sobre las actividades que puedes disfrutar en la zona:

**Actividades en el Valle de Tena:**
- **Esquí y deportes de invierno:** Disfruta de las estaciones de esquí de Formigal y Panticosa, ideales para esquí alpino y de fondo.
- **Senderismo y rutas en bicicleta:** Explora las numerosas rutas de senderismo y ciclismo que atraviesan paisajes montañosos impresionantes.
- **Parque Faunístico Lacuniacha:** Visita este parque natural donde podrás observar la fauna y flora autóctonas en su hábitat natural.
- **Balneario de Panticosa:** Relájate en sus aguas termales y disfruta de tratamientos de bienestar en un entorno montañoso único.
- **Actividades de aventura:** Participa en actividades como rafting, escalada, parapente y rutas en motos de nieve.

**Actividades en Xeraco:**
- **Deportes acuáticos:** Practica paddle surf, kayak, windsurf y vela ligera en las tranquilas aguas de la Playa de Xeraco.
- **Cultura y gastronomía:** Visita la Torre de Guaita y disfruta de eventos locales como la Feria del Esmorzar i el Cremaet (Fiescrem).
- **Naturaleza y relax:** Pasea por la extensa playa de arena fina y disfruta de la tranquilidad del entorno natural.

Responde únicamente sobre disponibilidad, fechas, capacidad, descripciones de los apartamentos y actividades en la zona. No respondas a temas externos. Siempre que menciones fechas, asegúrate de indicar si están ocupadas o disponibles. Usa enlaces HTML si mencionas páginas web o recursos.

Tu tono es alegre, profesional y servicial. Ejemplo de saludo inicial:
“¡Hola! Soy el recepcionista de Casa Pixurri. ¿En qué puedo ayudarte hoy?”`
  }
];


async function sendMessage(messageFromSearch = null) {
    const input = document.getElementById('chat-input');
    const chatContent = document.getElementById('chat-content');
    const message = messageFromSearch || input.value.trim();


    if (message) {
        chatContent.innerHTML += `<div class='chatbot-message user-message'>${message}</div>`;
        input.value = '';

        chatHistory.push({ role: "user", content: message });

        try {
            const response = await fetch('https://primary-production-f8baf.up.railway.app/webhook-test/aec53179-75f9-45cf-a835-4c571bbd415c', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ history: chatHistory })
            });

            let text = await response.text();
            console.log("Respuesta del servidor (sin procesar):", text);

            // Eliminar caracteres de control problemáticos
            text = text.replace(/[\u0000-\u001F\u007F-\u009F]/g, "");

            try {
                const data = JSON.parse(text);

                if (data && data.message) {
                    let formattedMessage = data.message.replace(/\n/g, "<br>");

                    // Convertir Markdown a HTML (reemplazar enlaces Markdown por HTML)
                    formattedMessage = formattedMessage.replace(/\[([^\]]+)\]\((https?:\/\/[^\s]+)\)/g, '<a href="$2" target="_blank">$1</a>');

                    const messageElement = document.createElement('div');
                    messageElement.classList.add('chatbot-message', 'bot-message');
                    messageElement.innerHTML = formattedMessage;

                    chatContent.appendChild(messageElement);

                    chatHistory.push({ role: "assistant", content: data.message });

                    if (chatHistory.length > 20) {
                        chatHistory = chatHistory.slice(-20);
                    }
                } else {
                    chatContent.innerHTML += `<div class='chatbot-message bot-message'>No tengo una respuesta en este momento.</div>`;
                }
            } catch (jsonError) {
                console.error("Error al procesar JSON:", jsonError);
                chatContent.innerHTML += `<div class='chatbot-message bot-message'>Respuesta no válida del servidor.</div>`;
            }

        } catch (error) {
            console.error("Error al obtener respuesta:", error);
            chatContent.innerHTML += `<div class='chatbot-message bot-message'>Error en la respuesta del servidor.</div>`;
        }

        chatContent.scrollTop = chatContent.scrollHeight;
    }
}

function closeChat(event) {
    event.stopPropagation(); // Evita que también se ejecute toggleChatbot()
    document.getElementById('chatbot').style.display = 'none';
}

// Opción para cerrar haciendo clic fuera del chatbot
window.addEventListener('click', function (e) {
    const chatbot = document.getElementById('chatbot');
    const searchBar = document.querySelector('.search-bar');

    if (chatbot.style.display === 'flex' &&
        !chatbot.contains(e.target) &&
        !searchBar.contains(e.target)) {
        chatbot.style.display = 'none';
    }
});


</script>








</body>
</html>
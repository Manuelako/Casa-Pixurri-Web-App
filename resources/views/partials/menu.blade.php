<!-- resources/views/partials/menu.blade.php -->
<nav class="navbar">
    <div class="logo">
        <img src="{{ asset('imagenes/capsalera2.1.png') }}" alt="Casa Pixurri">
    </div>
    <div>
        <a href="{{ url('/menu') }}">Inicio</a>
        <a href="{{ route('fotos') }}">Fotos</a>
        <a href="{{ route('apartamentos') }}">Apartamentos</a>
        <a href="{{ route('contacto') }}">Contacto</a>
    </div>
</nav>

<style>
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
        z-index: 1000;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        margin: 0 15px;
        font-size: 1rem;
        transition: color 0.3s;
    }

    .navbar a:hover {
        color: #f59e0b;
    }

    .logo img {
        height: 40px;
    }

    body {
        padding-top: 60px; /* Para evitar que el contenido quede tapado por el menú */
    }
</style>

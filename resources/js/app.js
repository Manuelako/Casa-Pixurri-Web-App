import './bootstrap';
import gsap from "gsap";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";


// Determinar la estación actual (invierno o normal)
function getSeason() {
    const month = new Date().getMonth() + 1; // Enero es 0
    if (month >= 12 || month <= 2) {
        return "winter"; // Invierno
    }
    return "normal";
}

// Animar la mano en la página
document.addEventListener("DOMContentLoaded", () => {
    const handElement = document.getElementById("animated-hand");
    const handImage = document.getElementById("hand-img");

    if (!handElement || !handImage) {
        console.error("Elemento de animación de mano no encontrado");
        return;
    }

    // Cambiar la imagen dependiendo de la estación
    const season = getSeason();
    if (season === "winter") {
        handImage.src = "/images/hand-glove.png"; // Imagen de mano con guante
    }

    // Mostrar la mano con una animación de entrada
    handElement.classList.remove("hidden");
    gsap.fromTo(
        handElement,
        { y: 200, opacity: 0 },
        { y: 0, opacity: 1, duration: 1 }
    );

    // Manejar clics en las opciones de la mano
    const choices = document.querySelectorAll(".choice");
    choices.forEach((choice) => {
        choice.addEventListener("click", (e) => {
            const video = e.target.getAttribute("data-video");
            alert(`Reproduciendo: ${video}`); // Aquí puedes integrar un reproductor de video real
        });
    });
});
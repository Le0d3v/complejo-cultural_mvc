//Navegación Responsive
document.addEventListener("DOMContentLoaded", () => {
  iniciarApp();
});

function iniciarApp() {
  navResponsive();
}

function navResponsive() {
  const navegacion = document.querySelector(".navegacion-enlaces");
  const boton = document.querySelector(".btn-resp");
  boton.addEventListener("click", () => {
    navegacion.classList.toggle("nav-resp")
  })
}
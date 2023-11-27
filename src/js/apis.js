document.addEventListener("DOMContentLoaded", () => {
  iniciarApp();
});

function iniciarApp() {
  getEventos();
  // apiServicios();
  // initMap();
  // onYouTubeIframeAPIReady();
  // navResponsive();
  // getEventos();
  // getOrganizadores();
  // modales();
} 

// DARK MODE

// Menú Responsivo 
function navResponsive() {
  try {
    const navegacion = document.querySelector(".navegacion-enlaces");
    const boton = document.querySelector(".btn-resp");
    boton.addEventListener("click", () => {
      navegacion.classList.toggle("nav-resp")
    })
  } catch (error) {
    console.log(error);
  }
}

// API para mapa de Google Maps
function initMap() {
  try {
    var ubicacion = { lat: 19.0200394, lng: -98.2401507 };
    var map = new google.maps.Map(document.getElementById("map"), {
      center: ubicacion,
      zoom: 15,
    });
    var marker = new google.maps.Marker({ position: ubicacion, map: map });
  } catch (error) {
    console.log(error);
  }
}

// Función para mostrar un video de you tube 
function onYouTubeIframeAPIReady() {
  try {
    var player = new YT.Player('player', {
      height: '530',
      width: '1000',
      videoId: '4RUaH_5wB0U', //  ID del video de YouTube
      playerVars: {
          'autoplay': 1,
          'controls': 1,
          'showinfo': 0,
          'rel': 0,
          'modestbranding': 1
      }
    });
  } catch (error) {
    console.log(error);
  } 
}

// Sidebar de Administración
let pagina = document.querySelector("#pag").value;

let menuToogle = document.querySelector(".menu-toogle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".admin-main");
let seccion1 = document.querySelector("#s1");
let seccion2 = document.querySelector("#s2");
let seccion3 = document.querySelector("#s3");
let seccion4 = document.querySelector("#s4");
let seccion5 = document.querySelector("#s5");
let seccion6 = document.querySelector("#s6");
  
menuToogle.onclick = function() {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
}

let list  = document.querySelectorAll(".list");
function activeLink() {
  list.forEach((item) => item.classList.remove("active"));
  this.classList.add("active");
}

list.forEach((item) => item.addEventListener("click", activeLink))

if(pagina == 1) {
  seccion1.classList.add("active");
  seccion2.classList.remove("active");
  seccion3.classList.remove("active");
  seccion4.classList.remove("active");
  seccion5.classList.remove("active");
  seccion6.classList.remove("active");
}

if(pagina == 2) {
  seccion1.classList.remove("active");
  seccion2.classList.add("active");
  seccion3.classList.remove("active");
  seccion4.classList.remove("active");
  seccion5.classList.remove("active");
  seccion6.classList.remove("active");
}

if(pagina == 3) {
  seccion1.classList.remove("active");
  seccion2.classList.remove("active");
  seccion3.classList.add("active");
  seccion4.classList.remove("active");
  seccion5.classList.remove("active");
  seccion6.classList.remove("active");
}

if(pagina == 4) {
  seccion1.classList.remove("active");
  seccion2.classList.remove("active");
  seccion3.classList.remove("active");
  seccion4.classList.add("active");
  seccion5.classList.remove("active");
  seccion6.classList.remove("active");
}

if(pagina == 5) {
  seccion1.classList.remove("active");
  seccion2.classList.remove("active");
  seccion3.classList.remove("active");
  seccion4.classList.remove("active");
  seccion5.classList.add("active");
  seccion6.classList.remove("active");
}

if(pagina == 6) {
  seccion1.classList.remove("active");
  seccion2.classList.remove("active");
  seccion3.classList.remove("active");
  seccion4.classList.remove("active");
  seccion5.classList.remove("active");
  seccion6.classList.add("active");
}

// API DE LUGARES DEL ESTACIONAMIENTO
async function apiServicios() {
  try {
    // Conectar con el servicio
    const resultado = await fetch(`${location.origin}/api/espacios`)

    // Formatear los resultados (JSON)
    espacios = await resultado.json();

    try {
      espacios.forEach(espacio => {
    
        // Destructuring para obtener variables y valores
        const {id, numero, ocupado, id_estacionamiento} = espacio;
        
        // Linea para  pintar el estacionamiento
        const linea1 = document.createElement("HR");
  
        // Contenedor de cada espacio 
        const contenedorEspacio = document.createElement("A");
        contenedorEspacio.setAttribute("href", `/estacionamiento/espacio?id=${id}`);
        contenedorEspacio.classList.add("espacio");
        // Comprobación para el estatus del espacios
        if(ocupado === "1") {
          contenedorEspacio.classList.add("no-disp");
        } else {
          contenedorEspacio.classList.remove("no-disp");
        }
  
        // Número de espacio
        const numeroEspacio = document.createElement("P");
        numeroEspacio.textContent = numero;
  
        // Agregar los elementos al HTML
        
        contenedorEspacio.appendChild(numeroEspacio);
        document.querySelector(".espacios").appendChild(linea1);
        document.querySelector(".espacios").appendChild(contenedorEspacio);      
      });
    } catch (error) {
      console.log();
    }
  } catch (error) {
    console.log(error);
  }
}

// API de eventos
async function getEventos() {
  try {
    const resultado = await fetch(`${location.origin}/api/eventos`)
    const eventos = await resultado.json();
  
    

    try {
      eventos.eventos.forEach( evento => {
        // Obtener variables del evento
        const {id, nombre, imagen, descripcion, fecha, hora_inicio, disponibles } = evento;

        // Contenedores
        const fichaEvento = document.createElement("DIV");
        const foto = document.createElement("DIV");
        const titulo = document.createElement("DIV");
        const info = document.createElement("DIV");
        const boton = document.createElement("DIV");

        // Clases para los Contenedores
        fichaEvento.classList.add("evento");
        foto.classList.add("evento-foto");
        titulo.classList.add("evento-titulo");
        info.classList.add("evento-info");
        boton.classList.add("evento-boton");

        // Nombre del evento
        const nombreEv = document.createElement("H1");
        nombreEv.textContent = nombre;

        // Imagen del evento
        const img = document.createElement("IMG");
        img.setAttribute("src", `/img/${imagen}`);
        img.setAttribute("height", `300`);
        img.setAttribute("width", `400`);

        // Fecha del evento
        const fechaEv = document.createElement("P");
        fechaEv.classList.add("evento-fecha");
        fechaEv.textContent = `${fecha} - ${hora_inicio}`;

        // Descripción del evento
        const texto = document.createElement("P");
        texto.textContent = descripcion;

        // Espacios disponibles del evento
        const espacios = document.createElement("P");
        espacios.textContent = `Lugares disponibles: ${disponibles}`

        // Botón del evento
        const botonEvento = document.createElement("A");
        botonEvento.textContent = "Ver Evento";
        botonEvento.classList.add("boton-azul-block");
        botonEvento.setAttribute("href", `/home/evento?id=${id}`);

        // Agregar los elementos al HTML
        // Contenedor de foto
        titulo.appendChild(nombreEv);
        foto.appendChild(img);
        foto.appendChild(titulo);

        // Contenedor de información.
        info.appendChild(fechaEv);
        info.appendChild(texto);
        info.appendChild(espacios);

        // Boton
        boton.appendChild(botonEvento);

        // Agregar la ficha al HTML.
        fichaEvento.appendChild(foto);
        fichaEvento.appendChild(info);
        fichaEvento.appendChild(boton);

        document.querySelector("#listado-eventos").appendChild(fichaEvento);

      })
    } catch (error) {
      console.log(error);
    }
  } catch (error) {
    console.log(error);
  }
}s

async function getOrganizadores() {
  try {
    const resultado = await fetch(`${location.origin}/api/organizadores`);
    const organizadores = await resultado.json();

    try {
      organizadores.forEach(organizador => {
        const {id, nombre, apellido, correo} = organizador;

        const enlace = document.createComment("A");
        enlace.textContent = `${nombre} ${apellido} - ${correo}`;
        enlace.setAttribute("href", `/organizadores/organizador?id=${id}`);

        document.querySelector("#listado-organizadores").appendChild(enlace);

      });
    } catch(error) {
      console.log(error);
    }
  } catch (error) {
    console.log(error);
  }
}

function modales() {
  const body = document.querySelector("body");
  const dialog = document.querySelector(".modal");
  const shbtn = document.querySelector(".mostrar-modal");
  const clbtn = document.querySelector(".cerrar-modal");

  shbtn.addEventListener("click", () => {
    body.classList.add("modal");
    dialog.showModal();
  })

  clbtn.addEventListener("click", () => {
    body.classList.remove("modal");
    dialog.close();
  })
}
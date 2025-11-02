<?php 
    include "vistaCursos/cabecera.php";
 ?>

<?php 
    include "vistaCursos/head.php";
 ?>
 <?php 
    include "vistaCursos/main.php";
 ?>
 <?php 
    include "vistaCursos/foot.php";
 ?>



  <script src="script.js"></script>
  <script>
    // Cursos con diferentes categorías
    const cursos = [
      {
        id: 1,
        nombre: "Curso de HTML y CSS",
        descripcion: "Aprende desde cero a maquetar páginas web con buenas prácticas.",
        categoria: "programacion",
        imagen: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=250&fit=crop",
        duracion: "8 horas",
        nivel: "Principiante",
        preguntas: [
          {
            pregunta: "¿Qué significa HTML?",
            opciones: [
              "Hyper Text Markup Language",
              "High Tech Modern Language", 
              "Home Tool Markup Language",
              "Hyper Transfer Markup Language"
            ],
            respuesta: 0
          },
          {
            pregunta: "¿Qué propiedad CSS se usa para cambiar el color de fondo?",
            opciones: [
              "color",
              "background-color",
              "bg-color",
              "background"
            ],
            respuesta: 1
          }
        ]
      },
      {
        id: 2,
        nombre: "JavaScript desde Cero",
        descripcion: "Domina el lenguaje más utilizado para desarrollo web.",
        categoria: "programacion", 
        imagen: "https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=400&h=250&fit=crop",
        duracion: "12 horas",
        nivel: "Principiante",
        preguntas: [
          {
            pregunta: "¿Cómo se declara una variable en JavaScript?",
            opciones: [
              "variable x = 5;",
              "var x = 5;",
              "x = 5;",
              "let x = 5;"
            ],
            respuesta: 3
          }
        ]
      },
      {
        id: 3,
        nombre: "Cocina Italiana Básica",
        descripcion: "Aprende a preparar pasta, pizza y otros platos italianos auténticos.",
        categoria: "cocina",
        imagen: "https://images.unsplash.com/photo-1535930749574-1399327ce78f?w=400&h=250&fit=crop",
        duracion: "6 horas", 
        nivel: "Principiante",
        preguntas: [
          {
            pregunta: "¿Cuál es el ingrediente principal de la pasta fresca?",
            opciones: [
              "Harina y agua",
              "Harina y huevos",
              "Sémola y agua",
              "Harina y leche"
            ],
            respuesta: 1
          }
        ]
      },
      {
        id: 4,
        nombre: "Guitarra para Principiantes",
        descripcion: "Aprende acordes básicos y tus primeras canciones en guitarra.",
        categoria: "musica",
        imagen: "https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=400&h=250&fit=crop",
        duracion: "10 horas",
        nivel: "Principiante",
        preguntas: [
          {
            pregunta: "¿Cuántas cuerdas tiene una guitarra estándar?",
            opciones: ["4", "5", "6", "7"],
            respuesta: 2
          }
        ]
      },
      {
        id: 5,
        nombre: "Pintura al Óleo",
        descripcion: "Técnicas básicas de pintura al óleo para crear tus primeras obras.",
        categoria: "arte", 
        imagen: "https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=400&h=250&fit=crop",
        duracion: "15 horas",
        nivel: "Intermedio",
        preguntas: [
          {
            pregunta: "¿Qué se usa tradicionalmente para diluir la pintura al óleo?",
            opciones: [
              "Agua",
              "Aceite de linaza",
              "Alcohol",
              "Aguarrás"
            ],
            respuesta: 3
          }
        ]
      },
      {
        id: 6,
        nombre: "Marketing Digital",
        descripcion: "Estrategias de marketing online para emprendedores y pequeñas empresas.",
        categoria: "negocios",
        imagen: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop",
        duracion: "9 horas",
        nivel: "Principiante",
        preguntas: [
          {
            pregunta: "¿Qué significa SEO?",
            opciones: [
              "Search Engine Optimization",
              "Social Engagement Optimization",
              "Search Engagement Online",
              "Social Engine Optimization"
            ],
            respuesta: 0
          }
        ]
      }
    ];

    // Guardar cursos en localStorage
    localStorage.setItem('cursosData', JSON.stringify(cursos));

    // Función para cargar cursos
    function cargarCursos(categoria = 'all') {
      const container = document.getElementById('cursosContainer');
      const cursosInscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
      
      console.log('Cursos inscritos detectados:', cursosInscritos); // Para debug
      
      const cursosFiltrados = categoria === 'all' 
        ? cursos 
        : cursos.filter(curso => curso.categoria === categoria);

      container.innerHTML = cursosFiltrados.map(curso => {
        const estaInscrito = cursosInscritos.includes(curso.nombre);
        const botonTexto = estaInscrito ? '✓ Ya Inscrito' : 'Inscribirse';
        const botonClase = estaInscrito 
          ? 'bg-green-600 text-white px-4 py-2 rounded cursor-not-allowed opacity-80' 
          : 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition';

        return `
          <div class="course-card bg-white rounded-lg shadow overflow-hidden" data-category="${curso.categoria}">
            <img src="${curso.imagen}" alt="${curso.nombre}" class="w-full h-48 object-cover">
            <div class="p-4">
              <div class="flex justify-between items-start mb-2">
                <h3 class="text-xl font-semibold">${curso.nombre}</h3>
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">${curso.nivel}</span>
              </div>
              <p class="text-sm text-gray-600 mb-3">${curso.descripcion}</p>
              <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                <span>⏱️ ${curso.duracion}</span>
                <span>📚 ${curso.preguntas.length} evaluaciones</span>
              </div>
              <button 
                onclick="${estaInscrito ? '' : `inscribirse('${curso.nombre}')`}" 
                class="w-full ${botonClase}"
                ${estaInscrito ? 'disabled' : ''}
              >
                ${botonTexto}
              </button>
              ${estaInscrito ? `
                <button 
                  onclick="iniciarEvaluacion(${curso.id})" 
                  class="w-full mt-2 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition"
                >
                  📝 Tomar Evaluación
                </button>
              ` : ''}
            </div>
          </div>
        `;
      }).join('');
    }

    // Función para filtrar cursos
    function filterCourses(categoria) {
      cargarCursos(categoria);
      
      // Actualizar estado de botones de filtro
      document.querySelectorAll('button').forEach(btn => {
        if (btn.textContent.includes('Todos') && categoria === 'all') {
          btn.className = 'px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition';
        } else if (btn.textContent.toLowerCase().includes(categoria)) {
          btn.className = 'px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition';
        } else if (!btn.textContent.includes('Todos')) {
          btn.className = 'px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition';
        }
      });
    }

    // En cursos.html, reemplaza la función iniciarEvaluacion con esta:

function iniciarEvaluacion(cursoId) {
  const curso = cursos.find(c => c.id === cursoId);
  if (curso) {
    // Guardar solo la información necesaria para la evaluación
    const evaluacionData = {
      id: curso.id,
      nombre: curso.nombre,
      // No guardamos las preguntas aquí, las tomamos del objeto preguntasPorCurso
    };
    
    localStorage.setItem('evaluacionActual', JSON.stringify(evaluacionData));
    window.location.href = 'evaluacion.php';
  } else {
    alert('Curso no encontrado.');
  }
}

    // Función de inscripción corregida
    function inscribirse(nombreCurso) {
      let inscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
      
      if (!inscritos.includes(nombreCurso)) {
        inscritos.push(nombreCurso);
        localStorage.setItem('cursosInscritos', JSON.stringify(inscritos));
        
        // Inicializar progreso para este curso
        const courseProgress = JSON.parse(localStorage.getItem('courseProgress')) || {};
        if (!courseProgress[nombreCurso]) {
          courseProgress[nombreCurso] = {
            modulesCompleted: ['Inscripción'],
            totalTime: 0,
            startDate: new Date().toISOString(),
            completed: false
          };
          localStorage.setItem('courseProgress', JSON.stringify(courseProgress));
        }
        
        alert('Te has inscrito en ' + nombreCurso);
        cargarCursos(); // Recargar para mostrar cambios
      } else {
        alert('Ya estás inscrito en este curso.');
      }
    }

    // Cargar cursos al iniciar
    document.addEventListener('DOMContentLoaded', function() {
      // Verificar autenticación
      const usuario = localStorage.getItem('usuario');
      if (!usuario) {
        alert('Debes iniciar sesión para ver los cursos.');
        window.location.href = 'login.php';
        return;
      }
      
      cargarCursos();
    });

    // Función para cerrar sesión
    function logout() {
      if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
        localStorage.removeItem('usuario');
        localStorage.removeItem('nombre');
        window.location.href = 'login.php';
      }
    }
  </script>
</body>
</html>
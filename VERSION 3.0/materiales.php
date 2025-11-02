<?php 
    include "vistaMateriales/cabecera.php";
 ?>

<?php 
    include "vistaMateriales/head.php";
 ?>
 <?php 
    include "vistaMateriales/main.php";
 ?>
 <?php 
    include "vistaMateriales/pie.php";
 ?>



  <script src="script.js"></script>
  <script>
    // Base de datos de materiales
    const materiales = [
      // ===== LIBROS =====
      {
        id: 1,
        titulo: "HTML & CSS: Design and Build Websites",
        descripcion: "Libro completo para aprender HTML y CSS desde cero con ejemplos prácticos.",
        tipo: "libros",
        categoria: "programacion",
        formato: "PDF",
        paginas: 512,
        autor: "Jon Duckett",
        imagen: "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=250&fit=crop",
        enlace: "https://www.pdfdrive.com/html-css-design-and-build-websites-e187837484.html",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.8
      },
      {
        id: 2,
        titulo: "JavaScript: The Good Parts",
        descripcion: "Aprende las mejores partes de JavaScript según Douglas Crockford.",
        tipo: "libros",
        categoria: "programacion",
        formato: "PDF",
        paginas: 176,
        autor: "Douglas Crockford",
        imagen: "https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=400&h=250&fit=crop",
        enlace: "https://www.pdfdrive.com/javascript-the-good-parts-e163453538.html",
        esGratuito: true,
        nivel: "Intermedio",
        rating: 4.7
      },
      {
        id: 3,
        titulo: "Python Crash Course",
        descripcion: "Guía práctica para aprender Python rápidamente con proyectos reales.",
        tipo: "libros",
        categoria: "programacion",
        formato: "PDF",
        paginas: 544,
        autor: "Eric Matthes",
        imagen: "https://images.unsplash.com/photo-1526379879527-8559ecfcaec0?w=400&h=250&fit=crop",
        enlace: "https://www.pdfdrive.com/python-crash-course-2nd-edition-e195398513.html",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.6
      },
      {
        id: 4,
        titulo: "El Arte de la Cocina Italiana",
        descripcion: "Recetas tradicionales y técnicas de la cocina italiana auténtica.",
        tipo: "libros",
        categoria: "cocina",
        formato: "PDF",
        paginas: 320,
        autor: "Marcella Hazan",
        imagen: "https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=400&h=250&fit=crop",
        enlace: "https://www.pdfdrive.com/el-arte-de-la-cocina-italiana-e187837484.html",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.5
      },
      {
        id: 5,
        titulo: "Teoría Musical para Principiantes",
        descripcion: "Fundamentos de la teoría musical, lectura de partituras y acordes.",
        tipo: "libros",
        categoria: "musica",
        formato: "PDF",
        paginas: 256,
        autor: "Michael Miller",
        imagen: "https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=400&h=250&fit=crop",
        enlace: "https://www.pdfdrive.com/teoria-musical-para-principiantes-e163453538.html",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.4
      },

      // ===== VIDEOS =====
      {
        id: 6,
        titulo: "CSS Grid Layout Masterclass",
        descripcion: "Video tutorial completo sobre CSS Grid con ejemplos prácticos.",
        tipo: "videos",
        categoria: "programacion",
        formato: "MP4",
        duracion: "2h 15m",
        instructor: "Wes Bos",
        imagen: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=250&fit=crop",
        enlace: "https://www.youtube.com/watch?v=HgwCeNVPlo0",
        esGratuito: true,
        nivel: "Intermedio",
        rating: 4.9
      },
      {
        id: 7,
        titulo: "JavaScript Moderno ES6+",
        descripcion: "Aprende las nuevas características de JavaScript moderno.",
        tipo: "videos",
        categoria: "programacion",
        formato: "MP4",
        duracion: "3h 30m",
        instructor: "Fernando Herrera",
        imagen: "https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=400&h=250&fit=crop",
        enlace: "https://www.youtube.com/watch?v=2SetvwBV-SU",
        esGratuito: true,
        nivel: "Intermedio",
        rating: 4.8
      },
      {
        id: 8,
        titulo: "Técnicas de Pintura al Óleo",
        descripcion: "Demostración de técnicas profesionales de pintura al óleo.",
        tipo: "videos",
        categoria: "arte",
        formato: "MP4",
        duracion: "1h 45m",
        instructor: "Bob Ross",
        imagen: "https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=400&h=250&fit=crop",
        enlace: "https://www.youtube.com/watch?v=lLWEXRAnQd0",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.7
      },

      // ===== GUÍAS =====
      {
        id: 9,
        titulo: "Guía Completa de Git y GitHub",
        descripcion: "Guía paso a paso para el control de versiones con Git y GitHub.",
        tipo: "guias",
        categoria: "programacion",
        formato: "PDF",
        paginas: 89,
        autor: "FreeCodeCamp",
        imagen: "https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=400&h=250&fit=crop",
        enlace: "https://www.freecodecamp.org/espanol/news/guia-para-principiantes-de-git-y-github/",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.8
      },
      {
        id: 10,
        titulo: "Guía de Acordes de Guitarra",
        descripcion: "Diccionario completo de acordes para guitarra con digitaciones.",
        tipo: "guias",
        categoria: "musica",
        formato: "PDF",
        paginas: 64,
        autor: "Justin Guitar",
        imagen: "https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=400&h=250&fit=crop",
        enlace: "https://www.justinguitar.com/guitar-lessons/",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.6
      },

      // ===== EJERCICIOS =====
      {
        id: 11,
        titulo: "Ejercicios de HTML y CSS",
        descripcion: "100 ejercicios prácticos para mejorar tus habilidades en HTML y CSS.",
        tipo: "ejercicios",
        categoria: "programacion",
        formato: "ZIP",
        ejercicios: 100,
        autor: "Frontend Mentor",
        imagen: "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=400&h=250&fit=crop",
        enlace: "https://www.frontendmentor.io/",
        esGratuito: true,
        nivel: "Principiante-Intermedio",
        rating: 4.7
      },
      {
        id: 12,
        titulo: "Retos de JavaScript",
        descripcion: "Colección de 50 retos de programación en JavaScript.",
        tipo: "ejercicios",
        categoria: "programacion",
        formato: "ZIP",
        ejercicios: 50,
        autor: "JavaScript30",
        imagen: "https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=400&h=250&fit=crop",
        enlace: "https://javascript30.com/",
        esGratuito: true,
        nivel: "Intermedio",
        rating: 4.9
      },

      // ===== CHEAT SHEETS =====
      {
        id: 13,
        titulo: "Cheat Sheet de Tailwind CSS",
        descripcion: "Referencia rápida de todas las clases de Tailwind CSS.",
        tipo: "cheatsheets",
        categoria: "programacion",
        formato: "PDF",
        paginas: 12,
        autor: "Tailwind CSS",
        imagen: "https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400&h=250&fit=crop",
        enlace: "https://tailwindcss.com/docs/cheatsheet",
        esGratuito: true,
        nivel: "Todos",
        rating: 4.8
      },
      {
        id: 14,
        titulo: "Cheat Sheet de Git",
        descripcion: "Comandos esenciales de Git para el día a día.",
        tipo: "cheatsheets",
        categoria: "programacion",
        formato: "PDF",
        paginas: 8,
        autor: "GitHub",
        imagen: "https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=400&h=250&fit=crop",
        enlace: "https://education.github.com/git-cheat-sheet-education.pdf",
        esGratuito: true,
        nivel: "Todos",
        rating: 4.7
      },
      {
        id: 15,
        titulo: "Cheat Sheet de Acordes de Piano",
        descripcion: "Diagramas de acordes esenciales para piano.",
        tipo: "cheatsheets",
        categoria: "musica",
        formato: "PDF",
        paginas: 6,
        autor: "Piano Lessons",
        imagen: "https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=400&h=250&fit=crop",
        enlace: "https://www.pianolessons.com/piano-lessons/piano-chart.php",
        esGratuito: true,
        nivel: "Principiante",
        rating: 4.5
      }
    ];

    // Función para cargar materiales
    function cargarMateriales(categoria = 'all') {
      const container = document.getElementById('materialsContainer');
      const materialesFiltrados = categoria === 'all' 
        ? materiales 
        : materiales.filter(material => material.tipo === categoria);

      container.innerHTML = materialesFiltrados.map(material => {
        const badgeColor = {
          'libros': 'bg-blue-500 text-white',
          'videos': 'bg-red-500 text-white',
          'guias': 'bg-green-500 text-white',
          'ejercicios': 'bg-purple-500 text-white',
          'cheatsheets': 'bg-yellow-500 text-black'
        }[material.tipo];

        const icon = {
          'libros': '📖',
          'videos': '🎥',
          'guias': '📋',
          'ejercicios': '💪',
          'cheatsheets': '🎯'
        }[material.tipo];

        return `
          <div class="material-card rounded-lg shadow-md overflow-hidden border border-gray-200" data-type="${material.tipo}">
            <div class="relative">
              <img src="${material.imagen}" alt="${material.titulo}" class="w-full h-48 object-cover">
              <span class="category-badge ${badgeColor} font-semibold">
                ${icon} ${material.tipo}
              </span>
            </div>
            
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-2">${material.titulo}</h3>
              <p class="text-sm text-gray-600 mb-3">${material.descripcion}</p>
              
              <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                <div class="flex items-center space-x-4">
                  <span>${material.nivel}</span>
                  <span>⭐ ${material.rating}</span>
                </div>
                <span class="bg-gray-100 px-2 py-1 rounded">${material.formato}</span>
              </div>
              
              ${material.paginas ? `
                <div class="text-xs text-gray-500 mb-3">
                  📄 ${material.paginas} páginas
                </div>
              ` : ''}
              
              ${material.duracion ? `
                <div class="text-xs text-gray-500 mb-3">
                  ⏱️ ${material.duracion}
                </div>
              ` : ''}
              
              ${material.ejercicios ? `
                <div class="text-xs text-gray-500 mb-3">
                  🎯 ${material.ejercicios} ejercicios
                </div>
              ` : ''}
              
              <div class="flex space-x-2">
                <a href="${material.enlace}" target="_blank" 
                   class="flex-1 download-btn text-white text-center py-2 px-4 rounded font-semibold text-sm"
                   onclick="trackMaterialAccess('${material.titulo}', '${material.tipo}')">
                  ${material.tipo === 'videos' ? '🎥 Ver Video' : '📥 Descargar'}
                </a>
                <button onclick="toggleFavorite(${material.id})" 
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-3 rounded text-sm">
                  ❤️
                </button>
              </div>
            </div>
          </div>
        `;
      }).join('');

      // Actualizar estadísticas
      actualizarEstadisticas();
    }

    // Función para filtrar materiales
    function filterMaterials(tipo) {
      cargarMateriales(tipo);
      
      // Actualizar botones activos
      document.querySelectorAll('button').forEach(btn => {
        if (btn.textContent.includes('Todos') && tipo === 'all') {
          btn.className = 'px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition text-sm font-medium';
        } else if (btn.textContent.toLowerCase().includes(tipo)) {
          btn.className = 'px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition text-sm font-medium';
        } else if (!btn.textContent.includes('Todos')) {
          btn.className = 'px-4 py-2 bg-gray-200 rounded-full hover:bg-gray-300 transition text-sm font-medium';
        }
      });
    }

    // Función para actualizar estadísticas
    function actualizarEstadisticas() {
      const materialHistory = JSON.parse(localStorage.getItem('materialHistory')) || [];
      const favoriteMaterials = JSON.parse(localStorage.getItem('favoriteMaterials')) || [];
      
      document.getElementById('totalMaterials').textContent = materiales.length;
      document.getElementById('downloadedMaterials').textContent = materialHistory.length;
      document.getElementById('viewedMaterials').textContent = materialHistory.filter(m => m.type === 'video').length;
      document.getElementById('favoriteMaterials').textContent = favoriteMaterials.length;
    }

    // Función para trackear acceso a materiales
    function trackMaterialAccess(materialName, materialType) {
      let materialHistory = JSON.parse(localStorage.getItem('materialHistory')) || [];
      
      materialHistory.push({
        name: materialName,
        type: materialType,
        accessedAt: new Date().toISOString()
      });

      localStorage.setItem('materialHistory', JSON.stringify(materialHistory));
      
      // Otorgar puntos por acceder a material
      if (window.RewardSystem) {
        window.RewardSystem.awardPoints(5, `Accediste a ${materialName}`);
      }
      
      // Verificar logro por uso de materiales
      if (materialHistory.length >= 3) {
        if (window.RewardSystem) {
          window.RewardSystem.unlockAchievement('Material Explorer', 'Accediste a 3 materiales diferentes');
        }
      }
      
      actualizarEstadisticas();
    }

    // Función para favoritos
    function toggleFavorite(materialId) {
      let favoriteMaterials = JSON.parse(localStorage.getItem('favoriteMaterials')) || [];
      
      if (favoriteMaterials.includes(materialId)) {
        favoriteMaterials = favoriteMaterials.filter(id => id !== materialId);
        showNotification('Removido de favoritos', 'info');
      } else {
        favoriteMaterials.push(materialId);
        showNotification('Agregado a favoritos', 'success');
        
        // Otorgar puntos por agregar a favoritos
        if (window.RewardSystem) {
          window.RewardSystem.awardPoints(2, 'Material agregado a favoritos');
        }
      }
      
      localStorage.setItem('favoriteMaterials', JSON.stringify(favoriteMaterials));
      actualizarEstadisticas();
    }

    // Función para mostrar notificaciones
    function showNotification(message, type = 'info') {
      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 ${
        type === 'success' ? 'bg-green-500' : 'bg-blue-500'
      }`;
      notification.innerHTML = `
        <div class="font-bold">${type === 'success' ? '✅' : 'ℹ️'} ${message}</div>
      `;

      document.body.appendChild(notification);

      setTimeout(() => {
        notification.remove();
      }, 3000);
    }

    // Cargar materiales al iniciar
    document.addEventListener('DOMContentLoaded', function() {
      cargarMateriales();
      
      // Verificar autenticación
      const usuario = localStorage.getItem('usuario');
      if (!usuario) {
        alert('Debes iniciar sesión para acceder a los materiales.');
        window.location.href = 'login.php';
      }
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
<?php 
    include "vistaDashboard/cabecera.php";
 ?>

<?php 
    include "vistaDashboard/head.php";
 ?>
 <?php 
    include "vistaDashboard/main.php";
 ?>
 <?php 
    include "vistaDashboard/foot.php";
 ?>


  <script src="script.js"></script>
  <script>
    // Obtener nombre y correo del usuario
    const correo = localStorage.getItem('usuario');
    const nombre = localStorage.getItem('nombre');

    if (!correo || !nombre) {
      window.location.href = 'login.php';
    } else {
      document.getElementById('usuario').textContent = `${nombre} (${correo})`;
    }

    // Función para limpiar datos corruptos
    function cleanDashboardData() {
      const cursosInscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
      
      // SOLUCIÓN: Filtrar solo strings válidos que sean nombres reales
      const cursosFiltrados = cursosInscritos.filter(curso => {
        // Eliminar números y datos corruptos
        if (typeof curso !== 'string') return false;
        if (curso === '3' || curso === '4') return false;
        if (!isNaN(parseInt(curso))) return false;
        return curso.trim() !== '';
      });
      
      if (cursosFiltrados.length !== cursosInscritos.length) {
        localStorage.setItem('cursosInscritos', JSON.stringify(cursosFiltrados));
        console.log('Datos corruptos eliminados:', cursosInscritos.filter(c => !cursosFiltrados.includes(c)));
      }
      
      return cursosFiltrados;
    }

    // Mostrar progreso en el dashboard
    function loadProgressData() {
      // Limpiar datos primero
      const cursosInscritos = cleanDashboardData();
      const courseProgress = JSON.parse(localStorage.getItem('courseProgress')) || {};
      
      console.log('Cursos válidos en dashboard:', cursosInscritos);

      // Estadísticas generales
      const completedCourses = Object.values(courseProgress).filter(progress => progress && progress.completed).length;
      const totalStudyTime = Object.values(courseProgress).reduce((total, progress) => {
        return total + (progress && progress.totalTime ? progress.totalTime : 0);
      }, 0);
      
      document.getElementById('progressStats').innerHTML = `
        <div class="bg-blue-50 p-4 rounded-lg text-center">
          <div class="text-2xl font-bold text-blue-700">${cursosInscritos.length}</div>
          <div class="text-sm text-blue-600">Cursos Inscritos</div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg text-center">
          <div class="text-2xl font-bold text-green-700">${completedCourses}</div>
          <div class="text-sm text-green-600">Cursos Completados</div>
        </div>
        <div class="bg-purple-50 p-4 rounded-lg text-center">
          <div class="text-2xl font-bold text-purple-700">${Math.floor(totalStudyTime / 60)}h</div>
          <div class="text-sm text-purple-600">Tiempo Estudiado</div>
        </div>
      `;
      
      // Progreso por curso
      const coursesProgress = document.getElementById('coursesProgress');
      
      if (cursosInscritos.length === 0) {
        coursesProgress.innerHTML = `
          <div class="bg-white/80 backdrop-blur-md border-l-4 border-yellow-400 p-6 rounded shadow text-gray-800">
            <p class="text-lg font-semibold mb-2">📚 Aún no estás inscrito en ningún curso.</p>
            <p class="text-sm">👉 ¿Quieres explorar cursos? 
              <a href="cursos.php" class="text-blue-600 hover:underline font-semibold">Ver cursos</a>
            </p>
          </div>
        `;
      } else {
        coursesProgress.innerHTML = cursosInscritos.map(curso => {
          const progress = courseProgress[curso];
          const progressPercent = progress && progress.modulesCompleted ? (progress.modulesCompleted.length / 5) * 100 : 0;
          const modulesCompleted = progress && progress.modulesCompleted ? progress.modulesCompleted.length : 0;
          
          return `
            <div class="bg-white/80 backdrop-blur-md border-l-4 border-blue-400 p-4 rounded shadow">
              <div class="flex justify-between items-center mb-2">
                <h4 class="font-semibold text-blue-800">${curso}</h4>
                <span class="text-sm font-bold ${progressPercent === 100 ? 'text-green-600' : 'text-blue-600'}">
                  ${Math.round(progressPercent)}%
                </span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                <div class="bg-green-500 h-3 rounded-full transition-all duration-1000" 
                     style="width: ${progressPercent}%"></div>
              </div>
              <div class="text-xs text-gray-500">
                ${modulesCompleted}/5 módulos completados
                ${progress && progress.completed ? '✅ Curso Completado' : ''}
              </div>
            </div>
          `;
        }).join('');
      }
    }
    
    // Cargar datos cuando la página esté lista
    document.addEventListener('DOMContentLoaded', loadProgressData);

    // Función para cerrar sesión
    function logout() {
      if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
        localStorage.removeItem('usuario');
        localStorage.removeItem('nombre');
        window.location.href = 'login.php';
      }
    }

    // SOLUCIÓN EXTRA: Forzar limpieza al cargar
    setTimeout(() => {
      const cursos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
      const tieneCorruptos = cursos.some(curso => curso === '3' || curso === '4' || !isNaN(parseInt(curso)));
      if (tieneCorruptos) {
        cleanDashboardData();
        loadProgressData(); // Recargar
      }
    }, 500);
  </script>
</body>
</html>
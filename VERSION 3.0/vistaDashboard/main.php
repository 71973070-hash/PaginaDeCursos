
  <!-- Contenido principal -->
  <main class="container mx-auto p-6 flex-1">
    <h2 class="text-xl font-bold mb-4">Bienvenido, <span id="usuario"></span></h2>

    <!-- Sección de Estadísticas -->
    <div id="progressSection" class="mb-8">
      <h3 class="text-lg font-bold mb-4 text-blue-800">📊 Tu Progreso General</h3>
      <div id="progressStats" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Las estadísticas se cargan dinámicamente -->
      </div>
    </div>

    <!-- Sección de Cursos -->
    <div id="seccionCursos">
      <p class="mb-4 text-lg font-semibold text-blue-800">Estos son tus cursos inscritos:</p>
      <div id="coursesProgress" class="space-y-4">
        <!-- El progreso de cada curso se carga aquí -->
      </div>
    </div>
  </main>
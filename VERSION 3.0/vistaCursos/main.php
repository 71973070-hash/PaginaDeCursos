
  <main class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Nuestros Cursos</h2>

    <!-- Filtros de categoría -->
    <div class="mb-6 flex flex-wrap gap-2">
      <button onclick="filterCourses('all')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Todos</button>
      <button onclick="filterCourses('programacion')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Programación</button>
      <button onclick="filterCourses('cocina')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Cocina</button>
      <button onclick="filterCourses('musica')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Música</button>
      <button onclick="filterCourses('arte')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Arte</button>
      <button onclick="filterCourses('negocios')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Negocios</button>
    </div>

    <div id="cursosContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Los cursos se cargarán dinámicamente -->
    </div>
  </main>
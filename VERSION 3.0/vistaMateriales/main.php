
  <!-- Contenido principal -->
  <main class="flex-1 p-6 container mx-auto">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-3xl font-bold mb-2 text-blue-800">📚 Biblioteca de Materiales</h2>
      <p class="text-gray-600 mb-8">Accede a libros, videos, guías y recursos exclusivos para complementar tu aprendizaje.</p>

      <!-- Filtros por categoría -->
      <div class="mb-8 bg-white rounded-lg p-6 shadow-sm">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Filtrar por categoría:</h3>
        <div class="flex flex-wrap gap-2">
          <button onclick="filterMaterials('all')" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition text-sm font-medium">
            Todos
          </button>
          <button onclick="filterMaterials('libros')" class="px-4 py-2 bg-gray-200 rounded-full hover:bg-gray-300 transition text-sm font-medium">
            📖 Libros
          </button>
          <button onclick="filterMaterials('videos')" class="px-4 py-2 bg-gray-200 rounded-full hover:bg-gray-300 transition text-sm font-medium">
            🎥 Videos
          </button>
          <button onclick="filterMaterials('guias')" class="px-4 py-2 bg-gray-200 rounded-full hover:bg-gray-300 transition text-sm font-medium">
            📋 Guías
          </button>
          <button onclick="filterMaterials('ejercicios')" class="px-4 py-2 bg-gray-200 rounded-full hover:bg-gray-300 transition text-sm font-medium">
            💪 Ejercicios
          </button>
          <button onclick="filterMaterials('cheatsheets')" class="px-4 py-2 bg-gray-200 rounded-full hover:bg-gray-300 transition text-sm font-medium">
            🎯 Cheat Sheets
          </button>
        </div>
      </div>

      <!-- Estadísticas de materiales -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-blue-600" id="totalMaterials">0</div>
          <div class="text-sm text-gray-600">Materiales Totales</div>
        </div>
        <div class="bg-white rounded-lg p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-green-600" id="downloadedMaterials">0</div>
          <div class="text-sm text-gray-600">Descargados</div>
        </div>
        <div class="bg-white rounded-lg p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-purple-600" id="viewedMaterials">0</div>
          <div class="text-sm text-gray-600">Vistos</div>
        </div>
        <div class="bg-white rounded-lg p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-yellow-600" id="favoriteMaterials">0</div>
          <div class="text-sm text-gray-600">Favoritos</div>
        </div>
      </div>

      <!-- Lista de materiales -->
      <div id="materialsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Los materiales se cargan dinámicamente -->
      </div>
    </div>
  </main>

  <!-- Contenido principal -->
  <main class="flex-1 p-6 container mx-auto">
    <div class="max-w-7xl mx-auto">
      
      <!-- Header de Recompensas -->
      <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl shadow-xl p-8 mb-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div class="text-center md:text-left mb-6 md:mb-0">
            <h2 class="text-4xl font-bold mb-2">🏆 Tus Recompensas</h2>
            <p class="text-purple-100 text-lg">Gana puntos, desbloquea logros y sube de nivel mientras aprendes</p>
          </div>
          
          <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6 text-center">
            <div class="text-3xl font-bold mb-1" id="totalPoints">0</div>
            <div class="text-purple-100">Puntos Totales</div>
          </div>
        </div>
      </div>

      <!-- Estadísticas Rápidas -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-blue-600" id="totalAchievements">0</div>
          <div class="text-sm text-gray-600">Logros</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-green-600" id="totalBadges">0</div>
          <div class="text-sm text-gray-600">Insignias</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-yellow-600" id="userLevel">1</div>
          <div class="text-sm text-gray-600">Nivel Actual</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
          <div class="text-2xl font-bold text-purple-600" id="nextLevelPoints">500</div>
          <div class="text-sm text-gray-600">Puntos para subir</div>
        </div>
      </div>

      <!-- Barra de Progreso de Nivel -->
      <div class="bg-white rounded-xl p-6 mb-8 shadow-sm">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold text-gray-800">📈 Tu Progreso</h3>
          <span class="level-badge px-3 py-1 rounded-full text-sm font-semibold">Nivel <span id="currentLevel">1</span></span>
        </div>
        
        <div class="mb-2">
          <div class="flex justify-between text-sm text-gray-600 mb-1">
            <span><span id="currentPoints">0</span> puntos</span>
            <span><span id="nextLevel">500</span> puntos para nivel <span id="nextLevelNumber">2</span></span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-4">
            <div id="levelProgressBar" class="bg-gradient-to-r from-blue-500 to-purple-500 h-4 rounded-full transition-all duration-1000" style="width: 0%"></div>
          </div>
        </div>
        
        <div class="grid grid-cols-5 gap-2 text-xs text-gray-500 mt-2">
          <div>N1</div>
          <div>N2</div>
          <div>N3</div>
          <div>N4</div>
          <div>N5</div>
        </div>
      </div>

      <!-- Navegación por pestañas -->
      <div class="bg-white rounded-xl shadow-lg mb-6">
        <div class="border-b">
          <nav class="flex flex-wrap -mb-px">
            <button onclick="openRewardTab('achievements')" class="tab-button py-4 px-6 text-blue-600 border-b-2 border-blue-600 font-semibold">
              🏆 Logros
            </button>
            <button onclick="openRewardTab('badges')" class="tab-button py-4 px-6 text-gray-500 hover:text-blue-600 font-medium">
              🎖️ Insignias
            </button>
            <button onclick="openRewardTab('leaderboard')" class="tab-button py-4 px-6 text-gray-500 hover:text-blue-600 font-medium">
              📊 Ranking
            </button>
            <button onclick="openRewardTab('shop')" class="tab-button py-4 px-6 text-gray-500 hover:text-blue-600 font-medium">
              🛍️ Tienda
            </button>
          </nav>
        </div>

        <!-- Contenido de las pestañas -->
        <div class="p-6">
          
          <!-- Pestaña: Logros -->
          <div id="achievements" class="tab-content active">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">🏆 Mis Logros</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="achievementsList">
              <!-- Los logros se cargan dinámicamente -->
            </div>
          </div>

          <!-- Pestaña: Insignias -->
          <div id="badges" class="tab-content">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">🎖️ Mis Insignias</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="badgesList">
              <!-- Las insignias se cargan dinámicamente -->
            </div>
          </div>

          <!-- Pestaña: Ranking -->
          <div id="leaderboard" class="tab-content">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">📊 Ranking de Estudiantes</h3>
            
            <div class="bg-white rounded-xl border border-gray-200 p-6">
              <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-semibold">Top 10 Estudiantes</h4>
                <div class="flex items-center space-x-2">
                  <span class="text-sm text-gray-600">Tu posición:</span>
                  <span class="points-badge px-3 py-1 rounded-full text-sm font-semibold" id="userRank">#1</span>
                </div>
              </div>
              
              <div id="leaderboardList" class="space-y-3">
                <!-- El ranking se carga dinámicamente -->
              </div>
            </div>
          </div>

          <!-- Pestaña: Tienda -->
          <div id="shop" class="tab-content">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">🛍️ Tienda de Recompensas</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="shopItems">
              <!-- Los items de la tienda se cargan dinámicamente -->
            </div>
          </div>

        </div>
      </div>

      <!-- Logros Recientes -->
      <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-xl font-bold text-gray-800 mb-4">🎉 Logros Recientes</h3>
        <div id="recentAchievements" class="space-y-3">
          <!-- Los logros recientes se cargan dinámicamente -->
        </div>
      </div>

    </div>
  </main>
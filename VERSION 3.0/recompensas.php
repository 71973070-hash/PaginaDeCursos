<?php 
    include "vistaRecompensas/cabecera.php";
 ?>

<?php 
    include "vistaRecompensas/head.php";
 ?>
 <?php 
    include "vistaRecompensas/main.php";
 ?>
 <?php 
    include "vistaRecompensas/foot.php";
 ?>




  <script src="script.js"></script>
  <script>
    // Base de datos de logros
    const achievements = [
      {
        id: 'first_course',
        name: 'Primeros Pasos',
        description: 'Completaste tu primer curso',
        points: 50,
        icon: '🎯',
        category: 'cursos',
        unlocked: false
      },
      {
        id: 'course_master',
        name: 'Maestro de Cursos',
        description: 'Completa 3 cursos diferentes',
        points: 150,
        icon: '📚',
        category: 'cursos',
        unlocked: false
      },
      {
        id: 'material_explorer',
        name: 'Explorador',
        description: 'Accede a 5 materiales diferentes',
        points: 75,
        icon: '🔍',
        category: 'materiales',
        unlocked: false
      },
      {
        id: 'perfect_score',
        name: 'Perfecto',
        description: 'Obtén 100% en una evaluación',
        points: 100,
        icon: '⭐',
        category: 'evaluaciones',
        unlocked: false
      },
      {
        id: 'speed_learner',
        name: 'Aprendiz Veloz',
        description: 'Completa un curso en menos de 3 días',
        points: 120,
        icon: '⚡',
        category: 'cursos',
        unlocked: false
      },
      {
        id: 'consistent_learner',
        name: 'Aprendiz Consistente',
        description: 'Estudia 5 días seguidos',
        points: 80,
        icon: '📅',
        category: 'consistencia',
        unlocked: false
      },
      {
        id: 'social_learner',
        name: 'Aprendiz Social',
        description: 'Comparte 3 materiales con amigos',
        points: 60,
        icon: '👥',
        category: 'social',
        unlocked: false
      },
      {
        id: 'night_owl',
        name: 'Búho Nocturno',
        description: 'Estudia después de las 10 PM',
        points: 40,
        icon: '🌙',
        category: 'consistencia',
        unlocked: false
      },
      {
        id: 'early_bird',
        name: 'Madrugador',
        description: 'Estudia antes de las 7 AM',
        points: 40,
        icon: '🌅',
        category: 'consistencia',
        unlocked: false
      },
      {
        id: 'marathon_learner',
        name: 'Maratonista',
        description: 'Estudia por más de 2 horas seguidas',
        points: 90,
        icon: '🏃',
        category: 'consistencia',
        unlocked: false
      }
    ];

    // Base de datos de insignias
    const badges = [
      {
        id: 'html_expert',
        name: '🌐 Experto en HTML',
        description: 'Domina los fundamentos de HTML',
        requirement: 'Completar curso de HTML',
        rarity: 'common',
        unlocked: false
      },
      {
        id: 'css_master',
        name: '🎨 Maestro de CSS',
        description: 'Domina el diseño con CSS',
        requirement: 'Completar curso de CSS',
        rarity: 'common',
        unlocked: false
      },
      {
        id: 'js_ninja',
        name: '⚡ Ninja de JavaScript',
        description: 'Domina JavaScript moderno',
        requirement: 'Completar curso de JavaScript',
        rarity: 'rare',
        unlocked: false
      },
      {
        id: 'git_pro',
        name: '📝 Profesional de Git',
        description: 'Control de versiones experto',
        requirement: 'Completar guía de Git',
        rarity: 'common',
        unlocked: false
      },
      {
        id: 'italian_chef',
        name: '👨‍🍳 Chef Italiano',
        description: 'Domina la cocina italiana',
        requirement: 'Completar curso de cocina italiana',
        rarity: 'rare',
        unlocked: false
      },
      {
        id: 'guitar_hero',
        name: '🎸 Héroe de la Guitarra',
        description: 'Toca como un profesional',
        requirement: 'Completar curso de guitarra',
        rarity: 'rare',
        unlocked: false
      },
      {
        id: 'digital_marketer',
        name: '📈 Marketer Digital',
        description: 'Estrategias de marketing online',
        requirement: 'Completar curso de marketing',
        rarity: 'common',
        unlocked: false
      },
      {
        id: 'artist',
        name: '🎨 Artista',
        description: 'Técnicas de pintura profesional',
        requirement: 'Completar curso de pintura',
        rarity: 'epic',
        unlocked: false
      }
    ];

    // Items de la tienda
    const shopItems = [
      {
        id: 'certificate',
        name: '📜 Certificado Digital',
        description: 'Certificado personalizado de finalización',
        cost: 200,
        type: 'digital'
      },
      {
        id: 'profile_badge',
        name: '🌟 Insignia de Perfil Especial',
        description: 'Insignia exclusiva para tu perfil',
        cost: 150,
        type: 'digital'
      },
      {
        id: 'course_discount',
        name: '💸 20% de Descuento',
        description: '20% de descuento en tu próximo curso premium',
        cost: 300,
        type: 'discount'
      },
      {
        id: 'early_access',
        name: '🚀 Acceso Anticipado',
        description: 'Acceso anticipado a nuevos cursos',
        cost: 250,
        type: 'privilege'
      },
      {
        id: 'custom_avatar',
        name: '🖼️ Avatar Personalizado',
        description: 'Avatar animado personalizado',
        cost: 180,
        type: 'customization'
      },
      {
        id: 'study_playlist',
        name: '🎵 Playlist de Estudio',
        description: 'Playlist exclusiva para concentrarse',
        cost: 100,
        type: 'digital'
      }
    ];

    // Función para cargar datos del usuario
    function loadUserData() {
      const userRewards = JSON.parse(localStorage.getItem('userRewards')) || {
        points: 0,
        badges: [],
        achievements: [],
        level: 1
      };

      // Actualizar puntos
      document.getElementById('totalPoints').textContent = userRewards.points;
      document.getElementById('currentPoints').textContent = userRewards.points;

      // Calcular nivel
      const level = Math.floor(userRewards.points / 500) + 1;
      const nextLevelPoints = (level * 500) - userRewards.points;
      const progressPercent = (userRewards.points % 500) / 5;

      document.getElementById('userLevel').textContent = level;
      document.getElementById('currentLevel').textContent = level;
      document.getElementById('nextLevel').textContent = nextLevelPoints;
      document.getElementById('nextLevelPoints').textContent = nextLevelPoints;
      document.getElementById('nextLevelNumber').textContent = level + 1;

      // Actualizar barra de progreso
      document.getElementById('levelProgressBar').style.width = `${progressPercent}%`;

      // Actualizar estadísticas
      document.getElementById('totalAchievements').textContent = userRewards.achievements?.length || 0;
      document.getElementById('totalBadges').textContent = userRewards.badges?.length || 0;

      return userRewards;
    }

    // Función para cargar logros
    function loadAchievements() {
      const container = document.getElementById('achievementsList');
      const userRewards = JSON.parse(localStorage.getItem('userRewards')) || { achievements: [] };

      // Verificar logros desbloqueados
      const achievementsWithStatus = achievements.map(achievement => ({
        ...achievement,
        unlocked: userRewards.achievements?.includes(achievement.name) || false
      }));

      container.innerHTML = achievementsWithStatus.map(achievement => `
        <div class="reward-card rounded-xl p-6 border-2 ${achievement.unlocked ? 'unlocked' : 'locked border-gray-200'}">
          <div class="flex items-start justify-between mb-4">
            <div class="text-4xl">${achievement.icon}</div>
            <div class="points-badge px-3 py-1 rounded-full text-sm font-semibold">
              +${achievement.points}
            </div>
          </div>
          
          <h4 class="font-bold text-lg mb-2 ${achievement.unlocked ? 'text-green-700' : 'text-gray-700'}">
            ${achievement.name}
          </h4>
          
          <p class="text-sm text-gray-600 mb-4">${achievement.description}</p>
          
          <div class="flex items-center justify-between">
            <span class="text-xs px-2 py-1 bg-gray-100 rounded ${achievement.unlocked ? 'text-green-600 bg-green-50' : 'text-gray-500'}">
              ${achievement.unlocked ? '✅ Desbloqueado' : '🔒 Por desbloquear'}
            </span>
            <span class="text-xs text-gray-500">${achievement.category}</span>
          </div>
        </div>
      `).join('');
    }

    // Función para cargar insignias
    function loadBadges() {
      const container = document.getElementById('badgesList');
      const userRewards = JSON.parse(localStorage.getItem('userRewards')) || { badges: [] };

      const badgesWithStatus = badges.map(badge => ({
        ...badge,
        unlocked: userRewards.badges?.includes(badge.name) || false
      }));

      container.innerHTML = badgesWithStatus.map(badge => {
        const rarityColors = {
          'common': 'border-gray-300 bg-gray-50',
          'rare': 'border-blue-300 bg-blue-50',
          'epic': 'border-purple-300 bg-purple-50'
        };

        return `
          <div class="reward-card rounded-xl p-4 text-center border-2 ${badge.unlocked ? 'unlocked' : `${rarityColors[badge.rarity]} locked`}">
            <div class="text-4xl mb-3">${badge.name.split(' ')[0]}</div>
            
            <h4 class="font-bold text-sm mb-2 ${badge.unlocked ? 'text-green-700' : 'text-gray-700'}">
              ${badge.name.split(' ').slice(1).join(' ')}
            </h4>
            
            <p class="text-xs text-gray-600 mb-3">${badge.description}</p>
            
            <div class="text-xs px-2 py-1 rounded ${badge.unlocked ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'}">
              ${badge.unlocked ? '✅ Obtenida' : badge.requirement}
            </div>
          </div>
        `;
      }).join('');
    }

    // Función para cargar ranking
    function loadLeaderboard() {
      const container = document.getElementById('leaderboardList');
      const userRewards = JSON.parse(localStorage.getItem('userRewards')) || { points: 0 };
      
      // Simular datos de ranking (en una app real vendrían del backend)
      const leaderboard = [
        { name: 'Ana García', points: 1250, level: 3 },
        { name: 'Carlos López', points: 980, level: 2 },
        { name: 'María Rodríguez', points: 870, level: 2 },
        { name: 'Tu Usuario', points: userRewards.points, level: Math.floor(userRewards.points / 500) + 1, isCurrentUser: true },
        { name: 'Pedro Martínez', points: 650, level: 2 },
        { name: 'Laura Hernández', points: 520, level: 2 },
        { name: 'Javier Díaz', points: 480, level: 1 },
        { name: 'Sofía Castro', points: 350, level: 1 },
        { name: 'Diego Ruiz', points: 280, level: 1 },
        { name: 'Elena Morales', points: 150, level: 1 }
      ].sort((a, b) => b.points - a.points);

      // Encontrar posición del usuario
      const userPosition = leaderboard.findIndex(user => user.isCurrentUser) + 1;
      document.getElementById('userRank').textContent = `#${userPosition}`;

      container.innerHTML = leaderboard.map((user, index) => `
        <div class="flex items-center justify-between p-3 rounded-lg ${user.isCurrentUser ? 'bg-blue-50 border border-blue-200' : 'bg-gray-50'}">
          <div class="flex items-center space-x-3">
            <div class="flex items-center justify-center w-8 h-8 rounded-full ${
              index === 0 ? 'bg-yellow-500 text-white' :
              index === 1 ? 'bg-gray-400 text-white' :
              index === 2 ? 'bg-orange-500 text-white' :
              'bg-gray-200 text-gray-600'
            } font-bold text-sm">
              ${index + 1}
            </div>
            <div>
              <div class="font-medium ${user.isCurrentUser ? 'text-blue-700' : 'text-gray-700'}">
                ${user.name} ${user.isCurrentUser ? '(Tú)' : ''}
              </div>
              <div class="text-xs text-gray-500">Nivel ${user.level}</div>
            </div>
          </div>
          <div class="text-right">
            <div class="font-bold text-gray-800">${user.points} pts</div>
            <div class="text-xs text-gray-500">${Math.floor(user.points / 500) + 1}° nivel</div>
          </div>
        </div>
      `).join('');
    }

    // Función para cargar tienda
    function loadShop() {
      const container = document.getElementById('shopItems');
      const userRewards = JSON.parse(localStorage.getItem('userRewards')) || { points: 0 };

      container.innerHTML = shopItems.map(item => {
        const canAfford = userRewards.points >= item.cost;
        
        return `
          <div class="reward-card rounded-xl p-6 border-2 border-gray-200">
            <div class="text-4xl mb-4">${item.name.split(' ')[0]}</div>
            
            <h4 class="font-bold text-lg mb-2 text-gray-800">
              ${item.name.split(' ').slice(1).join(' ')}
            </h4>
            
            <p class="text-sm text-gray-600 mb-4">${item.description}</p>
            
            <div class="flex items-center justify-between">
              <span class="points-badge px-3 py-1 rounded-full text-sm font-semibold">
                ${item.cost} puntos
              </span>
              
              <button onclick="buyItem('${item.id}', ${item.cost}, '${item.name}')" 
                      class="px-4 py-2 rounded font-semibold text-sm ${
                        canAfford ? 
                        'bg-green-500 hover:bg-green-600 text-white' : 
                        'bg-gray-300 text-gray-500 cursor-not-allowed'
                      } transition"
                      ${!canAfford ? 'disabled' : ''}>
                ${canAfford ? '🛒 Comprar' : '💸 Insuficiente'}
              </button>
            </div>
          </div>
        `;
      }).join('');
    }

    // Función para comprar items
    function buyItem(itemId, cost, itemName) {
      const userRewards = JSON.parse(localStorage.getItem('userRewards')) || { points: 0 };
      
      if (userRewards.points >= cost) {
        userRewards.points -= cost;
        localStorage.setItem('userRewards', JSON.stringify(userRewards));
        
        // Guardar compras realizadas
        const purchases = JSON.parse(localStorage.getItem('userPurchases')) || [];
        purchases.push({
          item: itemName,
          cost: cost,
          date: new Date().toISOString()
        });
        localStorage.setItem('userPurchases', JSON.stringify(purchases));
        
        showNotification(`✅ ¡Compra exitosa! Canjeaste ${itemName}`, 'success');
        loadUserData();
        loadShop();
      } else {
        showNotification('❌ No tienes puntos suficientes para esta compra', 'error');
      }
    }

    // Función para cargar logros recientes
    function loadRecentAchievements() {
      const container = document.getElementById('recentAchievements');
      const achievementsHistory = JSON.parse(localStorage.getItem('achievementsHistory')) || [];
      
      if (achievementsHistory.length === 0) {
        container.innerHTML = '<p class="text-gray-500 text-center">Aún no has desbloqueado logros.</p>';
        return;
      }

      container.innerHTML = achievementsHistory.slice(-3).reverse().map(achievement => `
        <div class="flex items-center space-x-4 bg-green-50 p-4 rounded-lg border border-green-200">
          <div class="text-2xl">${achievement.icon}</div>
          <div class="flex-1">
            <div class="font-semibold text-green-800">${achievement.name}</div>
            <div class="text-sm text-green-600">+${achievement.points} puntos</div>
          </div>
          <div class="text-xs text-green-500">
            ${new Date(achievement.date).toLocaleDateString()}
          </div>
        </div>
      `).join('');
    }

    // Función para cambiar pestañas
    function openRewardTab(tabName) {
      // Ocultar todas las pestañas
      document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
      });
      
      // Mostrar la pestaña seleccionada
      document.getElementById(tabName).classList.add('active');
      
      // Actualizar botones activos
      document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
        button.classList.add('text-gray-500', 'hover:text-blue-600');
      });
      
      event.target.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
      event.target.classList.remove('text-gray-500', 'hover:text-blue-600');
    }

    // Función para mostrar notificaciones
    function showNotification(message, type = 'info') {
      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
      }`;
      notification.innerHTML = `
        <div class="font-bold">${message}</div>
      `;

      document.body.appendChild(notification);

      setTimeout(() => {
        notification.remove();
      }, 4000);
    }

    // Cargar todo al iniciar
    document.addEventListener('DOMContentLoaded', function() {
      loadUserData();
      loadAchievements();
      loadBadges();
      loadLeaderboard();
      loadShop();
      loadRecentAchievements();
      
      // Verificar autenticación
      const usuario = localStorage.getItem('usuario');
      if (!usuario) {
        alert('Debes iniciar sesión para ver las recompensas.');
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
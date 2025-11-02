// perfil.js - Funcionalidades para la gestión del perfil

class ProfileManager {
    constructor() {
        this.userData = JSON.parse(localStorage.getItem('userProfile')) || {};
        this.init();
    }

    init() {
        this.loadUserData();
        this.loadStatistics();
        this.loadAchievements();
        this.loadPreferences();
    }

    loadUserData() {
        const nombre = localStorage.getItem('nombre') || 'Usuario';
        const correo = localStorage.getItem('usuario') || 'usuario@ejemplo.com';
        
        // Actualizar elementos del DOM
        document.getElementById('userName').textContent = nombre;
        document.getElementById('userEmail').textContent = correo;
        document.getElementById('editName').value = nombre;
        document.getElementById('editEmail').value = correo;

        // Cargar datos adicionales del perfil
        if (this.userData.phone) {
            document.getElementById('editPhone').value = this.userData.phone;
        }
        if (this.userData.country) {
            document.getElementById('editCountry').value = this.userData.country;
        }
        if (this.userData.bio) {
            document.getElementById('editBio').value = this.userData.bio;
        }
        if (this.userData.avatar) {
            document.getElementById('userAvatar').src = this.userData.avatar;
        }

        // Calcular nivel y puntos
        this.calculateLevelAndPoints();
    }

    calculateLevelAndPoints() {
        const userRewards = JSON.parse(localStorage.getItem('userRewards')) || { points: 0 };
        const courseProgress = JSON.parse(localStorage.getItem('courseProgress')) || {};
        const cursosInscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];

        const puntos = userRewards.points || 0;
        const nivel = Math.floor(puntos / 500) + 1;
        const cursosCompletados = Object.values(courseProgress).filter(progress => progress.completed).length;

        document.getElementById('userPoints').textContent = puntos;
        document.getElementById('userLevel').textContent = `Nivel ${nivel}`;
        document.getElementById('userCourses').textContent = cursosInscritos.length;
    }

    loadStatistics() {
        const cursosInscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
        const courseProgress = JSON.parse(localStorage.getItem('courseProgress')) || {};
        const userStats = JSON.parse(localStorage.getItem('userStats')) || { totalStudyTime: 0 };

        const cursosCompletados = Object.values(courseProgress).filter(progress => progress.completed).length;
        const totalHoras = Math.floor(userStats.totalStudyTime / 60);
        const tasaExito = cursosInscritos.length > 0 ? Math.round((cursosCompletados / cursosInscritos.length) * 100) : 0;

        document.getElementById('totalCourses').textContent = cursosInscritos.length;
        document.getElementById('completedCourses').textContent = cursosCompletados;
        document.getElementById('totalHours').textContent = `${totalHoras}h`;
        document.getElementById('successRate').textContent = `${tasaExito}%`;

        // Cargar progreso de cursos
        this.loadCoursesProgress(cursosInscritos, courseProgress);
        
        // Cargar actividad reciente
        this.loadRecentActivity();
    }

    loadCoursesProgress(cursosInscritos, courseProgress) {
        const container = document.getElementById('coursesProgressList');
        
        if (cursosInscritos.length === 0) {
            container.innerHTML = '<p class="text-gray-500 text-center">No estás inscrito en ningún curso.</p>';
            return;
        }

        container.innerHTML = cursosInscritos.map(curso => {
            const progress = courseProgress[curso];
            const progressPercent = progress ? (progress.modulesCompleted.length / 5) * 100 : 0;
            
            return `
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h5 class="font-semibold text-gray-800">${curso}</h5>
                        <span class="text-sm font-bold ${progressPercent === 100 ? 'text-green-600' : 'text-blue-600'}">
                            ${Math.round(progressPercent)}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full transition-all duration-1000" 
                             style="width: ${progressPercent}%"></div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        ${progress ? `${progress.modulesCompleted.length}/5 módulos` : 'Recién inscrito'}
                        ${progress && progress.completed ? '✅ Completado' : ''}
                    </div>
                </div>
            `;
        }).join('');
    }

    loadRecentActivity() {
        const container = document.getElementById('recentActivity');
        const activities = JSON.parse(localStorage.getItem('userActivities')) || [];
        
        if (activities.length === 0) {
            container.innerHTML = '<p class="text-gray-500 text-center">No hay actividad reciente.</p>';
            return;
        }

        container.innerHTML = activities.slice(-5).reverse().map(activity => `
            <div class="flex items-center space-x-3 bg-white p-3 rounded-lg border">
                <span class="text-2xl">${activity.emoji || '📚'}</span>
                <div class="flex-1">
                    <p class="text-sm font-medium">${activity.message}</p>
                    <p class="text-xs text-gray-500">${new Date(activity.timestamp).toLocaleDateString()}</p>
                </div>
            </div>
        `).join('');
    }

    loadAchievements() {
        const container = document.getElementById('achievementsList');
        const userRewards = JSON.parse(localStorage.getItem('userRewards')) || { badges: [], achievements: [] };
        
        const allAchievements = [
            { id: 'first_course', name: 'Primeros Pasos', description: 'Completaste tu primer curso', emoji: '🎯' },
            { id: 'points_100', name: 'Acumulador 100', description: 'Alcanzaste 100 puntos', emoji: '⭐' },
            { id: 'points_500', name: 'Acumulador 500', description: 'Alcanzaste 500 puntos', emoji: '🌟' },
            { id: 'material_explorer', name: 'Explorador', description: 'Accediste a 3 materiales', emoji: '📚' },
            { id: 'perfect_score', name: 'Perfecto', description: 'Obtuviste 100% en una evaluación', emoji: '🏆' }
        ];

        container.innerHTML = allAchievements.map(achievement => {
            const tieneLogro = userRewards.achievements?.includes(achievement.name) || 
                              userRewards.badges?.some(badge => badge.includes(achievement.name));
            
            return `
                <div class="bg-white border rounded-lg p-6 text-center ${tieneLogro ? 'border-green-500 bg-green-50' : 'border-gray-200 opacity-60'}">
                    <div class="text-4xl mb-3">${achievement.emoji}</div>
                    <h4 class="font-semibold mb-2 ${tieneLogro ? 'text-green-700' : 'text-gray-600'}">${achievement.name}</h4>
                    <p class="text-sm ${tieneLogro ? 'text-green-600' : 'text-gray-500'}">${achievement.description}</p>
                    ${tieneLogro ? '<div class="mt-3 text-green-600 font-semibold">✅ Desbloqueado</div>' : ''}
                </div>
            `;
        }).join('');
    }

    loadPreferences() {
        const preferences = JSON.parse(localStorage.getItem('userPreferences')) || {};
        
        // Notificaciones
        document.getElementById('notifCourses').checked = preferences.notifCourses !== false;
        document.getElementById('notifProgress').checked = preferences.notifProgress !== false;
        document.getElementById('notifAchievements').checked = preferences.notifAchievements !== false;
        document.getElementById('notifEmail').checked = preferences.notifEmail || false;
        
        // Privacidad
        document.getElementById('privacyProfile').checked = preferences.privacyProfile !== false;
        document.getElementById('privacyProgress').checked = preferences.privacyProgress || false;
        document.getElementById('privacyAchievements').checked = preferences.privacyAchievements !== false;
        
        // Tema
        const savedTheme = preferences.theme || 'light';
        this.applyTheme(savedTheme);
    }

    updateProfile(event) {
        event.preventDefault();
        
        const userProfile = {
            name: document.getElementById('editName').value,
            email: document.getElementById('editEmail').value,
            phone: document.getElementById('editPhone').value,
            country: document.getElementById('editCountry').value,
            bio: document.getElementById('editBio').value,
            avatar: this.userData.avatar,
            updatedAt: new Date().toISOString()
        };

        // Actualizar localStorage
        localStorage.setItem('userProfile', JSON.stringify(userProfile));
        localStorage.setItem('nombre', userProfile.name);
        localStorage.setItem('usuario', userProfile.email);

        // Actualizar datos en memoria
        this.userData = userProfile;

        // Recargar datos
        this.loadUserData();
        
        // Mostrar mensaje de éxito
        this.showNotification('Perfil actualizado correctamente', 'success');
        
        // Volver a la pestaña de estadísticas
        openTab('stats');
    }

    changePassword(event) {
        event.preventDefault();
        
        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        // Validaciones
        if (newPassword !== confirmPassword) {
            this.showNotification('Las contraseñas no coinciden', 'error');
            return;
        }

        if (newPassword.length < 6) {
            this.showNotification('La contraseña debe tener al menos 6 caracteres', 'error');
            return;
        }

        // Verificar contraseña actual
        const usuarios = JSON.parse(localStorage.getItem('usuarios')) || {};
        const currentEmail = localStorage.getItem('usuario');
        
        if (usuarios[currentEmail] && usuarios[currentEmail].password !== currentPassword) {
            this.showNotification('La contraseña actual es incorrecta', 'error');
            return;
        }

        // Actualizar contraseña
        usuarios[currentEmail].password = newPassword;
        localStorage.setItem('usuarios', JSON.stringify(usuarios));

        // Limpiar formulario
        event.target.reset();

        this.showNotification('Contraseña actualizada correctamente', 'success');
        
        // Registrar actividad
        this.addActivity('🔐 Contraseña cambiada');
    }

    addActivity(message, emoji = '📚') {
        const activities = JSON.parse(localStorage.getItem('userActivities')) || [];
        activities.push({
            message,
            emoji,
            timestamp: new Date().toISOString()
        });
        localStorage.setItem('userActivities', JSON.stringify(activities));
        this.loadRecentActivity();
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.innerHTML = `
            <div class="font-bold">${type === 'success' ? '✅' : '❌'} ${message}</div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 4000);
    }

    applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('userTheme', theme);
    }
}

// Funciones globales
function openTab(tabName) {
    // Ocultar todas las pestañas
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Mostrar la pestaña seleccionada
    document.getElementById(tabName).classList.add('active');
    
    // Actualizar botones activos
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('text-blue-600', 'border-blue-600');
        button.classList.add('text-gray-500', 'hover:text-blue-600');
    });
    
    event.target.classList.add('text-blue-600', 'border-blue-600');
    event.target.classList.remove('text-gray-500', 'hover:text-blue-600');
}

function changeAvatar(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('userAvatar').src = e.target.result;
            
            // Guardar en localStorage
            const userProfile = JSON.parse(localStorage.getItem('userProfile')) || {};
            userProfile.avatar = e.target.result;
            localStorage.setItem('userProfile', JSON.stringify(userProfile));
            
            profileManager.showNotification('Avatar actualizado correctamente', 'success');
            profileManager.addActivity('🖼️ Avatar actualizado');
        };
        reader.readAsDataURL(file);
    }
}

function exportUserData() {
    const userData = {
        profile: JSON.parse(localStorage.getItem('userProfile')) || {},
        courses: JSON.parse(localStorage.getItem('cursosInscritos')) || [],
        progress: JSON.parse(localStorage.getItem('courseProgress')) || {},
        rewards: JSON.parse(localStorage.getItem('userRewards')) || {},
        activities: JSON.parse(localStorage.getItem('userActivities')) || [],
        exportDate: new Date().toISOString()
    };

    const dataStr = JSON.stringify(userData, null, 2);
    const dataBlob = new Blob([dataStr], { type: 'application/json' });
    
    const link = document.createElement('a');
    link.href = URL.createObjectURL(dataBlob);
    link.download = `datos-usuario-${new Date().toISOString().split('T')[0]}.json`;
    link.click();
    
    profileManager.showNotification('Datos exportados correctamente', 'success');
    profileManager.addActivity('📥 Datos exportados');
}

function setTheme(theme) {
    profileManager.applyTheme(theme);
    profileManager.showNotification(`Tema cambiado a ${theme}`, 'success');
}

function saveNotificationSettings() {
    const preferences = JSON.parse(localStorage.getItem('userPreferences')) || {};
    
    preferences.notifCourses = document.getElementById('notifCourses').checked;
    preferences.notifProgress = document.getElementById('notifProgress').checked;
    preferences.notifAchievements = document.getElementById('notifAchievements').checked;
    preferences.notifEmail = document.getElementById('notifEmail').checked;
    
    localStorage.setItem('userPreferences', JSON.stringify(preferences));
    profileManager.showNotification('Preferencias guardadas', 'success');
}

function showDeleteAccountModal() {
    document.getElementById('deleteAccountModal').classList.remove('hidden');
}

function hideDeleteAccountModal() {
    document.getElementById('deleteAccountModal').classList.add('hidden');
}

function deleteAccount() {
    // Eliminar todos los datos del usuario
    localStorage.removeItem('usuario');
    localStorage.removeItem('nombre');
    localStorage.removeItem('cursosInscritos');
    localStorage.removeItem('courseProgress');
    localStorage.removeItem('userRewards');
    localStorage.removeItem('userProfile');
    localStorage.removeItem('userActivities');
    localStorage.removeItem('userPreferences');
    
    // También eliminar de la lista de usuarios
    const usuarios = JSON.parse(localStorage.getItem('usuarios')) || {};
    const currentEmail = localStorage.getItem('usuario');
    delete usuarios[currentEmail];
    localStorage.setItem('usuarios', JSON.stringify(usuarios));
    
    hideDeleteAccountModal();
    alert('Tu cuenta ha sido eliminada. Serás redirigido al login.');
    window.location.href = 'login.php';
}

function logoutAllSessions() {
    // Aquí simularíamos cerrar sesiones en otros dispositivos
    profileManager.showNotification('Todas las sesiones han sido cerradas', 'success');
    profileManager.addActivity('🚪 Sesiones cerradas en todos los dispositivos');
}

// Inicializar cuando se carga la página
let profileManager;
document.addEventListener('DOMContentLoaded', function() {
    profileManager = new ProfileManager();
    
    // Verificar autenticación
    const usuario = localStorage.getItem('usuario');
    if (!usuario) {
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
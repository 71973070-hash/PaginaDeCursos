// script.js - Funcionalidades avanzadas para la plataforma de cursos

// =============================================
// 0. LIMPIAR DATOS CORRUPTOS AL INICIAR
// =============================================

function cleanCorruptedData() {
    const cursosInscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
    
    // SOLUCIÓN: Filtrar y eliminar números 3, 4 y datos corruptos
    const cursosFiltrados = cursosInscritos.filter(curso => {
        if (typeof curso !== 'string') return false;
        if (curso === '3' || curso === '4') return false;
        if (!isNaN(parseInt(curso))) return false;
        return curso.trim() !== '';
    });
    
    if (cursosFiltrados.length !== cursosInscritos.length) {
        localStorage.setItem('cursosInscritos', JSON.stringify(cursosFiltrados));
        console.log('Datos corruptos limpiados:', cursosInscritos.filter(c => !cursosFiltrados.includes(c)));
    }

    // También limpiar courseProgress
    const courseProgress = JSON.parse(localStorage.getItem('courseProgress')) || {};
    const progressFiltrado = {};
    
    Object.keys(courseProgress).forEach(key => {
        if (key !== '3' && key !== '4' && isNaN(parseInt(key))) {
            progressFiltrado[key] = courseProgress[key];
        }
    });
    
    localStorage.setItem('courseProgress', JSON.stringify(progressFiltrado));
    
    return cursosFiltrados;
}

// Ejecutar limpieza inmediatamente
cleanCorruptedData();

// =============================================
// 1. SISTEMA DE PROGRESO Y ESTADÍSTICAS
// =============================================

class ProgressManager {
    constructor() {
        this.courseProgress = JSON.parse(localStorage.getItem('courseProgress')) || {};
        this.userStats = JSON.parse(localStorage.getItem('userStats')) || {
            totalCourses: 0,
            completedCourses: 0,
            totalStudyTime: 0,
            lastActivity: null
        };
    }

    // Registrar progreso en un curso
    updateCourseProgress(courseName, moduleCompleted, timeSpent = 0) {
        if (!this.courseProgress[courseName]) {
            this.courseProgress[courseName] = {
                modulesCompleted: [],
                totalTime: 0,
                startDate: new Date().toISOString(),
                completed: false
            };
        }

        if (!this.courseProgress[courseName].modulesCompleted.includes(moduleCompleted)) {
            this.courseProgress[courseName].modulesCompleted.push(moduleCompleted);
            this.courseProgress[courseName].totalTime += timeSpent;
            this.userStats.totalStudyTime += timeSpent;
            this.userStats.lastActivity = new Date().toISOString();

            // Actualizar estadísticas de cursos
            this.userStats.totalCourses = Object.keys(this.courseProgress).length;
            
            // Verificar si el curso está completo (5 módulos)
            if (this.courseProgress[courseName].modulesCompleted.length >= 5) {
                this.courseProgress[courseName].completed = true;
                this.userStats.completedCourses = Object.values(this.courseProgress).filter(progress => progress.completed).length;
                this.awardCourseCompletion(courseName);
            }

            this.saveProgress();
            this.updateDashboardStats();
        }
    }

    awardCourseCompletion(courseName) {
        // Sistema de recompensas por completar curso
        const rewards = {
            'Curso de HTML y CSS': { points: 100, badge: '🌐 Maquetador Web' },
            'JavaScript desde Cero': { points: 150, badge: '⚡ Desarrollador JS' },
            'Cocina Italiana Básica': { points: 120, badge: '👨‍🍳 Chef Italiano' },
            'Guitarra para Principiantes': { points: 110, badge: '🎸 Guitarrista' },
            'Pintura al Óleo': { points: 130, badge: '🎨 Artista' },
            'Marketing Digital': { points: 90, badge: '📈 Marketer Digital' }
        };

        const reward = rewards[courseName];
        if (reward && window.RewardSystem) {
            RewardSystem.awardPoints(reward.points, `Completaste ${courseName}`);
            RewardSystem.unlockBadge(reward.badge, `Por completar ${courseName}`);
        }
    }

    updateDashboardStats() {
        // Actualizar estadísticas en el dashboard si existe
        const statsElement = document.getElementById('progressStats');
        if (statsElement) {
            const cursosInscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
            const completedCourses = Object.values(this.courseProgress).filter(progress => progress.completed).length;
            
            statsElement.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-100 p-4 rounded text-center">
                        <div class="text-2xl font-bold text-blue-700">${cursosInscritos.length}</div>
                        <div class="text-sm">Cursos Inscritos</div>
                    </div>
                    <div class="bg-green-100 p-4 rounded text-center">
                        <div class="text-2xl font-bold text-green-700">${completedCourses}</div>
                        <div class="text-sm">Completados</div>
                    </div>
                    <div class="bg-purple-100 p-4 rounded text-center">
                        <div class="text-2xl font-bold text-purple-700">${Math.floor(this.userStats.totalStudyTime / 60)}h</div>
                        <div class="text-sm">Horas Estudiadas</div>
                    </div>
                </div>
            `;
        }
    }

    saveProgress() {
        localStorage.setItem('courseProgress', JSON.stringify(this.courseProgress));
        localStorage.setItem('userStats', JSON.stringify(this.userStats));
    }
}

// =============================================
// 2. SISTEMA DE RECOMPENSAS MEJORADO
// =============================================

class RewardSystem {
    static awardPoints(points, reason) {
        let userRewards = JSON.parse(localStorage.getItem('userRewards')) || {
            points: 0,
            badges: [],
            achievements: []
        };

        userRewards.points += points;
        localStorage.setItem('userRewards', JSON.stringify(userRewards));

        // Mostrar notificación
        this.showNotification(`+${points} puntos`, reason, 'points');
        
        // Verificar logros por puntos
        this.checkPointAchievements(userRewards.points);
    }

    static unlockBadge(badgeName, description) {
        let userRewards = JSON.parse(localStorage.getItem('userRewards')) || {
            points: 0,
            badges: [],
            achievements: []
        };

        if (!userRewards.badges.includes(badgeName)) {
            userRewards.badges.push(badgeName);
            localStorage.setItem('userRewards', JSON.stringify(userRewards));
            
            this.showNotification('🎉 Nuevo Logro', badgeName, 'badge');
            this.updateRewardsDisplay();
        }
    }

    static checkPointAchievements(totalPoints) {
        const milestones = [100, 500, 1000, 2000, 5000];
        milestones.forEach(points => {
            if (totalPoints >= points) {
                this.unlockAchievement(`Puntos ${points}`, `Acumulaste ${points} puntos`);
            }
        });
    }

    static unlockAchievement(achievement, description) {
        let userRewards = JSON.parse(localStorage.getItem('userRewards')) || {
            points: 0,
            badges: [],
            achievements: []
        };

        if (!userRewards.achievements.includes(achievement)) {
            userRewards.achievements.push(achievement);
            localStorage.setItem('userRewards', JSON.stringify(userRewards));
            
            this.showNotification('🏆 Logro Desbloqueado', achievement, 'achievement');
            this.updateRewardsDisplay();
        }
    }

    static showNotification(title, message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 transform translate-x-full transition-transform duration-300 ${
            type === 'points' ? 'bg-green-500' :
            type === 'badge' ? 'bg-blue-500' :
            type === 'achievement' ? 'bg-yellow-500' : 'bg-gray-500'
        }`;
        
        notification.innerHTML = `
            <div class="font-bold">${title}</div>
            <div class="text-sm">${message}</div>
        `;

        document.body.appendChild(notification);

        // Animación de entrada
        setTimeout(() => notification.classList.remove('translate-x-full'), 100);
        
        // Auto-eliminar después de 4 segundos
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 4000);
    }

    static updateRewardsDisplay() {
        // Actualizar página de recompensas si estamos en ella
        if (window.location.pathname.includes('recompensas.html')) {
            const rewardsContainer = document.querySelector('.grid');
            if (rewardsContainer) {
                const userRewards = JSON.parse(localStorage.getItem('userRewards')) || {
                    points: 0,
                    badges: [],
                    achievements: []
                };

                let rewardsHTML = `
                    <div class="col-span-full mb-6">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-6 rounded-lg text-center">
                            <div class="text-4xl font-bold">${userRewards.points}</div>
                            <div class="text-lg">Puntos Totales</div>
                        </div>
                    </div>
                `;

                // Mostrar badges
                userRewards.badges.forEach(badge => {
                    rewardsHTML += `
                        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
                            <h3 class="text-lg font-bold text-green-700">${badge}</h3>
                            <p class="text-gray-600 text-sm mt-2">Logro desbloqueado por tu progreso en los cursos.</p>
                        </div>
                    `;
                });

                // Mostrar logros
                userRewards.achievements.forEach(achievement => {
                    rewardsHTML += `
                        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-500">
                            <h3 class="text-lg font-bold text-yellow-700">🏆 ${achievement}</h3>
                            <p class="text-gray-600 text-sm mt-2">¡Sigue así para desbloquear más logros!</p>
                        </div>
                    `;
                });

                rewardsContainer.innerHTML = rewardsHTML;
            }
        }
    }
}

// =============================================
// 3. SISTEMA DE EVALUACIONES
// =============================================

class EvaluationSystem {
    static startEvaluation(courseId) {
        const cursos = JSON.parse(localStorage.getItem('cursosData')) || [];
        const curso = cursos.find(c => c.id === courseId);
        
        if (curso && curso.preguntas && curso.preguntas.length > 0) {
            localStorage.setItem('currentEvaluation', JSON.stringify({
                course: curso.nombre,
                questions: curso.preguntas,
                currentQuestion: 0,
                correctAnswers: 0
            }));
            
            window.location.href = 'evaluacion.html';
        } else {
            this.showModal('Evaluación No Disponible', 'Este curso no tiene evaluación disponible aún.', 'info');
        }
    }

    static finishEvaluation() {
        const evaluation = JSON.parse(localStorage.getItem('currentEvaluation'));
        if (!evaluation) return;

        const totalQuestions = evaluation.questions.length;
        const score = (evaluation.correctAnswers / totalQuestions) * 100;
        const passed = score >= 70;

        // Registrar progreso si aprobó
        if (passed && window.progressManager) {
            window.progressManager.updateCourseProgress(
                evaluation.course,
                `Evaluación completada - ${score.toFixed(1)}%`,
                45
            );
            
            // Otorgar recompensa
            if (window.RewardSystem) {
                const points = Math.floor(score / 10) * 5;
                window.RewardSystem.awardPoints(points, `Evaluación: ${evaluation.course}`);
                
                if (score === 100) {
                    window.RewardSystem.unlockBadge('🎯 Perfect Score', 'Obtuviste 100% en una evaluación');
                }
            }
        }

        localStorage.removeItem('currentEvaluation');
        return { passed, score, correct: evaluation.correctAnswers, total: totalQuestions };
    }

    static showModal(title, message, type = 'info') {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        modal.innerHTML = `
            <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
                <div class="text-center">
                    <div class="text-3xl mb-3 ${
                        type === 'success' ? 'text-green-500' :
                        type === 'error' ? 'text-red-500' : 'text-blue-500'
                    }">
                        ${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}
                    </div>
                    <h3 class="text-xl font-bold mb-2">${title}</h3>
                    <p class="text-gray-600 mb-4">${message}</p>
                    <button onclick="this.closest('.fixed').remove()" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Aceptar
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }
}

// =============================================
// 4. INICIALIZACIÓN
// =============================================

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar sistemas
    window.progressManager = new ProgressManager();
    window.RewardSystem = RewardSystem;
    window.EvaluationSystem = EvaluationSystem;
});

// Función global para cerrar sesión
function logout() {
    if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
        localStorage.removeItem('usuario');
        localStorage.removeItem('nombre');
        window.location.href = 'login.html';
    }
}

// =============================================
// 5. SOLUCIÓN DEFINITIVA PARA DATOS CORRUPTOS
// =============================================

function forceCleanAllData() {
    // Limpiar completamente datos corruptos
    const cursosInscritos = JSON.parse(localStorage.getItem('cursosInscritos')) || [];
    const cursosFiltrados = cursosInscritos.filter(curso => {
        return typeof curso === 'string' && 
               curso !== '3' && 
               curso !== '4' && 
               isNaN(parseInt(curso)) &&
               curso.trim() !== '';
    });
    
    localStorage.setItem('cursosInscritos', JSON.stringify(cursosFiltrados));
    
    // Limpiar courseProgress
    const courseProgress = JSON.parse(localStorage.getItem('courseProgress')) || {};
    const progressFiltrado = {};
    
    Object.keys(courseProgress).forEach(key => {
        if (key !== '3' && key !== '4' && isNaN(parseInt(key))) {
            progressFiltrado[key] = courseProgress[key];
        }
    });
    
    localStorage.setItem('courseProgress', JSON.stringify(progressFiltrado));
    
    console.log('Limpieza completa ejecutada');
    return true;
}

// Ejecutar limpieza forzada en todas las páginas
forceCleanAllData();



// =============================================
// 6. NAVEGACIÓN ACTIVA AUTOMÁTICA
// =============================================

function setActiveNavigation() {
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('nav a');
    
    navLinks.forEach(link => {
        // Remover clases activas
        link.classList.remove('font-semibold', 'border-b-2', 'border-white');
        link.classList.add('hover:underline');
        
        // Verificar si este enlace corresponde a la página actual
        const linkHref = link.getAttribute('href');
        if (linkHref === currentPage) {
            link.classList.add('font-semibold', 'border-b-2', 'border-white');
            link.classList.remove('hover:underline');
        }
    });
}

// Ejecutar cuando se carga cada página
document.addEventListener('DOMContentLoaded', function() {
    setActiveNavigation();
});
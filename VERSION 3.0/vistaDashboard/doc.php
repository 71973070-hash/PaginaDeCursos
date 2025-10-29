<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Sistema de Cursos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css" />
  <style>
    body::before {
      content: "";
      background-image: url('img/fondo.jpg');
      background-size: cover;
      background-position: center;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      z-index: -1;
      opacity: 0.4;
    }
  </style>
</head>
<body class="relative bg-gray-50 text-gray-800 min-h-screen flex flex-col">

  <!-- Encabezado -->
  <!-- En dashboard.html, reemplaza el header completo con este: -->
<header class="bg-blue-700 text-white p-4 shadow-lg">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-2xl font-bold">Sistema de Cursos</h1>
    <nav class="flex items-center space-x-6">
      <a href="dashboard.html" class="relative py-2 hover:underline font-semibold border-b-2 border-white">Dashboard</a>
      <a href="cursos.html" class="relative py-2 hover:underline">Cursos</a>
      <a href="materiales.html" class="relative py-2 hover:underline">Materiales</a>
      <a href="recompensas.html" class="relative py-2 hover:underline">Recompensas</a>
      <a href="perfil.html" class="relative py-2 hover:underline">Mi Perfil</a>
      <button onclick="logout()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition font-semibold">
        Cerrar sesión
      </button>
    </nav>
  </div>
</header>

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

  <!-- Pie de página -->
  <footer class="bg-gray-800 text-white p-4 text-center">
    &copy; 2025 Sistema de Cursos.
  </footer>
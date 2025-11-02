
<body class="bg-gray-100 min-h-screen text-gray-800 flex flex-col">

  <!-- Navbar -->
  <header class="bg-blue-700 text-white p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">Sistema de Cursos</h1>
      <nav class="flex items-center space-x-6">
        <a href="dashboard.php" class="relative py-2 hover:underline">Dashboard</a>
        <a href="cursos.php" class="relative py-2 hover:underline">Cursos</a>
        <a href="materiales.php" class="relative py-2 hover:underline font-semibold border-b-2 border-white">Materiales</a>
        <a href="recompensas.php" class="relative py-2 hover:underline">Recompensas</a>
        <a href="perfil.php" class="relative py-2 hover:underline">Mi Perfil</a>
        <button onclick="logout()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition font-semibold">
          Cerrar sesión
        </button>
      </nav>
    </div>
  </header>
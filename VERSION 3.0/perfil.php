<?php 
    include "vistaPerfil/cabecera.php";
 ?>

<?php 
    include "vistaPerfil/head.php";
 ?>
 <?php 
    include "vistaPerfil/main.php";
 ?>
 <?php 
    include "vistaPerfil/pie.php";
 ?>




  <!-- Modal para eliminar cuenta -->
  <div id="deleteAccountModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-md mx-4">
      <div class="text-center">
        <div class="text-4xl text-red-500 mb-4">⚠️</div>
        <h3 class="text-xl font-bold mb-4">¿Estás seguro?</h3>
        <p class="text-gray-600 mb-6">Esta acción eliminará permanentemente tu cuenta y todos tus datos. No podrás recuperarlos.</p>
        <div class="flex space-x-4 justify-center">
          <button onclick="deleteAccount()" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
            Sí, eliminar cuenta
          </button>
          <button onclick="hideDeleteAccountModal()" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
  <script src="perfil.js"></script>
</body>
</html>
<?php 
  include "vistaLogin/loginPrueba.php";
?>

  <script>
    function showPopup(message, type = 'success') {
      const popup = document.getElementById('popup');
      const icon = document.getElementById('popup-icon');
      const msg = document.getElementById('popup-message');

      msg.textContent = message;

      if (type === 'success') {
        popup.className = 'fixed top-5 right-5 px-4 py-3 rounded shadow text-white font-semibold flex items-center space-x-2 bg-green-600';
        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>`;
      } else {
        popup.className = 'fixed top-5 right-5 px-4 py-3 rounded shadow text-white font-semibold flex items-center space-x-2 bg-red-600';
        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>`;
      }

      popup.classList.remove('hidden');
      setTimeout(() => {
        popup.classList.add('hidden');
      }, 3000);
    }

    function toggleRegister() {
      document.getElementById('registerForm').classList.toggle('hidden');
    }

    function login(event) {
      event.preventDefault();
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      const usuarios = JSON.parse(localStorage.getItem('usuarios')) || {};

      if (usuarios[email]) {
        if (usuarios[email].password === password) {
          localStorage.setItem('usuario', email);
          localStorage.setItem('nombre', usuarios[email].nombre);
          showPopup('Inicio de sesión correcto ✔️', 'success');
          setTimeout(() => {
            window.location.href = 'dashboard.php';
          }, 1500);
        } else {
          showPopup('Contraseña incorrecta ❌', 'error');
        }
      } else {
        showPopup('Este correo no está registrado ❌', 'error');
        toggleRegister();
      }
    }

    function register(event) {
      event.preventDefault();
      const nombre = document.getElementById('newName').value;
      const email = document.getElementById('newEmail').value;
      const password = document.getElementById('newPassword').value;

      const usuarios = JSON.parse(localStorage.getItem('usuarios')) || {};

      if (usuarios[email]) {
        showPopup('Este correo ya está registrado ❌', 'error');
        return;
      }

      usuarios[email] = { nombre, password };
      localStorage.setItem('usuarios', JSON.stringify(usuarios));
      localStorage.setItem('usuario', email);
      localStorage.setItem('nombre', nombre);

      showPopup('Cuenta creada exitosamente ✔️', 'success');
      setTimeout(() => {
        window.location.href = 'dashboard.php';
      }, 1500);
    }
  </script>

<script src="script.js"></script>

</body>
</html>

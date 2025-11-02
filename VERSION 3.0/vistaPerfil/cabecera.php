<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Perfil | Sistema de Cursos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../style.css" />
  <style>
    .avatar-upload {
      position: relative;
      display: inline-block;
    }
    
    .avatar-upload:hover .avatar-overlay {
      opacity: 1;
    }
    
    .avatar-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.5);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
      cursor: pointer;
    }
    
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }
    
    .tab-content {
      display: none;
      animation: fadeIn 0.5s ease-in-out;
    }
    
    .tab-content.active {
      display: block;
    }
  </style>
</head>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Materiales | Sistema de Cursos</title>
  <link rel="stylesheet" href="../style.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .material-card {
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }
    
    .material-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .category-badge {
      position: absolute;
      top: 12px;
      right: 12px;
      font-size: 0.75rem;
      padding: 0.25rem 0.75rem;
      border-radius: 1rem;
    }
    
    .download-btn {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      transition: all 0.3s ease;
    }
    
    .download-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }
    
    .view-btn {
      background: linear-gradient(135deg, #10b981, #047857);
      transition: all 0.3s ease;
    }
    
    .view-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }
  </style>
</head>
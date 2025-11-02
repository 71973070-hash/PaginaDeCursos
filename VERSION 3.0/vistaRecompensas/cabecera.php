<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recompensas | Sistema de Cursos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css" />
  <style>
    .reward-card {
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }
    
    .reward-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .progress-ring {
      transform: rotate(-90deg);
    }
    
    .unlocked {
      border: 3px solid #10B981;
      background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    }
    
    .locked {
      opacity: 0.7;
      filter: grayscale(0.3);
    }
    
    .level-badge {
      background: linear-gradient(135deg, #f59e0b, #d97706);
      color: white;
    }
    
    .points-badge {
      background: linear-gradient(135deg, #8b5cf6, #7c3aed);
      color: white;
    }
  </style>
</head>
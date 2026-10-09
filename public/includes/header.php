<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Модульное веб-приложение на PHP</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333; background-color: #f8f9fa; }
        header { background-color: #1b365d; color: #ffffff; padding: 20px 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        header h1 { margin: 0; font-size: 24px; }
        nav { margin-top: 15px; }
        nav a { color: #ffffff; text-decoration: none; margin-right: 20px; font-weight: 500; font-size: 15px; transition: color 0.3s; }
        nav a:hover { color: #007bff; }
        main { padding: 30px; min-height: 400px; max-width: 1200px; margin: 0 auto; background: #ffffff; box-shadow: 0 0 10px rgba(0,0,0,0.05); margin-top: 20px; margin-bottom: 20px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; box-shadow: 0 2px 3px rgba(0,0,0,0.02); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .error-box { background-color: #f8d7da; color: #721c24; padding: 15px; border-left: 5px solid #dc3545; border-radius: 4px; margin-top: 20px; }
        footer { background-color: #343a40; color: #ffffff; text-align: center; padding: 15px 0; font-size: 14px; position: relative; bottom: 0; width: 100%; }
    </style>
</head>
<body>
<header>
    <h1>Панель управления корпоративным сайтом</h1>
    <nav>
        <a href="index.php?page=home">Главная страница</a>
        <a href="index.php?page=products">Каталог продукции</a>
        <a href="index.php?page=about">О компании</a>
        <a href='index.php?page=reviews'>Отзывы клиентов</a>
    </nav>
</header>
<main>

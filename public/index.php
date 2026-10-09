<?php
$host = 'MySQL-8.0';
$user = 'root';
$password = '';
$database = 'lab_db';

$mysqli = new mysqli('MySQL-8.0', 'root', '', 'lab_db');
if ($mysqli->connect_error) {
    die('Ошибка подключения: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

$sql = "SELECT id, name, email FROM users";
$result = $mysqli->query($sql);

echo "<h1>Список пользователей</h1>";
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Имя</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет данных.";
}
// --- ДОБАВИТЬ ЭТОТ БЛОК ДЛЯ ВЫВОДА ТОВАРОВ ---
$sql_products = "SELECT id, title, price FROM products";
$result_products = $mysqli->query($sql_products);

echo "<h1>Список товаров</h1>";
if ($result_products && $result_products->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Название</th><th>Цена</th></tr>";
    while ($row_products = $result_products->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row_products['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row_products['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row_products['price']) . " руб.</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет данных о товарах.";
}
// ---------------------------------------------
?>


<?php
/**
 * ГЛАВНЫЙ КОНТРОЛЛЕР (FRONT CONTROLLER)
 */

// Исключаем вывод предупреждений в поток вывода до инициализации заголовков
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Инициализация глобального слоя конфигурации и подключения к БД
// Использование require_once гарантирует, что критически важный файл подключен строго 1 раз
require_once __DIR__ . '/config/db.php';

// 2. Обработка входящего GET-параметра маршрутизации
// Если параметр 'page' передан в URL (например, ?page=products), берем его значение.
// Если параметр отсутствует (пользователь только открыл корень сайта), открываем страницу 'home'.
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// 3. БЕЗОПАСНОСТЬ: Защита от уязвимости Path Traversal (обход каталогов)
// Функция basename() отсекает любые пути типа '../../etc/passwd', оставляя чистое имя файла.
$page = basename($page);

// 4. Формирование абсолютного пути к файлу контента страницы
$page_file = __DIR__ . "/pages/{$page}.php";

// 5. Вывод визуального интерфейса: ПОДКЛЮЧЕНИЕ ШАПКИ САЙТА
// Переменные стилей и верстки инициализируются здесь
include_once __DIR__ . '/includes/header.php';

// 6. ДИНАМИЧЕСКАЯ МАРШРУТИЗАЦИЯ КОНТЕНТА
// Проверяем физическое существование файла на сервере с помощью функции file_exists()
if (file_exists($page_file)) {
    // Если файл существует — динамически подключаем его контент.
    // Обратите внимание: внутри подключаемого файла будет доступна переменная $pdo,
    // созданная на этапе 1 в файле config/db.php.
    include $page_file;
} else {
    // Если файла страницы нет физически в папке pages/, генерируем HTTP-ответ 404
    // Уведомляем браузер об ошибке смены заголовком ответа
    header("HTTP/1.0 404 Not Found");
    echo '<div class="error-box">';
    echo '<h2>Ошибка 404: Страница не найдена</h2>';
    echo '<p>Запрошенный вами раздел меню или внутренний модуль отсутствует на данном сервере.</p>';
    echo '</div>';
}

// 7. Вывод визуального интерфейса: ПОДКЛЮЧЕНИЕ ПОДВАЛА САЙТА
// Закрываем теги main, body и html, выводим футер
include_once __DIR__ . '/includes/footer.php';
?>

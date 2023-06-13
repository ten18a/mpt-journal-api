<?php
// Ссылка на страницу с HTML-кодом
$url = 'https://mpt.ru/studentu/izmeneniya-v-raspisanii/';

// Загружаем HTML-код страницы
$html = file_get_contents($url);

// Создаем объект DOMDocument
$dom = new DOMDocument();
// Загружаем HTML-код страницы
$dom->loadHTML($html);

// Массив для хранения данных в формате JSON
$data = [];

// Парсинг таблицы замен
$tables = $dom->getElementsByTagName('table');
foreach ($tables as $table) {
    // Получаем заголовок таблицы (название группы)
    $caption = $table->getElementsByTagName('caption')->item(0)->textContent;
    // Получаем строки таблицы
    $rows = $table->getElementsByTagName('tr');
    $groupData = [];
    foreach ($rows as $row) {
        // Пропускаем заголовок таблицы
        if ($row === $table->getElementsByTagName('tr')->item(0)) {
            continue;
        }
        // Получаем ячейки строки
        $cells = $row->getElementsByTagName('td');
        // Извлекаем данные из ячеек
        $lessonNumber = $cells->item(0)->textContent;
        $replaceFrom = $cells->item(1)->textContent;
        $replaceTo = $cells->item(2)->textContent;
        $updatedAt = $cells->item(3)->textContent;

        // Добавляем данные в массив группы
        $groupData[] = [$lessonNumber, $replaceFrom, $replaceTo, $updatedAt];
    }
    // Добавляем данные группы в общий массив
    $data[$caption] = $groupData;
}

// Преобразуем данные в формат JSON
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>

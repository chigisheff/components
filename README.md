index.php - страница пользователя
dataop.php - страница оператора данных, управление данными
admin.php - страница администратора

class/
manage_main.php - реализация для index.php
pagemain.php - реализация для dataop
q_fields.php - запросы БД заполнение select для index.php и первой таблицы в dataop.php
q_index_page.php - запросы БД вывод общего списка компонентов
q_interface.php - интерфейс для заполнения select и того же списка и инструментов к списку
q_oper_page.php - работа с динамически создаваемыми таблицами на тип элемента

css/
m_style.php
reset.php - 

img/

interface/
content_menu.php - кнопки из набора инструметов, не задействована
glob_menu.php - меню выбора на index.php
op_pg_content.php - dataop.php Список элеметов, динамические базы, привязанные к элементам и инструменты
op_pg_head.php - вариация хедера для страницы dataop.php
pg_bottom.php - футер страницы, пока общий для всех
pg_content.php - таблица с имеющимися компонентами(общая) сюда диалог, для вывода информации по выбранному типу
                 компонента.
pg_head.php - хеадер index включает меню фильтрация общего списка компонентов


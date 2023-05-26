<h1>Отчётность по тестовому заданию</h1>

| <h3>Оглавление</h3>                                                               | 
|-----------------------------------------------------------------------------------| 
| [Текст задания](#text)                                                            | 
| [Как развернуть](#how)                                                            | 
| [НЕеализованный функционал](#real)                                                |
| [Тестирование API в HTTP-клиентах (Postman, Insomnia)](#postman)                                      |                                   | 
| [Несколько комментариев касательно кода и архитектуры](#comments)                 | 
| [История о том, как один разработчик orchid к laravel 10 прикручивал](#coolStory) | 

<h2><a name="text">Текст задания</a></h2>

**Pastebin [hard]**
http://pastebin.com Он позволяет заливать куски текста/кода и получать на них короткую ссылку, которую можно отправить другим людям. Загружать данные можно как анонимно, так и зарегистрировавшись.
 
- Основная функциональность:
    - Возможность загрузить кусок текста ("пасту") из названия и текста 
    - загружать можно как анонимно, так и залогинившись
    - можно выбрать срок в течение которого "паста" будет доступна по ссылке (expiration time)10мин, 1час, 3часа, 1день, 1неделя, 1месяц, без ограничения после окончания срока получить доступ к "пасте" нельзя
    - можно указать ограничение доступа:
        - public: доступна всем, видна в списках 
        - unlisted: доступна только по ссылке
        - private: доступна только отправившему (только одному авторизовавшемуся пользователю -- автору)
    - для "пасты" можно выбрать язык, тогда при выводе синтаксис выбранного языка должен подсвечиваться 
    - для загруженной пасты выдается короткая ссылка вида http://my-awesomepastebin.tld/{какой-то-рандомный-хэш}, например, http://my-awesomepastebin.tld/ab12cd34
- Авторизация/регистрация
    - по логину паролю по соцсетям
    - Возможность просмотра по ссылке на всех страницах 
    - блок с последними 10 public пастами
    - на всех страницах залогиненный пользователь видит доп. блок с последними 10 своими пастами
    - зарегистрированный пользователь имеет отдельную страницу, где видит список всех своих паст с пагинацией (например, по 10) 
    - все пасты, у которых вышел срок доступности, не видны никому, в том числе и автору
- Возможность пользователю пожаловаться на пасту
- Администрирование
    - Прикрутить к проекту админку voyager, orchid
    - Добавить возможность просмотра списка пользователей, паст и жалоб
    - Добавить возможность бана пользователя и удаления паст
- API для сторонних приложений
    - Добавить возможность взаимодействия с приложением при помощи API запросов
    - Добавить запросы для получения того, что описано выше
 
- Требования к проекту:
    - Backend
    - Framework: Laravel
    - DB: MySQL, MariaDB, Postgres
    - Использовать паттерн Repository и паттерн Service
    - Строгая типизация
    - Везде писать phpDoc’и
    - Прикрутить и настроить phpStan, исправить ошибки на минимум 6 уровне
    - Развернуть на docker compose
    - Frontend - без ограничений (верстка не оценивается в рамках задания)
    - Код в репозитории (git) на github
        - Крайне желательно пользоваться репозиторием, а не залить что получится в конце одним коммитом вместе с фреймворком Описание коммитов должно следовать соглашению Conventional Commits

<h2><a name="how">Как развернуть</a></h2>

Для развёртки проекта локально нужно иметь установленные и настроенные **docker** и **Git**.

<h4>Очерёдность действий:</h4>

1. Откройте консоль, переместитесь в папку, куда будет клонироваться проект. Запустите в терминале команду 
```
git clone https://github.com/UnidentifiedCormorant/ToothPaste.git
```
2. После окончания клонирования проекта, запустите docker (если вы ещё этого не сделали). Запустите команду:
```
docker-compose up -d    //сборка контейнера
```
3. После сборки завершения сборки контейнера:
```
docker exec -it ToothPaste bash    //переходим в основной образ
```
4. Доустанавливаем фреймворк, потому что vendor игнорируется гитом (и правильно):
```
composer install
```
6. Наконец:
```
php artisan migrate --seed   //накатываем миграции и заполняем базу случайными данными
```

Для того, чтобы переийти в приложение, напишите в адресной строке http://localhost:8069.

Команда из пункта 6 так же автоматически **создаёт пользователя с правами администратора** для удобства тестирования приложения. Логин и пароль для 
такого пользователя ``admin@admin.com`` и ``123`` соответственно.

<h2><a name="real">НЕреализованный функционал</a></h2>

Из того, что было описано в тексте тестового задания, не было реализовано:

- Авторизация/регистрация по соцсетям

Остальной описанный функционал был как-то да реализован, а требования были выполнены (в основном).

<h2><a name="postman">Тестирование API в HTTP-клиентах (Postman, Insomnia)</a></h2>

В проекте есть апишка и в ней так же реализованы авторизация с аутентификацией с использованием ``Laravel Sanctum``, однако, по моему скромному мнению использование фич авторизации ну совсем не очивидно, поэтому опишу их здесь.

Роут ```.../api/auth``` позволяет авторизоваться в приложении. Для примера используем автоматически сгенерированного пользователя с правами администратора.
При использовании роута, пропишите такие параметры формы: ```email: admin@admin.com``` ```password: 123```. В JSON-ответе должен быть токен (например: ```"token": "3|6YdtE4YEPOp6id62VvFZY8GGCvvCNorVTjQjNtnY"```). Далее последующих запросах, где требуется авторизация, используйте в меню Headers 
```
"Accept": "application/json",
"Authorization": "Bearer 3|6YdtE4YEPOp6id62VvFZY8GGCvvCNorVTjQjNtnY"
```
Примечание: Этот функционал был протестирован только в Insomnia. Вы конечно можете попытаться в Postman, но лучше используйте Insomnia)

<h2><a name="comments">Несколько комментариев касательно кода и архитектуры</a></h2>

**Комментарий касательно паттерна "Репозиторий".**

Дело в том, что он был прикручен сюда исключительно для того, чтобы показать, что я умею им пользоваться. Каких-либо других весомых причин для его применения *конкретно в этом проекте* я не вижу. Здесь нет никакий сложной бизнес-логики или запросов для вытягивания данных из базы, везде достаточно методов в рамках Eloquent моделей. Конечно существует аргумент в виде "а что если у нас сменится источник данных (кстати, на этот случай ``PastaRepository`` забинден в ``AppServiceProvider``)", но вряд ли в этом тестовом проекте это произойдёт, так что тянуть повсюду этот паттерн я не стал. В общем реализацию можно увидеть в методе ``show`` класса ``PastaController``.

**Очереди**

В проекте, для реализации "исчезновения" паст по истечению времени (если оно указано конечно), используется механизм очередей ([queue](https://laravel.com/docs/9.x/queues)). Этот механизм позволяет выносить логику в фоновые процессы. Чтобы эта красота заработала, необходимо в файле ```.env``` прописать ```QUEUE_CONNECTION=database```,в противном случае процессы будут выполняться мгновенно (может быть полезно при тестировании функционала). При настройке ```QUEUE_CONNECTION=database```, чтобы запустить работу очередей, необходимо после запуска приложения прописать в терминале команду ```php artisan queue:work```

<h2><a name="coolStory">История о том, как один разработчик orchid к laravel 10 прикручивал</a></h2>

Одним холодным солнченым днём, некий разработчик решил 
прикрутить админ-панель к своему проекту. Разработчик 
был юн, неопытен и откровенно девственен к 
админ-панелям. Но жажда открытий, исследований и 
познания взяла своё. Разработчик с блеском в глазах 
немного почитал-посмотрел про orchid и начал 
устанавливать его. Разработчику было неведомо, что 
черезвычайно занятые разработчики orchid ещё не успели 
выпустить версию для laravel 10. Его попытка с треском 
проволилась. Composer обругал ничего не понимающего 
разработчика и, взяв того за загривок, сказал что 
orchid не хочет дружить с laravel 10, видимо тот слишком
молод для него, он хочет общаться с laravel 9. 
Ввергнутый в шок такими известиями, слегка поникший, но 
ещё не унывающий разработчик, обратился к высшим силам
за советом. И высшие силы ответили, что он должен 
отметнуть свою гордость и вернуться в старую хату, 
на 9 версию laravel. А ведь он только-только успел
рассположиться в 10 квартире...

Уже немного понурый разработчик начал создавать новый 
проект, попутно обсуждая проблему со своим мудрым 
другом. Узнав о переезде, мудрый друг сказал,
иногда перестроить стены легче, чем переместить вещи.
Разработчик внял советам мудрого друга, погуглил, и 
нашёл способ даунгрейднуть laravel 10 до laravel 9.

Кароче он снёс нахрен vendor и сделал composer install,
перед этим скопировав описание composer.json из 
новосозданного пустого проекта. Удаление composer.lock 
оказалось вишенкой на торте. После этого уставший 
(потому что всё это оказалось ни разу не с первой
попытки, в итоге vendor пришлось устанавливать аж
трижды) разработчик с гордостью установил orchid и...

...столкнулся с рядом ошибок, потому что забыл о паре
опорных балок в новой конструкции дома, а точнее, он 
даже не знал о них. В общем Authenticate.php ломался
из-за новомодной строгой типизации параметров функции, 
поэтому её пришлось пофиксить. Пришлось перекопировать
из пустого проекта массив 'providers', потому что в 10 
ларе он описан по другому. В Kernel.php пришлось 
поменять название $middlewareAliases на 
$routeMiddleware.

И вот наконец, момент триумфа разработчика настал,
админ-панель запущена и утомлённый, но довольный
разработчик вновь готов покорять новые горизонты.

Занавес

***

В ролях:
- [X] Чуть более опытный разработчик
- [X] Воистину мудрый друг
- [X] Высшие силы

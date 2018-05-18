# Установка

1.
```
composer install
mv .env.example .env
```

2.
Отредактировать .env

3.
```
php artisan migrate:fresh --seed
```

4.
Для запуска задач по расписанию добавить следующее в cron:
```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

5.
Для запуска обработчика очереди запустить в консоли:
```
php artisan queue:work --queue=downloading
php artisan queue:work --queue=downloading
php artisan queue:work --queue=converting
php artisan queue:work --queue=converting
```

(Надо запустить по 2 worker'а на каждую очередь, чтобы выполнялось по 2 задачи одновременно)

6.
Тестовые юзеры

Админ: admin@example.com / qwerty
Пользователи: user@example.com / qwerty, user2@example.com / qwerty
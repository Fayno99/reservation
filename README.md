скачати 2 проекти
                               
                                            laravel

для перевірки я використовував nginx на базі WSL UBUNTU


головний проєкт має бути підключений до шляху  'localhost'

відредагувати  .env.example в .env

створити пусту базу і заповнити всі поля в .env

DB_CONNECTION=mysql

база данних для тестів DB_CONNECTION2=mysql2

виконати команду будучі в корні пректу 'composer install'

написати команду для створення таблиць в базі данних 'php artisan migrate'


в роботі прописані 4 користувачі які кажуть самі за себе

admin@test.com        

user@test.com

manager@test.com

assistant@test.com


пароль для всіх юзерів 12341234

                                  
                                             simfony

проект на сімфоні має бути на іншому порту наприклад localhost\90 
в папці проєкту натиснути composer install

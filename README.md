## MyLibrary

<p>A personal book management site, as normal user you can add or delete book in your reading list, rating and review a book, as admin you can add new book or delete it.</p>
<p>Frotend: Laravel framework, boostrap, jquery.</p>
<p>Backend: PhpMyAdmin, MySql</p>

[LIVE DEMO](https://boiling-ridge-86913.herokuapp.com/)

manager user:manager, password:123456
admin user: admin, password: 123456
normal user: user, password:123456

### To run local

<p>Set up db connection on .env file.
<p>Run on cmd:

```bash
php artisan config:cache
php artisan migrate
php artisan db:seed --class=CreateUsersSeeder
php artisan db:seed --class=DatabaseSeeder
```

<p>Then start the app with:

```bash
php artisan serve
npm run dev
```

# swift-link
# how to setup database
- Start Apache, open project
- It will automatically create a database for you 
- default database name: `swiftlink`
- You change the database name inside `config.php` file
```php
<?php
// config.php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'swiftlink'; // You can change it that you want
// the rest...
//....
```
- After you changed the database, please check if the database is successfully created
- Start `Mysql` in your `XAMPP` and click `admin` and Go to Database
- find and click your database
- If the table was created, select them all and drop or delete those tables
- After the tables was deleted, click `import` and import the `swifklink.sql` inside `DB` folder
- Execute the import sql, and now you are all setup.
- You can now use the system.
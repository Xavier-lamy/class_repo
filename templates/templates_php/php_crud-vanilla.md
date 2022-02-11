# CRUD Vanilla:

## ``_config.php``
```php
    //Define constants for connection to db
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "root");
    //Define Database name
    define("DBNAME", "dbmenus");
    //Define DSN
    define("DSN", "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8");
```

## ``_connect.php``
```php
// Database connection

    //Include db connection infos from _config.php
    require_once dirname(__DIR__)."/inc/_config.php";
    //Try connection:
    try{
        $db = new PDO(DSN, DBUSER , DBPASS);

        //Define PDO error mode
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Define default fetch() mode on fetch_assoc
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    }

    //If it fail: return error message and stop php
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }
```

## ``_disconnect.php``
```php
    //close connection:
    $db = null;
```

## ``_read.php``
```php
//Connection
require_once dirname(__DIR__)."/inc/_connect.php";

$sql = 'SELECT * FROM `stocks`';

//preparing query
$query = $db->prepare($sql);

//executing query
$query->execute();

//store result in array
$result = $query->fetchAll();

require_once dirname(__DIR__)."/inc/_disconnect.php";
```

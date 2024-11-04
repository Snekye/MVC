# MVC
Mon projet MVC

### Install
#### 1. Le fichier conf/database.json
Contient les accès à la base de données -> host, user, pass, dbname
Modifiez ce fichier selon votre base de données.
#### 2. Création de la base de données
```php scripts/db-build```

Depuis la racine du projet, cette commande permet de créer/mettre à jour les tables de votre base de données selon les Models. 
* La base de données doit être déjà créée.

```php scripts/db-data```

Cette commande insére les données du fichier conf/data.json. Note : la BDD est d'abord vidée!

#### 3. Voilà!

### Fonctionnement
#### conf/database.json
Contient host, user, pass, nom de bdd et charset pour le POO
#### conf/routes.json
Associe une uri à un controlleur
```
"/": "HomeController"
```
La route "error" (sans /) sera appellée en cas de 404
```
"error" : "ErrorController"
```
#### conf/roles_hierarchy.json
Permet une inhéritance des roles en cascade
```
{
    "ROLE_ADMIN" : "ROLE_USER",
    "ROLE_USER" : "PUBLIC_ACCESS"
}
```
#### conf/hashing.json
Contient des options de hashing regroupées en hashers
```
{
    "User": {
        "algorithm": "PASSWORD_BCRYPT",
        "cost" : "PASSWORD_BCRYPT_DEFAULT_COST"
    }
}
```

#### BDD
Lors de la création de la BDD : 
* Les classes qui étendent d'autres classes hériteront des propriétés de la classe étendue, tandis que les classes abstraites seront ignorées.
* Les types de données SQL sont stockées dans un tableau associatif constant de la classe
```
const DBTYPES = [
    "id" => "id",
    "editor" => "varchar(255)",
];
```
Le type "id" sert à générer un INT en PK + AUTO_INCREMENT
* Les enums sont gérés de la manière suivante : 
```
# App\Enum\MovieGenre
enum MovieGenre: string {
    case Thriller = "Thriller";

# App\Model\Movie
const dbtypes = [
    "genre" => "Enum/MovieGenre"
];
public MovieGenre $genre;
```



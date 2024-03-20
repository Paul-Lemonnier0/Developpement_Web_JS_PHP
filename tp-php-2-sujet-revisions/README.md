# Mise en place des espaces de noms et autochargeur avec `composer`

- Compléter `composer.json` avec ce fragment pour pouvoir utiliser l'autoloader PSR-4  de `composer` (`./vendor/autoload.php`) qui associera l'espace de noms (alias NS) dénommé `Acme` au  répertoire `src` :

```json
	"autoload" : {
		"psr-4" : {
			"Acme\\" : "src/"
		}
	}
```

- Créer l'autochargeur (`./vendor/autoload.php`) automatiquement avec `composer` :

`php composer.phar dump-autoload`


- Créer 2 répertoires `src` et `tests`.

- Définir vos classes et vos interfaces dans des fichiers séparés portant le nom que la classe ou l' interface (p. ex. `Employee.php` pour la classe `Employee`). 

- Déplacer les fichiers  dans `src`.

- Supprimer tous les imports de fichiers (`include`, `require`) y figurant. Les remplacer par la déclaration du NS `Acme` et importer l'autochargeur, p. ex.

```php
<?php // ./src/Employee.php
declare(strict_types=1); // lève une exception si erreur de typage à l'appel de fonctions/méthodes
namespace Acme;
require_once __DIR__ . '/../vendor/autoload.php';

```

- Implémenter vos scripts (p. ex. `employee_display.php`) en y important les classes/interfaces requises par utilisation de leur FQCN (Fully Qualified Class Name) avec le mot-clé `use` et en important l'autochargeur, p. ex.

```php
<?php // ./src/employee_dislay.php
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';
use Acme\Employee;
```

- Définir la/les classes de tests PHPUnit dans le dossier `tests`  en y important les NS requis et l'autochargeur, p. ex.

```php
<?php // ./tests/ManagerTest.php
require_once __DIR__ . '/../vendor/autoload.php';
use Acme\Manager;
use Acme\Employee;
use PHPUnit\Framework\TestCase;

final class ManagerTest extends TestCase { ...
```
	
- Une fois la classe de tests implantée, exécutez vos test avec `PHPUnit` (version 9.5) :

 `./phpunit tests/ManagerTest` 
 


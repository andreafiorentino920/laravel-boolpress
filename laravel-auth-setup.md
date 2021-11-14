# Laravel Auth - Backoffice & Frontoffice

## Dopo aver creato il progetto

- Installiamo il pacchetto laravel ui ```composer require laravel/ui:^2.4```
- Creiamo lo scaffolding Bootstrap con autenticazione ```php artisan ui bootstrap --auth```
- Lanciare ```npm install && npm run dev```

## Eseguiamo le migration

Verifichaimo di aver creato e collegato correttamente il database, quindi lanciamo ```php artisan migrate```

## Separazione Backoffice e Frontoffice
Laravel crea già un **HomeController**, possiamo eliminarlo.
Creiamo quindi un **HomeController** sotto il namespace Admin che gestirà la pagina di atterraggio dopo il login 
```php artisan make:controller Admin/HomeController ```
Ed un **PageController** per gestire l'homepage e le pagine pubbliche
```php artisan make:controller PageController ```
 
### Definizione rotte
definiamo ora le rotte per la parte di backoffice, raggruppandole con namespace, prefisso, middleware auth e name.
```php
// routes/web.php

// Rotte pubbliche
Route::get('/', 'PageController@index');

// Rotte Autenticazione
Auth::routes();

// Rotte area Admin
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
});
```

### Modifica path della costante HOME
Cambiamo l'url di redirect dopo il login (al posto di `/home`, scriviamo `/admin`)
```php
// app/Providers/RouteServiceProvider.php

class RouteServiceProvider extends ServiceProvider
{
    // ...

		/**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/admin';

		// ...
}
```
### Organizzazione views
Creiamo **2 layout**: uno per la parte di backoffice e uno per la parte di frontoffice

Creiamo una sottocartella `resources/views/admin/` per gestire tutte le views lato **backoffice** e una sottocartella `resources/views/guest/` per gestire tutte le views lato **frontoffice**

## Crud time

Arrivati a questo punto possiamo dedicarci alla creazione delle nostre **CRUD** per ogni singola entità, ricordando di separare parte pubblica da parte privata!
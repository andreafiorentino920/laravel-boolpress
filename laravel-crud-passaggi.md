# Progetto laravel CRUD

## Inizializzazione progetto, database, server

- creare la cartella vuota del progetto sul nostro computer
- creare i file laravel v.7 nel progetto con il comando: ```composer create-project --prefer-dist laravel/laravel:^7.0 .```
- Attiviamo il server di MAMP e in phpMyAdmin creo un nuovo **DB VUOTO**
- Imposto i miei dati nel file 📃.env per connettere il progetto con il DB:
```
DB_DATABASE=nomeDatabaseCreato
DB_USERNAME=********** 
DB_PASSWORD=**********
```
- Pulisco i dati di configurazione dopo la modifica del file 📃.env: ```php artisan config:clear```
- Posso ora attivare il server: ```php artisan serve```

## Creazione della Migration

- Creo la prima migration con il comando: ```php artisan make:migration create_nomePluraleTabella_table```
- Inserisco le colonne che mi serviranno della table nella migration appena realizzata 
- Realizzo nel Database la migration creata con il comando: ```php artisan migrate```

## Creazione del Model

- Creiamo il Model della migration utilizzando il nome della tabella al singolare: ```php artisan make:model NomeAlSingolareTabella ```

## Riempire la tabella con i Seeder

- Per riempire la tabella creata nel DB con dei dati finti usiamo i seeder, il comando da lanciare nel terminale è: ```php artisan make:seeder NomeAlSingolareTabella+Table+Seeder```
- Dopo averlo creato, lo apriamo e importiamo il Model di riferimento con: ```use App\NomeModel;```
- Realizziamo un 📃file con dati fittizi da inserire nella cartella 📁config per popolare il nostro DB
```php
//config/nomeFile.php
<?php
return [
    //Proprietà in base alle colonne della tabella da popolare
    [
        "name" => "Fiesta St Line",
        "brand" => "Ford",
        "exchange" => "Automatico",
        "gears" => "6",
    ],
    [
        "name" => "Puma",
        "brand" => "Ford",
        "exchange" => "Manuale",
        "gears" => "7",
    ],
    [
        "name" => "Mustang",
        "brand" => "Ford",
        "exchange" => "Automatico",
        "gears" => "10",
    ],
]
?>
```

- Ora nel Seeder dobbiamo accedere ai dati e poi ciclarli con un ForEach:
```php
//database/seeds/nomeSeeder

class NomeAlSingolareTabella+Table+Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomeVariabilePlurale = config("nomeFileConfig"); //Ottiene i dati dal file nella cartella config

        //Ciclare gli elementi del file config
        foreach ($nomeVariabilePlurale as $nomeVariabileSingolare){
            $newNomeAScelta = new nomeModelTabella(); //Creo il modello
            $newNomeASceltaSingolare->proprietàFileConfig1 = $nomeModelTabella["proprietàFileConfig1"];
            $newNomeASceltaSingolare->proprietàFileConfig2 = $nomeModelTabella["proprietàFileConfig2"];
            $newNomeASceltaSingolare->proprietàFileConfig3 = $nomeModelTabella["proprietàFileConfig3"];
            $newNomeASceltaSingolare->proprietàFileConfig4 = $nomeModelTabella["proprietàFileConfig4"];
            $newNomeASceltaSingolare->save();
        }
    }
}
```
- Popoliamo la tabella nel DB con i dati con il comando: ```php artisan db:seed --class=NomeAlSingolareTabella+Table+Seeder```

## Creazione controller per gestire CRUD
- Per creare un controller che gestirà le CRUD usiamo il comando: ```php artisan make:controller --resource NomeModel+Controller```
- Ora dovo creare le rotte in 📁routes > 📃web.php per gestire tramite il controller le URL che permetteranno le CRUD: 
```php
//routes/web.php

Route::resource('nomeTabella', 'nomeControllerCRUD');
```
- Ora posso controllare la lista delle rotte del mio progetto con il comando: ```php artisan route:list```

## CRUD - Read All

- Nel controller, con la function index() richiamiamo tutti gli elementi della tabella e la view dedicata al mostrarli nel frontend:

```php
//app/Http/controllers/nomeControllerCRUD

public function index()
{
    $nomeVariabilePlurale = NomeModel::all();
    return view('nomeCartella.nomeView', compact('nomeVariabilePlurale')); //Uso la view index.blade.php nella cartella cars
}
```
- Strutturare la view

## CRUD - Read singolo elemento

- Nel controller, con la function show() richiamiamo l'elemento singolo della tabella e la view dedicata al mostrare nel frontend:
```php
//app/Http/controllers/nomeControllerCRUD

public function show($id)
{
    $nomeVariabileSingolare = NomeModel::find($id);
    return view('nomeCartella.nomeView', compact('nomeVariabileSingolare'));
}
```
- Strutturare la view

## CRUD - Create creare un nuovo dato
- Nel controller, con la funzione create() richiamo la view che permetterà co un form di creare un nuovo record:
```php
//app/Http/controllers/nomeControllerCRUD

public function create()
{
    return view('nomeCartella.nomeView');
}
```
- Nella view creiamo il form stando attenti a modificare: Method, action, name degli input e aggiungere @csrf subito dopo il tag ```<form></form>```
- Ora dobbiamo impostare nel controller la funzione store() per salvare i dati che inviamo dal form:
```php
//app/Http/controllers/nomeControllerCRUD

public function store()
{
    public function store(Request $request)
    {
        $data = $request->all(); //Cattura tutti i dati compilati nel form

        $newNomeAScelta = new nomeModelTabella(); //Creo il modello
        $newNomeASceltaSingolare->proprietàFileConfig1 = $data["proprietàFileConfig1"];
        $newNomeASceltaSingolare->proprietàFileConfig2 = $data["proprietàFileConfig2"];
        $newNomeASceltaSingolare->proprietàFileConfig3 = $data["proprietàFileConfig3"];
        $newNomeASceltaSingolare->proprietàFileConfig4 = $data["proprietàFileConfig4"];
        $newNomeASceltaSingolare->save();

        return redirect()->route("nomeCartella.show", $newNomeASceltaSingolare->id); //Reindirizzo alla pagina del prodotto appena creato
    }
}
```


## Laravel - Layout
- Per creare un layout da usare in diverse view, dobbiamo creare una 📁layout e inserirla nel percorso 📁resources > 📁views > 📁layout > 📃base.blade.php
- Lo strutturiamo, in genere inserendo i tag head e i rispettivi file per css e javascript
- lo estendiamo nelle diverse view utilizzando il comando: ```@extends('layout.base');

>⚠️nel file del layout deve esserci uno `@yield('pageContent')` per renderlo dinamico in base al contenuto della view, nella singola view userò il comando:
```
@section('pageContent')
....
@endsection
```

## Laravel - Partials
- Per creare piccoli componenti da riutilizzare nella pagina usiamo i partials, da creare nel percorso: 📁resources > 📁views > 📁partials > 📃nomePartials.blade.php
- Per usare i partials nel layout uso scriverò: ```@include('partials.header')```


## Snippets Laravel

- Tornare indietro di una modifica nella migration: ```php artisan migrate:rollback```
- Aggiungere uno scaffolding per il frontend: ```composer require laravel/ui:^2.4``` poi scegliere tra:
```
php artisan ui bootstrap
php artisan ui vue
php artisan ui react
```
Ci chiederà di lanciare poi il comando: ```npm install && npm run dev```

# Camezilla - Documentazione

## 1. Panoramica
- **Nome progetto:** Camezilla
- **Versione:** 1.0.0
- **Descrizione breve:** Framework leggero per la creazione di Web App e API server-side in PHP, a livello didattico.

## 2. Requisiti
- **PHP**
- **Web server (Apache)**
- **MySQL**

## 3. Installazione

### 3.1 Copia progetto

Per utilizzare Camezilla è necessario copiare la cartella `camezilla` nella root della Web App in cui lo si vuole utilizzare, e nei file in cui lo si utilizza inserire l'istruzione di import:

```php
require_once __DIR__ . '/path/to/camezilla/camezilla.php';
```

### 3.2 Configurazione iniziale

Per configurare il framework, è necessaria la creazione di un `camezilla.config.json`. All'interno di questo file è possibile inserire la configurazione desiderata dall'utente.

#### 3.2.1 URL

> Nota: campo obbligatorio.

URL della cartella di root del progetto.

```json
{
    "url": "https://mydomain.com/project/"
}
```

#### 3.2.2 Base Directory

> Nota: campo obbligatorio.

Percorso fisico della cartella di root del progetto a partire dalla root del server.

```json
{
    "base-directory": "path/to/project"
}
```

#### 3.2.3 Log File

> Nota: campo obbligatorio.

Percorso fisico del file di log del progetto a partire dalla root del server.

```json
{
    "log-file": "path/to/app.log"
}
```

#### 3.2.4 Actions

Percorso fisico della cartella delle actions a partire dalla root del progetto. Vengono utilizzate come destinazione ai form interni alla Web App server-side.

```json
{
    "actions": "path/to/actions/"
}
```

#### 3.2.5 API

Percorso fisico della cartella delle API a partire dalla root del progetto. Vengono utilizzate come destinazione per i client API.

```json
{
    "api": "path/to/api/"
}
```

#### 3.2.6 Pages

> Nota: campo obbligatorio.

Percorso fisico della cartella delle pages a partire dalla root del progetto. Sono tutte le pagine Web raggiungibili da utenti esterni.

```json
{
    "pages": "path/to/pages/"
}
```

#### 3.2.7 Resources

> Nota: campo obbligatorio.

Percorso fisico della cartella delle resources a partire dalla root del progetto. Sono risorse statiche utilizzate dalla Web App, come file `css` o immagini.

```json
{
    "resources": "path/to/resources/"
}
```

#### 3.2.8 Texts

Oggetto di configurazione per i texts. Sono testi statici multilinguistici fruibili dalla Web App.

- `enabled`: booleano per indicare se il progetto utilizzerà texts.
- `path`: percorso fisico del file `json` contenente i texts (obbligatorio se `enabled` è `true`).
- `default-language`: lingua di default da utilizzare se non viene specificata una lingua diversa (obbligatorio se `enabled` è `true`).

```json
{
    "texts": {
        "enabled": true,
        "path": "path/to/texts.json",
        "default-language": "en"
    }
}
```

#### 3.2.9 Autoload

> Nota: campo obbligatorio.

> Importante: è obbligatorio inserire il percorso della cartella `camezilla` nella configurazione.

Oggetto di configurazione per il caricamento automatico delle classi PHP.

- `namespaces`: array di namespace da caricare automaticamente. Per ogni namespace, è necessario specificare il percorso fisico a partire dalla root del progetto.

```json
{
    "autoload": {
        "namespaces": {
            "MyNamespace\\": "path/to/namespace/",
            "Camezilla\\": "camezilla/"
        }
    }
}
```

#### 3.2.10 Database

Oggetto di configurazione per il database.

- `enabled`: booleano per indicare se il progetto utilizzerà database.
- `host`: host del database (obbligatorio se `enabled` è `true`).
- `user`: utente del database (obbligatorio se `enabled` è `true`).
- `password`: password del database (obbligatorio se `enabled` è `true`).
- `name`: nome del database (obbligatorio se `enabled` è `true`).
- `error-page`: percorso fisico a partire dalla cartella pages della pagina a cui reindirizzare in caso di errore di connessione al database (obbligatorio se `enabled` è `true`).

```json
{
    "database": {
        "enabled": true,
        "host": "my-host",
        "user": "my-user",
        "password": "my-password",
        "name": "my-database",
        "error-page": "path/to/error.php"
    }
}
```

#### 3.2.11 Authentication

Oggetto di configurazione per l'authentication.

- `enabled`: booleano per indicare se il progetto utilizzerà authentication.
- `secret-key`: chiave segreta utilizzata per la generazione dei token di autenticazione (obbligatorio se `enabled` è `true`).
- `login-page`: percorso fisico a partire dalla cartella pages della pagina di login (obbligatorio se `enabled` è `true`).

```json
{
    "authentication": {
        "enabled": true,
        "secret-key": "my-secret-key",
        "login-page": "login.php"
    }
}
```

## 4. Funzionalità del framework

### 4.1 Entry point

L'entry point del framework è il file `camezilla.php`, che si occupa di caricare la configurazione e inizializzare le componenti del framework. Inoltre, fornisce funzioni globali per l'utilizzo delle componenti del framework all'interno della Web App. È necessario importare questo file in ogni file in cui si vogliono utilizzare le funzionalità del framework.

```php
// file.php

<?php
require_once __DIR__ . '/path/to/camezilla/camezilla.php';

log_info("Hello, world!"); // funzione del framework
```

### 4.2 Autoload

Il framework fornisce una funzionalità di autoload per il caricamento automatico delle classi PHP. Per utilizzare questa funzionalità, è necessario configurare i namespace da caricare automaticamente nel file `camezilla.config.json`. Una volta configurati i namespace, è possibile utilizzare le classi PHP senza doverle importare manualmente.

```php
// file.php

<?php
require_once __DIR__ . '/path/to/camezilla/camezilla.php';

use MyNamespace\MyClass;

$instance = new MyClass();
```

Per utilizzare una classe fornita dal framework, è necessario configurare il namespace `Camezilla` nel file `camezilla.config.json`. In questo modo, tutte le classi fornite dal framework saranno disponibili per l'utilizzo senza doverle importare manualmente.

```php
// file.php

<?php
require_once __DIR__ . '/path/to/camezilla/camezilla.php';

use Camezilla\Loggers\Logger;

Logger::info("Hello, world!");
```

### 4.3 Configurazione

Il framework fornisce la possibilità di aggiungere configurazioni personalizzate al file `camezilla.config.json`. 
Per accedere a queste configurazioni all'interno della Web App, è possibile utilizzare la funzione `get_config()`.

```php
$config = get_config();
```

Per ottenere uno specifico valore di configurazione è possibile utilizzare l'istanza di classe `Config` restituita dalla funzione `get_config()`, tramite il metodo `get()`.

```php
$config = get_config();

$url = $config->get('url');
```

### 4.4 Logging

Il framework fornisce funzionalità di logging per la registrazione di messaggi di log all'interno di un file. Per utilizzare questa funzionalità, è necessario configurare il percorso del file di log nel file `camezilla.config.json`. Una volta configurato il percorso del file di log, è possibile utilizzare le funzioni di logging fornite dal framework per registrare i messaggi di log.

```php
log_debug("This is a debug message.");
log_info("This is an info message.");
log_warning("This is a warning message.");
log_error("This is an error message.");
```

Durante l'esecuzione è possibile modificare il path del file di log tramite la funzione `set_log_file()`.

```php
set_log_file("path/to/new/file.log");
```

### 4.5 Database

Il framework fornisce funzionalità di connessione al database. Per utilizzare questa funzionalità, è necessario configurare i parametri di connessione al database nel file `camezilla.config.json`. Una volta configurati i parametri di connessione al database, per accedere all'istanza del database è possibile utilizzare la funzione `get_database()`.

```php
$database = get_database();
```

Per collegare il database alla Web App, è necessario chiamare la funzione `connect_database()`, che si occuperà di collegare l'istanza del database e di gestire eventuali errori di connessione.

```php
connect_database();
```

Se la connessione al database fallisce, l'utente verrà reindirizzato alla pagina di errore configurata nel file `camezilla.config.json`.

### 4.6 Texts

#### 4.6.1 Configurazione dei texts

Un file di testi per essere valido dovrà essere un file `json` con la seguente struttura:

```json
{
    "text-id": {
        "language-code": "text"
    }
}
```

```json
{
    "welcome": {
        "en": "Welcome to Camezilla!",
        "it": "Benvenuto in Camezilla!"
    }
}
```

È possibile utilizzare testi con placeholder, che verranno sostituiti dinamicamente al momento dell'utilizzo del testo. Per utilizzare un placeholder, è necessario inserire il nome del placeholder tra parentesi graffe all'interno del testo.

```json
{
    "welcome-user": {
        "en": "Welcome, {username}!",
        "it": "Benvenuto, {username}!"
    }
}
```

#### 4.6.2 Utilizzo dei texts

Il framework fornisce funzionalità per la gestione di testi statici multilinguistici. Per utilizzare questa funzionalità, è necessario configurare i parametri dei texts nel file `camezilla.config.json`. Una volta configurati i parametri dei texts, per accedere a un testo è possibile utilizzare la funzione `t()`.

```php
echo t("welcome"); // Welcome to Camezilla!
```

Per specificare la lingua del testo da utilizzare, è possibile passare il codice ISO della lingua come parametro della funzione `t()`.

```php
echo t("welcome", [], "it"); // Benvenuto in Camezilla!
```

Per utilizzare i placeholder all'interno dei testi, è possibile passare un array associativo alla funzione `t()`, in cui le chiavi sono i nomi dei placeholder e i valori sono i valori da sostituire ai placeholder.

```php
echo t("welcome-user", ["username" => "John Doe"], "it"); // Benvenuto, John Doe!
```

#### 4.6.3 Utilizzo delle lingue

È possibile modificare la lingua di default da utilizzare per i testi tramite la funzione `set_language()`.

```php
set_language("it");

echo t("welcome"); // Benvenuto in Camezilla!
```

Il framework di default utilizza la lingua specificata nella configurazione dei texts.

### 4.7 Authentication

Il framework fornisce funzionalità di authentication per la gestione dell'autenticazione degli utenti. Per utilizzare questa funzionalità, è necessario configurare i parametri di authentication nel file `camezilla.config.json`. Una volta configurati i parametri di authentication, è possibile utilizzare le funzioni di authentication fornite dal framework per gestire l'autenticazione degli utenti.

#### 4.7.1 Autenticazione Web App server-side

Per proteggere una pagina della Web App server-side, è possibile utilizzare la funzione `require_user_authentication()`, che si occuperà di verificare se l'utente è autenticato e, in caso contrario, di reindirizzarlo alla pagina di login configurata nel file `camezilla.config.json`.

```php
require_user_authentication();

// Contenuto della pagina protetta
```

Per autenticare un utente, è possibile utilizzare la funzione `authenticate_user()`, che avvierà la sessione autenticata dell'utente.

```php
authenticate_user(67, "email");
```

Per rimovere l'autenticazione di un utente, è possibile utilizzare la funzione `remove_user_authentication()`, che terminerà la sessione autenticata dell'utente.

```php
remove_user_authentication();
```

Per verificare se un utente è autenticato, è possibile utilizzare la funzione `is_user_authenticated()`.

```php
if (is_user_authenticated()) {
    echo "User is authenticated.";
} else {
    echo "User is not authenticated.";
}
```

Per ottenere i dati dell'utente autenticato, è possibile utilizzare le funzioni `get_authenticated_user_id()` e `get_authenticated_email()`.

```php
$user_id = get_authenticated_user_id();
$user_email = get_authenticated_email();

echo "User ID: $user_id, Email: $user_email";
```

#### 4.7.2 Autenticazione API

Per proteggere un endpoint API, è possibile utilizzare la funzione `require_api_authentication()`, che si occuperà di verificare se l'utente è autenticato e, in caso contrario, di restituire una risposta di errore.

```php
require_api_authentication();

// Contenuto dell'endpoint API protetto
```

Per ottenere i dati dell'utente autenticato in un endpoint API, è possibile utilizzare la funzione `get_authenticated_api_user()`.

```php
$authenticated_user = get_authenticated_api_user();
```

Per generare un token di autenticazione con i dati dell'utente, è possibile utilizzare la funzione `generate_jwt()`.

```php
$token = generate_jwt(["id" => "user-id", "email" => "user-email"]);
```

### 4.8 Sicurezza

Il framework fornisce funzionalità basilari di sicurezza per la protezione della Web App da attacchi comuni.

#### 4.8.1 Protezione da attacchi XSS

Per proteggere la Web App da attacchi XSS, è possibile utilizzare la funzione `e()`, che si occuperà di eseguire l'escape dei caratteri speciali HTML all'interno di una stringa.

```php
$user_input = "<script>alert('XSS');</script>";

echo e($user_input); // &lt;script&gt;alert(&#039;XSS&#039;);&lt;/script&gt;
```

#### 4.8.2 Password hashing

Per proteggere le password degli utenti, è necessario utilizzare la funzione `hash_password()`, che si occuperà di eseguire l'hash della password utilizzando un algoritmo sicuro.

```php
$password = "my-password";
$hashed_password = hash_password($password);
```

Per verificare se una password corrisponde a un hash, è possibile utilizzare la funzione `verify_password()`, che si occuperà di verificare se la password corrisponde all'hash.

```php
$password = "my-password";
$hashed_password = hash_password($password);

if (verify_password($password, $hashed_password)) {
    echo "Password is valid.";
} else {
    echo "Password is invalid.";
}
```

### 4.9 Path

Il framework fornisce la funzione `current_url()` per ottenere l'URL del documento corrente.

```php
$current_url = current_url();
```

### 4.10 API

Il framework fornisce la funzione `api()` per ottenere l'URL di un endpoint API.

```php
$endpoint_url = api("endpoint.php", "path-to-action");
```

### 4.11 Actions

Il framework fornisce la funzione `action()` per ottenere l'URL di un'azione.

```php
$action_url = action("action.php", "path-to-action", "redirect.php");
```

Sono presenti anche funzioni per l'accesso, la scrittura e la gestione di messaggi di successo o errore restituiti dalle actions

```php
set_action_success("Action executed successfully.");
set_action_error("Error executing action.");

get_action_success(); // Action executed successfully.
get_action_error(); // Error executing action.

clear_action_success();
clear_action_error();
```

Nei metodi di `get` delle funzioni di gestione dei messaggi di successo o errore delle actions, è possibile specificare un parametro booleano per indicare se restituire il messaggio e cancellarlo, o restituirlo senza cancellarlo.

```php
set_action_success("Action executed successfully.");

echo get_action_success(true); // Action executed successfully.
echo get_action_success(); // null
```

### 4.12 Pages

Il framework fornisce la funzione `page()` per ottenere l'URL di una pagina. È possibile specificare come secondo parametro un array di parametri da aggiungere all'URL della pagina.

```php
$page_url = page("page.php", ["param1" => "value1", "param2" => "value2"]);
```

### 4.13 Resources
Il framework fornisce la funzione `resource()` per ottenere l'URL di una risorsa.

```php
$resource_url = resource("style.css");
```

## 5. Namespace del framework

### 5.1 `Camezilla\Components`

Contiene classi per la creazione di componenti riutilizzabili all'interno della Web App server-side.

#### 5.1.1 `Component`

Classe astratta per la creazione di componenti riutilizzabili all'interno della Web App server-side. Fornisce metodi per il rendering del componente e per la gestione dei dati del componente.
Contiene un metodo astratto `build()`, che deve essere implementato per definire la struttura HTML del componente.

```php
class MyComponent extends Component {

    private string $text;

    public function __construct($text) {
        parent::__construct();
        $this->text = $text;
    }

    protected function build() { ?>
        <div>
            <?= e($this->text); ?>
        </div>
    <?php }
}
```

Se si passa come parametro al costruttore un `children`, è possibile utilizzare il metodo `render_children()` all'interno del metodo `build()` per renderizzare i componenti figli.

```php
class ParentComponent extends Component {

    public function __construct($children) {
        parent::__construct($children);
    }

    protected function build() { ?>
        <div>
            <h1>Parent Component</h1>
            <?php $this->render_children(); ?>
        </div>
    <?php }
}
```

È possibile inoltre ridefinire metodi del ciclo di vita del componente.

```php
class MyComponent extends Component {

    protected function on_create() {
        // Codice da eseguire quando il componente viene creato
    }

    protected function on_before_render() {
        // Codice da eseguire prima del rendering del componente
    }

    protected function on_after_render() {
        // Codice da eseguire dopo il rendering del componente
    }
}
```

### 5.2 `Camezilla\Dispatchers`

#### 5.2.1 `Endpoint`

Modello rappresentante un endpoint API, con i suoi dati e metodi per la gestione dell'endpoint.

#### 5.2.2 `Dispatcher`

Classe per la gestione delle richieste HTTP e il dispatching delle richieste agli endpoint delle pagine Web App server-side. Contiene metodi per il dispatching delle richieste e per la gestione degli errori di dispatching.
È necessario creare un'istanza di `Dispatcher`, passando come parametro al costruttore il percorso della pagina di not found da utilizzare in caso di richiesta a un endpoint non definito. Successivamente, è possibile utilizzare i metodi `get()` e `post()` per definire gli endpoint delle pagine Web App server-side, specificando per ogni endpoint il nome dell'azione e una funzione di callback da eseguire quando viene ricevuta una richiesta per l'endpoint. Infine, è necessario chiamare il metodo `dispatch()` per avviare il dispatcher e gestire le richieste.

```php
$dispatcher = new Dispatcher('path/to/not-found.php');

$dispatcher->post('action-name', function($params) {
    // Codice da eseguire quando viene ricevuta una richiesta POST per l'azione "action-name"
});

$dispatcher->dispatch();
```

### 5.3 `Camezilla\Layouts`

#### 5.3.1 `Layout`

Classe astratta per la creazione di layout riutilizzabili all'interno della Web App server-side. Fornisce metodi per il rendering del layout e per la gestione dei dati del layout.
Il costruttore accetta come parametro un titolo, che può essere utilizzato all'interno del layout tramite la proprietà `title`. Contiene un metodo astratto `build()`, che deve essere implementato per definire la struttura HTML del layout.

```php
class MyLayout extends Layout {

    public function __construct($title) {
        parent::__construct($title);
    }

    protected function build() { ?>
        <html>
            <head>
                <title><?= e($this->title); ?></title>
            </head>
            <body>
                <?php $this->render_content(); ?>
            </body>
        </html>
    <?php }
}
```

### 5.4 `Camezilla\Loggers`

#### 5.4.1 `Logger`

Classe per la gestione del logging all'interno della Web App server-side. Contiene metodi per la registrazione di messaggi di log e per la gestione del file di log.
È necessario creare un'istanza di `Logger`, passando come parametro al costruttore il percorso del file di log da utilizzare per la registrazione dei messaggi di log. Successivamente, è possibile utilizzare i metodi `debug()`, `info()`, `warning()` e `error()` per registrare i messaggi di log con i rispettivi livelli di log.

```php
Logger::set_log_file('path/to/log-file.log');

Logger::debug("This is a debug message.");
Logger::info("This is an info message.");
Logger::warning("This is a warning message.");
Logger::error("This is an error message.");
```

> Nota: è preferibile utilizzare le funzioni di logging fornite dal framework invece di creare un'istanza di `Logger` direttamente, in quanto le funzioni di logging del framework gestiscono automaticamente il file di log configurato nel file `camezilla.config.json`.

```php
log_debug("This is a debug message.");
log_info("This is an info message.");
log_warning("This is a warning message.");
log_error("This is an error message.");
```

### 5.5 `Camezilla\Models`

#### 5.5.1 `Config`

Classe per la gestione della configurazione del framework. Contiene metodi per l'accesso ai valori di configurazione e per la gestione della configurazione.
È necessario creare un'istanza di `Config`, utilizzando il metodo statico `load()` passando il percorso del file di configurazione da utilizzare. Successivamente, è possibile utilizzare il metodo `get()` per ottenere i valori di configurazione.

> Nota: è preferibile utilizzare la funzione `get_config()` fornita dal framework invece di creare un'istanza di `Config` direttamente, in quanto la funzione `get_config()` gestisce automaticamente il file di configurazione configurato nel file `camezilla.config.json`.

```php
$config = Config::load('path/to/camezilla.config.json');

$url = $config->get('url');
```

#### 5.5.2 `Database`

Classe per la gestione della connessione al database all'interno della Web App server-side. Contiene metodi per la connessione al database e per l'esecuzione di query SQL.
È necessario creare un'istanza di `Database`, passando come parametro al costruttore i parametri di connessione al database. Successivamente, è possibile utilizzare il metodo `connect()` per collegare il database e il metodo `query()` per eseguire query SQL, o `prepare()` e `execute()` per eseguire query preparate.

> Nota: è preferibile utilizzare le funzioni `get_database()` e `connect_database()` fornite dal framework invece di creare un'istanza di `Database` direttamente, in quanto le funzioni del framework gestiscono automaticamente la connessione al database configurata nel file `camezilla.config.json`.

```php
$database = new Database('my-host', 'my-user', 'my-password', 'my-database');

$database->connect();

$result = $database->query("SELECT * FROM my_table");
```

### 5.6 `Camezilla\Pages`

#### 5.6.1 `Page`

Classe astratta per la creazione di pagine Web App server-side. Fornisce metodi per il rendering della pagina. Per definire la struttura HTML della pagina, si utilizza una funzione anonima passata al costruttore. Il costruttore necessita di un'istanza di `Layout` e un contenuto. Una volta definita, la pagina deve essere renderizzata tramite il metodo `render()`.

```php

$page = new class extends Page {

    public function __construct() {
        parent::__construct(new MyLayout('Title'), function() { ?>

            <h1>Hello, world!</h1>
            
        <?php });
    }
};

echo $page->render();
```

È possibile passare dati alla pagina tramite parametro nel costruttore, che saranno accessibili all'interno della pagina tramite la proprietà `data`.

> Nota: il parametro dei dati è passato nel costruttore come terzo parametro, dopo il layout e la funzione di callback per il contenuto della pagina.

```php
$data = "Hello World";

$page = new class($data) extends Page {
    public function __construct($data) {
        parent::__construct(new MyLayout('Title'), function($data) { ?>

            <h1><?= e($data) ?></h1>
            
        <?php }, $data);
    }
};

echo $page->render();
```

### 5.6 `Camezilla\Repositories`

#### 5.6.1 `Repository`

Classe astratta per la creazione di repository per eseguire operazioni sul database. Fornisce un attributo per l'accesso all'istanza del database e un costruttore che si occupa di collegare il database. Le classi che estendono `Repository` possono utilizzare l'attributo del database per eseguire query SQL e operazioni sul database.

```php
class MyRepository extends Repository {

    public function __construct() {
        parent::__construct();
    }

    public function get_data() {
        $result = $this->database->query("SELECT * FROM my_table");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

### 5.7 `Camezilla\Routers`

#### 5.7.1 `HttpResponse`

Classe statica per la gestione delle risposte HTTP, utilizzabile nelle API. Contiene metodi per l'invio di risposte HTTP con i rispettivi codici di stato.

```php
HttpResponse::ok("Success"); // 200 OK
HttpResponse::created("Created"); // 201 Created
HttpResponse::no_content(); // 204 No Content

HttpResponse::bad_request("Bad Request"); // 400 Bad Request
HttpResponse::unauthorized("Unauthorized"); // 401 Unauthorized
HttpResponse::forbidden("Forbidden"); // 403 Forbidden
HttpResponse::not_found("Not Found"); // 404 Not Found

HttpResponse::internal_server_error("Internal Server Error"); // 500 Internal Server Error
```

#### 5.7.2 `Endpoint`

Modello rappresentante un endpoint API, con i suoi dati e metodi per la gestione dell'endpoint.

#### 5.7.3 `Router`

Classe per la gestione delle richieste HTTP e il dispatching delle richieste agli endpoint delle API. Contiene metodi per il dispatching delle richieste e per la gestione degli errori di dispatching.
È necessario creare un'istanza di `Router`. Successivamente, è possibile utilizzare i metodi `get()` o `post()` per definire gli endpoint delle API, specificando per ogni endpoint il nome dell'azione e una funzione di callback da eseguire quando viene ricevuta una richiesta per l'endpoint. Infine, è necessario chiamare il metodo `dispatch()` per avviare il router e gestire le richieste.

```php
$router = new Router();

$router->post('action-name', function($params) {
    // Codice da eseguire quando viene ricevuta una richiesta POST per l'azione "action-name"
});

$router->dispatch();
```

### 5.8 `Camezilla\Services`

#### 5.8.1 `Service`

Classe astratta per la creazione di servizi. Ancora priva di funzionalità specifiche, è possibile estendere questa classe per creare servizi con funzionalità personalizzate.

```php
class MyService extends Service {

    public function do_something() {
        // Codice per eseguire un'operazione specifica del servizio
    }
}
```

## 6. Flussi di lavoro consigliati

### 6.1 Creazione e utilizzo di un componente riutilizzabile

1. Creare un componente estendendo la classe `Component` e definendo la struttura HTML del componente all'interno del metodo `build()`.

    ```php
    class MyComponent extends Component {

        private string $text;

        public function __construct($text) {
            parent::__construct();
            $this->text = $text;
        }

        protected function build() { ?>
            <div>
                <?= e($this->text); ?>
            </div>
        <?php }
    }
    ```

2. Utilizzare il componente all'interno di una pagina o di un altro componente, passando i dati necessari al costruttore del componente.

    ```php
    <div>
        <?= new MyComponent("Hello, world!"); ?>
    </div>
    ```

### 6.2 Creazione di una pagina Web App server-side

1. Creare un layout estendendo la classe `Layout` e definendo la struttura HTML del layout all'interno del metodo `build()`.

    ```php
    class MyLayout extends Layout {

        public function __construct($title) {
            parent::__construct($title);
        }

        protected function build() { ?>
            <html>
                <head>
                    <title><?= e($this->title); ?></title>
                </head>
                <body>
                    <?php $this->render_content(); ?>
                </body>
            </html>
        <?php }
    }
    ```

2. Creare un file PHP all'interno della cartella delle pagine configurata nel file `camezilla.config.json` e definire una classe che estende la classe `Page` (si consiglia una classe anonima). Nel costruttore della classe, passare un'istanza del layout creato al punto 1 e una funzione di callback che definisce il contenuto della pagina. Infine, chiamare il metodo `render()` per renderizzare la pagina.

    ```php
    // path/to/pages/my-page.php

    $page = new class extends Page {
        public function __construct() {
            parent::__construct(new MyLayout('My Page'), function() { ?>

                <h1>My Page</h1>
                
            <?php });
        }
    };

    echo $page->render();
    ```

> Nota: In caso la pagina necessiti l'utilizzo di servizi, sarà necessario istanziarli all'interno del costruttore.
> 
> ```php
> // path/to/pages/my-page.php
> 
> $page = new class extends Page {
>     public function __construct() {
>         $service = new MyService();
>         
>         parent::__construct(new MyLayout('My Page'), function() use ($service) { ?>
> 
>             <h1>My Page</h1>
>             <?= e($service->do_something()); ?>
>             
>         <?php });
>     }
> };
> 
> echo $page->render();
> ```

### 6.3 Creazione di un servizio collegato al database

1. Creo una classe rappresentante il modello dei dati con cui il servizio dovrà interagire, con i relativi attributi e metodi.

    ```php
    class Model {
        private int $id;
        private string $name;
        private string $description;

        public function __construct($id, $name, $description) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
        }

        public function get_id() {
            return $this->id;
        }

        public function get_name() {
            return $this->name;
        }

        public function get_description() {
            return $this->description;
        }
    }
    ```

2. Creo una classe che estende `Repository` e che implementa i metodi che eseguono le interrogazioni al database, e in caso sia presente ne restituiscono l'output.

    ```php
    class ModelRepository extends Repository {

        public function add_model(Model $model): bool {
            return $this->database->prepare("INSERT INTO my_table (id, name, description) VALUES (:id, :name, :description)")
                ->execute([
                    ':id' => $model->get_id(),
                    ':name' => $model->get_name(),
                    ':description' => $model->get_description(),
                ]);
        }

        public function get_all_models(): array {
            $stmt = $this->database->query("SELECT * FROM my_table");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    ```

3. Creo una classe che estende `Service` e che utilizza la classe del repository per eseguire le operazioni necessarie.

    ```php
    class ModelService extends Service {

        private ModelRepository $repository;

        public function __construct() {
            $this->repository = new ModelRepository();
        }

        public function add_model(Model $model): bool {
            return $this->repository->add_model($model);
        }

        public function get_all_models(): array {
            return $this->repository->get_all_models();
        }
    }
    ```

### 6.4 Creazione e utilizzo di una action Web App server-side

1. Creare un file PHP all'interno della cartella delle actions configurata nel file `camezilla.config.json`. 

2. All'interno di questo file, creare un'istanza della classe `Dispatcher`, passando il percorso della pagina di not found da utilizzare in caso di richiesta a un endpoint non definito.

3. Utilizzare i metodi `get()` o `post()` del dispatcher per definire un endpoint, specificando per ogni endpoint il nome dell'azione e una funzione di callback da eseguire quando viene ricevuta una richiesta per l'endpoint.

4. Chiamare il metodo `dispatch()` per avviare il dispatcher e gestire le richieste.

> Importante: utilizzare i metodi statici `Dispatcher::ok_redirect()` o `Dispatcher::error_go_back()` per reindirizzare l'utente e generare eventuali errori finita l'esecuzione dell'action, in caso di esito positivo o negativo dell'esecuzione.

```php
// path/to/actions/model.php

$dispatcher = new Dispatcher('path/to/not-found.php', 'path/to/error.php');
$service = new ModelService();

$dispatcher->post('add-model', function($params) use ($service) {
    $model = new Model($params['id'], $params['name'], $params['description']);
    
    if ($service->add_model($model)) {
        Dispatcher::ok_redirect('Model added successfully');
    } else {
        Dispatcher::error_go_back('Error adding model');
    }
});

$dispatcher->dispatch();
```

> Nota: nella pagina di richiesta e di destinazione, consentire all'utente di visualizzare i messaggi di successo o di errore restituiti dall'action tramite le funzioni `get_action_success()` e `get_action_error()`.

Ora la action può essere utilizzata come destinazione di un form all'interno di una pagina Web App server-side.

> Nota: è necessario utilizzare la funzione `action()` per ottenere l'URL della action da utilizzare come destinazione del form, passando come parametri il nome del file PHP dell'action, la cartella in cui si trova e il file PHP a cui reinderizzare finita l'esecuzione.

```php
<form action="<?= action('model.php', 'path', 'redirect.php') ?>" method="POST">
    <input type="text" name="id" placeholder="Id">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Add Model</button>
</form>
```

### 6.5 Creazione e utilizzo di un endpoint API

1. Creare un file PHP all'interno della cartella delle API configurata nel file `camezilla.config.json`.

2. All'interno di questo file, creare un'istanza della classe `Router`.

3. Utilizzare i metodi `get()` o `post()` del router per definire un endpoint, specificando per ogni endpoint il nome dell'azione e una funzione di callback da eseguire quando viene ricevuta una richiesta per l'endpoint.

4. Chiamare il metodo `dispatch()` per avviare il router e gestire le richieste.

```php
// path/to/api/model.php

$router = new Router();
$service = new ModelService();

$router->post('add-model', function($params) use ($service) {
    $model = new Model($params['id'], $params['name'], $params['description']);
    if ($service->add_model($model)) {
        HttpResponse::created("Model added successfully");
    } else {
        HttpResponse::internal_server_error("Failed to add model");
    }
});

$router->get('get-all-models', function($params) use ($service) {
    $models = $service->get_all_models();
    HttpResponse::ok(json_encode($models));
});

$router->dispatch();
```

Ora l'API può essere utilizzata per eseguire richieste HTTP agli endpoint definiti.

```bash
curl -X POST -d "id=1&name=Model1&description=Description1" http://mydomain.com/path/to/api/model.php?path=add-model
```




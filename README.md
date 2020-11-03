# API REST - LARAVEL 8
This is an API REST made with laravel 8.0, passport and l5 repository.
The laravel Framework give us an elegant and organized way to write codes else we use the passaport tool to get an secure and smart authentication. For the last is the l5 repository that automate a lot of important tasks as create in a only command a complete CRUD with wondeful possibilities like filter your queries by passing parameter from requests.

## INSTALLING
We can use this api in few moments going through some steps.
1. Clone or download this repository to your project folder.
1. Run **composer install** on root of this project.
1. Setup your **.env** file (check db setup).
1. Run **php artisan init:project** on your terminal and follow the steps to create your first user.

That`s ready to use!!

## USING

##### REQUEST TOKEN
To get the token auth we need to send a post to your-api-addr/api/token posting in your form data the user data.
The form-data parameters are:
POST http://your-api-addr/api/token

        email: "useremail@domain.com"
        password: "userpassword"

That`s return the token to make your api requests
See the image:
![Example for token request](http://conectes.com.br/api_laravel_docs/posttokenex.png "Example for token request").

------------


##### CREATE YOUR FIRST CRUD
Now that you have the token lets create the first CRUD.
1. Run **php artisan make:entity name-of-entity** and follow the steps
You have now created your chosen features and can now take advantage of them.
1. Go to database/migrations folder and find the created migrations. Edit it with giving the names and types for tables.
See this exemple:


     public function up()
        {
            Schema::create('flights', function (Blueprint $table) {
                $table->id();
                $table->string('user_name');
                $table->string('user_email');
                $table->timestamps();
            });
        }
1. Run **php artisan migrate**

Now the artisan created your table and fields.

##### REQUEST ENTITY
When you runned the **make:entity** command you saw that created Controller, Model(Entities Folder), Resquest(Http/Resquests folder) and other files that respect the name you choiced for that. 
##### PREPARE THE REQUEST CLASS
Maybe you`ll need to open on Request folder the files created and change the returned parameters on authorize method  to true as exemple:
Old:


     public function authorize()
        {
            return false;
        }

New:


     public function authorize()
        {
            return true;
        }

##### PREPARE ROUTE
On routes/api.php file, create inside the middleware function your api routes.


    Route::middleware('auth:api')->group(function(){
        Route::resources([
            'user' => UserController::class,
            'testes' => EmersonTestesController::class,
        ]);
    });
You can see more about that here:
https://laravel.com/docs/8.x/routing

Now you can send you requests for defined controllers.
Just for clarify. Inside your created controller you will see the methods:
1. **index** (GET).
1. **store** (POST)
1. **show** (GET) - use  endpoint/{id}
1. **edit** (GET) - use endpoint/{id}/edit
1. **update** (PUT/PATCH) - use endpoint/{id}
1. **destroy** (DELETE) - use endpoint/{id}

##### HEADER REQUEST EXAMPLE
![Header Example](http://conectes.com.br/api_laravel_docs/requestheader.png)
### OTHER DOCS
1. https://github.com/andersao/l5-repository/tree/2.0.14
1. https://laravel.com/docs/8.x

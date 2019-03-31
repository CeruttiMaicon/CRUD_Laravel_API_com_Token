<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Propósito do Projeto

O Laravel é um framework de aplicação web com sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente gratificante. Contudo vou desenvolver com este projeto um CRUD simples para mostrar como funciona uma API com o Laravel utilizando dos tokens forneceidos pelo próprio framework para garantir a segurança dos usuarios que o estão fazendo.


## Fazendo o CRUD de cadastro do usuario para realizar Login no sistema.

Primeiramente precisamos do Laravel Passport instalado no nosso projeto.

    composer require laravel/passport

Depois de instalar o pacote com sucesso, abra o arquivo config/app.php e adicione o provedor de serviços as seguintes linhas de código.

<b>config/app.php</b>

    'providers' =>[
        Laravel\Passport\PassportServiceProvider::class,
    ],

Depois que o provedor de serviços Passport se registra, é necessário executar o comando de migração , após executar o comando de migração, você obterá várias novas tabelas no banco de dados. Então, vamos rodar abaixo do comando:

    php artisan migrate

Em seguida, precisamos instalar um passaporte(chave de autenticação) ele criará chaves de token para a segurança da aplicação. Usando o comando:

    php artisan passport:install
 
 Nesta etapa, temos que fazer a configuração no modelo de três locais, no provedor de serviços e no arquivo de configuração de autenticação. Então você tem que apenas seguir a mudança nesse arquivo.

No model de User adicionamos a chamada de:

<b>app/User.php</b>

    use Laravel\Passport\HasApiTokens;

No arquivo do AuthServiceProvider adicionamos o seguinte:
    
    Passport::routes();

Em auth.php, adicionamos a configuração de autenticação da API.

Os arquivos ficaram da seguinte maneira.

<b>app/User.php</b>

    <?php
    namespace App;
    use Laravel\Passport\HasApiTokens;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    class User extends Authenticatable
    {
    use HasApiTokens, Notifiable;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'name', 'email', 'password',
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    'password', 'remember_token',
    ];
    }

<b>app/Providers/AuthServiceProvider.php</b>

    <?php
    namespace App\Providers;
    use Laravel\Passport\Passport; 
    use Illuminate\Support\Facades\Gate; 
    use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
    class AuthServiceProvider extends ServiceProvider 
    { 
        /** 
        * The policy mappings for the application. 
        * 
        * @var array 
        */ 
        protected $policies = [ 
            'App\Model' => 'App\Policies\ModelPolicy', 
        ];
    /** 
        * Register any authentication / authorization services. 
        * 
        * @return void 
        */ 
        public function boot() 
        { 
            $this->registerPolicies(); 
            Passport::routes(); 
        } 
    }

<b>config/auth.php</b>

    <?php
    return [
    'guards' => [ 
            'web' => [ 
                'driver' => 'session', 
                'provider' => 'users', 
            ], 
            'api' => [ 
                'driver' => 'passport', 
                'provider' => 'users', 
            ], 
        ],

Agora criaremos rotas de API. O Laravel fornece o arquivo api.php para a rota de serviços da Web de gravação. Então, vamos adicionar uma nova rota nesse arquivo.

<b>routes/api.php</b>

    <?php
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('details', 'API\UserController@details');
    });

Na última etapa, temos que criar um novo controlador e três métodos de API. Primeiro, crie um novo diretório “API” na pasta Controllers. Então, vamos criar o UserController e colocar o código abaixo:

    <?php
    namespace App\Http\Controllers\API;
    use Illuminate\Http\Request; 
    use App\Http\Controllers\Controller; 
    use App\User; 
    use Illuminate\Support\Facades\Auth; 
    use Validator;
    class UserController extends Controller 
    {
    public $successStatus = 200;
      /** 
        * login api 
        * 
        * @return \Illuminate\Http\Response 
        */ 
        public function login(){ 
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                return response()->json(['success' => $success], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
        }
      /** 
        * Register api 
        * 
        * @return \Illuminate\Http\Response 
        */ 
        public function register(Request $request) 
        { 
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'email' => 'required|email', 
                'password' => 'required', 
                'c_password' => 'required|same:password', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
            $input = $request->all(); 
            $input['password'] = bcrypt($input['password']); 
            $user = User::create($input); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            return response()->json(['success'=>$success], $this-> successStatus); 
        }
      /** 
        * details api 
        * 
        * @return \Illuminate\Http\Response 
        */ 
        
        public function details() 
        { 
            $user = Auth::user(); 
            return response()->json(['success' => $user], $this-> successStatus); 
        } 
    }

Agora estamos prontos para rodar nosso exemplo, então corra abaixo do comando para executar rapidamente:

    php artisan serve
## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

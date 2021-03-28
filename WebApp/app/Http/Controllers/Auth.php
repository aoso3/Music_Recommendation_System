<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class Auth extends BaseController
{
    private $username = "elastic";
    private $password = "changeme";

    public function index(){

    }

    public function register(Request $request)
    {
        $hosts = ["$this->username:$this->password@localhost:9200"];
        $caBundle = \Kdyby\CurlCaBundle\CertificateHelper::getCaInfoFile();

        $email = Input::get('user_email');
        $password =  Input::get('user_password');
        $encrypted_password =  bcrypt($password);


        try {
            $client = ClientBuilder::create()
                ->setHosts($hosts)
                ->setSSLVerification($caBundle)
                ->build();

            $params0 = [
                'index' => 'users',
                'type' => 'my_type',
                'body' => [
                    'query' => [
                        'match_phrase' => [
                            'email' => $email
                        ]
                    ],
                ],
                'client' => [ 'ignore' => [400, 404]  ]
            ];
            $founded_email = $client->search($params0)['hits']['hits']['0']['_source']['email'];

            return ("error");


        } catch (\Exception $e) {
            
            $params = [
                'index' => 'users',
                'type' => 'my_type',
                'body' => [
                    'email'   => $email,
                    'password'   => $encrypted_password,
                ]
            ];


            $id = $client->index($params)['_id'];

            $request->session()->set('id' , $id);
            $request->session()->set('email' , $email);
            $request->session()->set('password' , $encrypted_password);
            $request->session()->set('logged_in' , '1');
            session()->save();
            return ("worked");

        }

    }

    public function login(Request $request)
    {
        $hosts = ["$this->username:$this->password@localhost:9200"];
        $caBundle = \Kdyby\CurlCaBundle\CertificateHelper::getCaInfoFile();

        $email = Input::get('user_email');
        $password =  Input::get('user_password');
        $encrypted_password =  bcrypt($password);

        try {
            $client = ClientBuilder::create()
                ->setHosts($hosts)
                ->setSSLVerification($caBundle)
                ->build();

            $params0 = [
                'index' => 'users',
                'type' => 'my_type',
                'body' => [
                    'query' => [
                        'match_phrase' => [
                            'email' => $email,
                        ]
                    ],
                ],
                'client' => [ 'ignore' => [400, 404]  ]
            ];
            $response = $client->search($params0)['hits']['hits']['0'];
            $id = $response['_id'];
            $user = $response['_source'];

            if($email == $user['email'] && Hash::check($password, $user['password'])) {
                $request->session()->set('id' , $id);
                $request->session()->set('email' , $email);
                $request->session()->set('password' , $encrypted_password);
                $request->session()->set('logged_in' , '1');
                session()->save();
                return ("worked");
            }
            else{
                return ("error");
            }

        } catch (\Exception $e) {

        }

    }

    public function logout(Request $request)
    {
        try {
            $request->session()->flush();
            session()->save();
            return 1;
        }
        catch (\Exception $e){
    }
    }



}

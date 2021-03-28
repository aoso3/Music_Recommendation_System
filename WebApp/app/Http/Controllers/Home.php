<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Input;


class Home extends BaseController
{
    private $username = "elastic";
    private $password = "changeme";

    public function index()
    {

        return view('home',compact('response'));
    }

    public function search(Request $request){
        $search_text =  Input::get('search_text');

        $hosts = ["$this->username:$this->password@localhost:9200"];

        $caBundle = \Kdyby\CurlCaBundle\CertificateHelper::getCaInfoFile();

        try{
            $client = ClientBuilder::create()
                ->setHosts($hosts)
                ->setSSLVerification($caBundle)
                ->build();

                $params = [
                    'index' => 'clusters_music',
                    'type' => 'my_type',
                    'body' => [
                        'query' => [
                            'match_phrase' => [
                                'song' => $search_text
                            ]
                        ],
                    ],
                    'client' => [ 'ignore' => [400, 404]  ]
                ];

                $song = $client->search($params)['hits']['hits']['0'];
                $params2 = [
                    "from" => 0,
                    "size" => 25,
                    'index' => 'clusters_music',
                    'type' => 'my_type',
                    'body' => [
                        'query' => [
                            'bool' => [
                                'must' => [
                            'match_phrase' => [
                                'cluster' => $song['_source']['cluster']
                            ]
                            ],
                                    ]

                        ],

                        "sort" => [
                            "_geo_distance" => [
                                "location" =>[
                                    "lat"=> $song['_source']['location']['lat'],
                                    "lon"=> $song['_source']['location']['lon']
                                ],
                                "order" => "asc",
                            ]

                        ]

                    ],

                    'client' => [ 'ignore' => [400, 404]  ]
                ];


            $response1 = $client->search($params2)['hits']['hits'];

            $id = $client->search($params)['hits']['hits']['0']['_id'];
            $params3 = [
                "from" => 0,
                "size" => 25,
                'index' => 'recommendations',
                'type' => 'recommendations',
                'body' => [
                        'query' => [
                            'match_phrase' => [
                                'index1' => $id
                            ]
                        ],

                    "sort" => [
                        "likehood" => [
                            "order" => "desc",
                        ]

                    ]

                ],

                'client' => [ 'ignore' => [400, 404]  ]
            ];

            $response2 = $client->search($params3)['hits']['hits'];

            $searched_song['id'] = $song['_id'];
            $searched_song['song'] = $song['_source']['song'];
            $searched_song['x'] = $song['_source']['location']['lat'];
            $searched_song['y'] = $song['_source']['location']['lon'];

            $good_response = array($searched_song);
            $bad_response = array();
            $count = 0;
            if(! empty($response2))
            foreach ($response2 as $re2){
                if(sizeof($good_response) < 20) {
                    if( $re2['_source']['likehood'] > 1000) {
                        $temp0['id'] = $re2['_source']['index2'];
                        $temp0['song'] = $re2['_source']['song'];
                        $temp0['x'] = $re2['_source']['location']['lat'];
                        $temp0['y'] = $re2['_source']['location']['lon'];
                        $count++;
                        if ($re2['_source']['likehood'] > -100) {
                            foreach ($good_response as $element) {
                                if (abs($temp0['x'] - $element['x']) < 15)
                                    $temp0['x'] += rand(-15, 15);
                                if (abs($temp0['y'] - $element['y']) < 15)
                                    $temp0['y'] += rand(-15, 15);
                            }
                            array_push($good_response, $temp0);
                            $count++;
                        } else if ($re2['_source']['likehood'] <= -100) {
                            foreach ($good_response as $element) {
                                if (abs($temp0['x'] - $element['x']) < 15)
                                    $temp0['x'] += rand(-15, 15);
                                if (abs($temp0['y'] - $element['y']) < 15)
                                    $temp0['y'] += rand(-15, 15);
                            }
                            array_push($bad_response, $temp0);
                        }
                    }
                }
                else
                    break;
            }


            foreach ($response1 as $re1){
                if(sizeof($good_response) < 20) {
                    $temp1['id'] = $re1['_id'];
                    $temp1['song'] = $re1['_source']['song'];
                    $temp1['x'] = $re1['_source']['location']['lat'];
                    $temp1['y'] = $re1['_source']['location']['lon'];

                    if(!empty($bad_response)) {
                        $good_to_go = true;
                        foreach ($bad_response as $bad) {
                            if ($bad['id'] == $re1['_id'] || $re1['_source']['song'] == $song['_source']['song']) {
                                $good_to_go = false;
                            }

                        }
                        if ($good_to_go) {
                            foreach ($good_response as $element){
                                if(abs($temp1['x'] - $element['x']) < 15)
                                    $temp1['x'] += rand(-15,15);
                                if(abs($temp1['y'] - $element['y']) < 15)
                                    $temp1['y'] += rand(-15,15);
                            }
                            array_push($good_response, $temp1);
                            $count++;
                        }
                    }
                    else {
                        $good_to_go = true;
                        foreach ($good_response as $good) {
                            if ($good['id'] == $re1['_id'] || $re1['_source']['song'] == $song['_source']['song']) {
                                $good_to_go = false;
                            }

                        }
                        if ($good_to_go) {
                            foreach ($good_response as $element){
                                if(abs($temp1['x'] - $element['x']) < 15)
                                    $temp1['x'] += rand(-15,15);
                                if(abs($temp1['y'] - $element['y']) < 15)
                                    $temp1['y'] += rand(-15,15);
                            }
                            array_push($good_response, $temp1);
                            $count++;
                        }

                    }

                }
                else
                    break;
            }

            $id =   $request->session()->get('id');


                $params_endorses = [
                    'index' => 'user_endorse',
                    'type' => 'my_type',
                    'body' => [
                        'query' => [
                            'match_phrase' => [
                                'user_id' => $id
                            ]
                        ],
                    ],
                    'client' => [ 'ignore' => [400, 404]  ]
                ];


                $response_endorses = $client->search($params_endorses)['hits']['hits'];


            return view('results',compact('good_response','response_endorses'));

        } catch (\Exception $e) {

        }

    }


}

<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/30
 * Time: 18:11
 * When you read this code, good luck for you.
 */

namespace Application\Web\Rest;

use Application\Web\{Response, Request, Received};

class Server
{
    protected $api;

    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }


    public function listen()
    {
        $request = new Request();
        $response = new Response($request);
        $getPost = $_REQUEST ?? array();
        $jsonData = json_decode(file_get_contents('php://input'), true);
        $jsonData = $jsonData ?? [];
        $request->setData(array_merge($getPost, $jsonData));
        $id = $request->getData()[$this->api::ID_FIELD] ?? null;
        switch (strtoupper($request->getMethod())) {
            case Request::METHOD_POST:
                $this->api->post($request, $response);
                break;

            case Request::METHOD_PUT:
                $this->api->put($request, $response);
                break;
            case Request::METHOD_DELETE:
                $this->api->delete($request, $response);
                break;
            case Request::METHOD_GET:
            default:
                $this->api->get($request, $response);
                break;
        }
        $this->processResponse($response);
        echo json_encode($response->getData());

    }

    public function processResponse(Response $response)
    {
        if ($response->getHeaders()) {
            foreach ($response->getHeaders() as $key => $value) {
                header($key.':'.$value,true,$response->getStatus());
            }
        }
        header(Request::HEADER_CONTENT_TYPE.':'.Request::CONTENT_TYPE_JSON,true);
        if ($response->getCookies()){
            foreach ($response->getCookies() as $key=>$val){
                setcookie($key,$val);
            }
        }
    }

}

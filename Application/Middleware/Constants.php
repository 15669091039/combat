<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/4
 * Time: 18:20
 * When you read this code, good luck for you.
 */

namespace Application\Middleware;


class Constants
{
    const HEADER_HOST = 'host'; // 主机报头
    const HEADER_CONTENT_TYPE ='Content_Type';
    const HEADER_CONTENT_LENGTH = 'Content-Length';
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const METHOD_DELETE = 'delete';
    const HTTP_METHODS = ['get','put','post','delete'];
    const STANDARD_PORTS = ['ftp'=>21,'ssh'=>22,'http'=>80,'https'=>443];
    const CONTENT_TYPE_FORM_ENCODED='application/x-www-form-urlencoded';
    const CONTENT_TYPE_MULTI_FORM ='multipart/form-data';
    const CONTENT_TYPE_JSON='application/json';
    const CONTENT_TYPE_HAL_JSON='application/hal+json';
    const DEFAULT_STATUS_CODE =200;
    const DEFAULT_BODY_STREAM='php://input';
    const DEFAULT_REQUEST_TARGET='/';
    const MODE_READ='r';
    const MODE_WRITE='w';
    const ERROR_BAD='ERROR:';
    const ERROR_UNKNOWN='ERROR: UNKNOWN';
    const STATUS_CODES=[
        200=>'OK',
        301=>'Moved Permanently',
        302=>'Found',
        401=>'Unauthorized',
        404=>'Not Found',
        405=>'Method Not Allow',
        418=>'I_m A Teapot',
        500=>'Internal Server Error'
    ];




}

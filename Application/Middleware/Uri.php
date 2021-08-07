<?php
/**
 * Create by ZhangShuo
 * Date: 2021/8/4
 * Time: 18:37
 * When you read this code, good luck for you.
 */

namespace Application\Middleware;

use InvalidArgumentException;
use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{

    protected $uriString;
    protected $uriParts = array();
    protected $queryParams;

    public function __construct($uriString=null)
    {
        $this->uriParts = parse_url($uriString);
        if (!$this->uriParts) {
            throw new InvalidArgumentException(Constants::ERROR_UNKNOWN);
        }
        $this->uriString = $uriString;
    }

    public function getScheme(): string
    {
        return strtolower($this->uriParts['scheme']) ?? '';
    }

    public function getAuthority(): string
    {
        $val = '';
        if (!empty($this->getUserInfo()))
            $val .= $this->getUserInfo() . '@';
        $val .= $this->uriParts['host'] ?? '';
        if (!empty($this->uriParts['port'])) {
            $val .= ':' . $this->uriParts['port'];
        }
        return $val;
    }

    public function getUserInfo()
    {
        if (empty($this->uriParts['user'])) {
            return '';
        }
        $val = $this->uriParts['user'];
        if (!empty($this->uriParts['pass'])) {
            $val .= ':' . $this->uriParts['pass'];
        }
        return $val;

    }

    public function getHost()
    {
        if (empty($this->uriParts['host'])) {
            return '';
        }
        return strtolower($this->uriParts['host']);
    }

    public function getPort()
    {
        if (empty($this->uriParts['port'])) {
            return null;
        } else {
            if ($this->getScheme()) {
                if ($this->uriParts['port'] == Constants::STANDARD_PORTS[$this->getScheme()]) {
                    return null;
                }
            }
            return (int)$this->uriParts['host'];
        }
    }

    public function getPath()
    {
        if (empty($this->uriParts['path'])) {
            return '';
        }
        return implode('/', array_map('rawurlencode', explode('/', $this->uriParts['path'])));
    }

    public function getQueryParams($reset = false)
    {
        if ($this->queryParams && !$reset) {
            return $this->queryParams;
        }
        $this->queryParams = [];
        if (!empty($this->uriParts['query'])) {
            foreach (explode('&', $this->uriParts['query']) as $keyPair) {
                list($param, $value) = explode('=', $keyPair);
                $this->queryParams[$param] = $value;
            }
        }
        return $this->queryParams;
    }

    public function getQuery()
    {
        if (!$this->getQueryParams()) {
            return '';
        }
        $output = '';
        foreach ($this->getQueryParams() as $key => $value) {
            $output .= rawurldecode($key) . '=' . rawurlencode($value) . '&';
        }
        return substr($output, 0, -1);
    }

    public function getFragment()
    {
        if (empty($this->uriParts['fragment'])) {
            return '';
        }
        return rawurlencode($this->uriParts['fragment']);
    }

    public function withScheme($scheme)
    {
        if (empty($scheme) && $this->getScheme()) {
            unset($this->uriParts['scheme']);
        } else {

            if (isset(Constants::STANDARD_PORTS[strtolower($scheme)])) {
                $this->uriParts['scheme'] = $scheme;
            } else {
                throw  new InvalidArgumentException(Constants::ERROR_BAD . __METHOD__);
            }
        }
        return $this;
    }

    public function withUserInfo($user, $password = null)
    {
        if (empty($user) && $this->getUserInfo()) {
            unset($this->uriParts['user']);
        } else {
            $this->uriParts['user'] = $user;
            if (!empty($password)) {
                $this->uriParts['pass'] = $password;
            }
        }
        return $this;
    }

    public function withHost($host)
    {
        if (empty($host) && $this->getHost()) {
            unset($this->uriParts['host']);
        } else {
            if (!empty($host)) $this->uriParts['host'] = $host;
        }
        return $this;
    }

    public function withPort($port)
    {
        if (empty($port) && $this->getPort()) {
            unset($this->uriParts['port']);
        } else {
            if (!empty($port)) $this->uriParts['port'] = $port;
        }
        return $this;
    }

    public function withPath($path)
    {
        if (empty($path) && $this->getPath()) {
            unset($this->uriParts['path']);
        } else {
            if (!empty($path)) $this->uriParts['path'] = $path;
        }
        return $this;
    }

    public function withFragment($fragment)
    {
        if (empty($fragment) && $this->getFragment()) {
            unset($this->uriParts['fragment']);
        }
        if (!empty($fragment)) {
            $this->uriParts['fragment'] = $fragment;
        }
        return $this;
    }

    public function withQuery($query)
    {
        if (empty($query) && $this->getQuery()) {
            unset($this->uriParts['query']);
        } else {
            $this->uriParts['query'] = $query;
        }
        $this->getQueryParams(true);
        return $this;
    }

    public function __toString()
    {
        $uri = ($this->getScheme()) ? $this->getScheme() . '//' : '';
        $path = $this->getPath();
        if ($path) {
            if ($path[0] != '/') {
                $uri .= '/' . $path;
            } else {
                $uri .= $path;
            }

        }
        $uri .= ($this->getQuery()) ? '?' . $this->getQuery() : ' ';
        $uri .= ($this->getFragment()) ? '#' . $this->getFragment() : '';
        return $uri;
    }
    public function getUriString()
    {
        return $this->__toString();
    }



}

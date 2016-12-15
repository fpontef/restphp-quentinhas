<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if( ! $this->isCorsPath($request) )
        {
            return $response; 
        }

        if ( $this->isPreflightRequest($request) )
        {
            return $this->buildResponse();
        }

        return $this->addHeaders($response);        
    }

    /**
     * Create a 'Preflight' response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function buildResponse()
    {
        $response = new Response('', 204);

        return $this->addHeaders($response, true );
    }

    /**
     * Add the cors/preflight header information to the given response.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @param  boolean  $preflight
     * @return \Illuminate\Http\Response
     */
    protected function addHeaders(Response $response, $preflight = false)
    {

        $headers = [
            'Access-Control-Allow-Origin' => '*',
            // server side credencial support eg. cookies
            //'Access-Control-Allow-Credentials' => 'true' 
        ];

        if ( $preflight )
        {
            $headers['Access-Control-Allow-Headers'] = 'Content-Type, Authorization';
            $headers['Access-Control-Allow-Methods'] = 'GET, POST, PUT, PATCH, DELETE, OPTIONS';
        }

        $response->headers->add($headers);

        return $response;
    }

    /**
     * Check for a CorsPath request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function isCorsPath($request)
    {
        return $request->segment(1) == 'api';
    }

    /**
     * Check for a Preflight request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function isPreflightRequest($request)
    { 
        return  $request->isMethod('OPTIONS') && 
                $request->hasHeader('Access-Control-Request-Method') && 
                $request->hasHeader('Origin');
    }
}
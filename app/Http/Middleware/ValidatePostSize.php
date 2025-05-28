<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize as BaseValidatePostSize;

class ValidatePostSize extends BaseValidatePostSize
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
        // Define o limite fixo de 50MB em bytes
        $max = 50 * 1024 * 1024; // 50MB em bytes

        if ($request->server('CONTENT_LENGTH') > $max) {
            throw new PostTooLargeException('O tamanho do POST excede o limite de 50MB.');
        }

        return $next($request);
    }

    /**
     * Determine the server 'post_max_size' as bytes.
     *
     * @return int
     */
    protected function getPostMaxSize()
    {
        // Retorna 50MB em bytes
        return 50 * 1024 * 1024;
    }
} 
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerApiResponseMacro();
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Creates a Response macro for API json responses having a standard format;
     */
    public function registerApiResponseMacro(): void
    {
        Response::macro('api', function (string $message = '', $data = [], $status = true, $code = 200, $errors = [], array $headers = []) {
            $body = [
                'status'  => $status,
                'message' => $message,
                'data'    => $data,
                'errors'  => $errors,
            ];
            if ($data == [] && $status == false) unset($body['data']);
            if ($errors == []) unset($body['errors']);

            return response()->json($body, $code, $headers);
        });
    }
}

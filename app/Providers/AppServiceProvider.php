<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('correctapi', function($attribute, $value, $parameters, $validator) {
            $json = call_API($value,'profile');
            var_dump($json);
            if (isset($json['error_code'])){
                $validator->addReplacer('correctapi',  function ($message, $attribute, $rule, $parameters) use ($json) {
                    return str_replace([':error'], [$json['error_message']], $message);
                });
                return false;
            } else {
                return true;
            }
        });

        Validator::replacer('correctapi', function($message, $attribute, $rule, $parameters){
            return str_replace(':error', 'THE ENTERED VALUE', $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

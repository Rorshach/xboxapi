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
        /**
        *
        * Validating API Key through calling
        * http://www.xboxapi.com/v2/profile with given API key
        *
        */

        Validator::extend('correctapi', function($attribute, $value, $parameters, $validator) {
            //Grab JSON data by calling API
            $json = call_API($value,'profile');

            //Check if response include error_code
            if (isset($json['error_code'])){
                //Place error message onto website
                $validator->addReplacer('correctapi',  function ($message, $attribute, $rule, $parameters) use ($json) {
                    return str_replace([':error'], [$json['error_message']], $message);
                });
                return false;
            } else {
                return true;
            }
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

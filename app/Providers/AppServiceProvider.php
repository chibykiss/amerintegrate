<?php

namespace App\Providers;

use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading();
        Model::preventSilentlyDiscardingAttributes();
        Model::preventAccessingMissingAttributes();
        //to disable model fillable property
        Model::unguard();
        Schema::defaultStringLength(191);
        
        Queue::after(function(JobProcessed $event){
            Log::info($event->job);
            $lastemail = Newsletter::latest('id')->first();
            $lastemail->update([
                'send_status' => 'sent',
            ]);
        });
    }
}

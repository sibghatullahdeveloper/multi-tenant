<?php

namespace App\Providers;

use App\Modules\V1\Features\Models\FeatureValue;
use App\Modules\V1\Features\Observers\FeatureValueObserver;
use App\Modules\V1\Pages\Models\Page;
use App\Modules\V1\Pages\Observers\PageObserver;
use App\Modules\V1\Seo\Models\Seo;
use App\Modules\V1\Seo\Observers\SeoObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        Page::observe(PageObserver::class);
        FeatureValue::observe(FeatureValueObserver::class);
        // Seo::observe(SeoObserver::class);
    }
}

<?php

namespace App\Observers;

use App\Model\Manager;

class ManagerObserve
{
    /**
     * Handle the manager "created" event.
     *
     * @param  \App\Manager  $manager
     * @return void
     */
    public function created(Manager $manager)
    {
        //
    }
    public function creating(Manager $manager)
    {
        $manager->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }
    /**
     * Handle the manager "updated" event.
     *
     * @param  \App\Manager  $manager
     * @return void
     */
    public function updated(Manager $manager)
    {
        //
    }

    /**
     * Handle the manager "deleted" event.
     *
     * @param  \App\Manager  $manager
     * @return void
     */
    public function deleted(Manager $manager)
    {
        //
    }

    /**
     * Handle the manager "restored" event.
     *
     * @param  \App\Manager  $manager
     * @return void
     */
    public function restored(Manager $manager)
    {
        //
    }

    /**
     * Handle the manager "force deleted" event.
     *
     * @param  \App\Manager  $manager
     * @return void
     */
    public function forceDeleted(Manager $manager)
    {
        //
    }
}

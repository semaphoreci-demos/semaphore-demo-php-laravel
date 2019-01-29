<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MangeUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testUserCanSeeCreateForm()
    {
        $user = factory(User::class)->create([
            'email' => 'test@semaphore.com',
            'name' => 'Test Account',
            'password' => bcrypt('123456')
        ]);
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/users')
                ->assertSee('Add New')
                ->click('#add-user-button')
                ->assertPathIs('/users/create');
        });
    }


}

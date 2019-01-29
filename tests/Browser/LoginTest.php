<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testUserCanLogIn()
    {
        $user = factory(User::class)->create([
            'email' => 'test@semaphore.com',
            'name' => 'Test Account',
            'password' => bcrypt('123456')
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'test@semaphore.com')
                    ->type('password', '123456')
                    ->click('#login-button')
                    ->assertSee('Welcome, Test Account');
        });
    }

    public function testUserCannotLoginWithoutAccount()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'test@semaphore.com')
                ->type('password', '123456')
                ->click('#login-button')
                ->assertSee('These credentials do not match our records.');
        });
    }

}

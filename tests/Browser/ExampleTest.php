<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\TestComponent;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\MyComponent;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    public function testDuskSelectorInComponent() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->within(new MyComponent, function (Browser $testComponent) {
                $this->assertEquals('test', $testComponent->attribute('@nav-element','custom'));
            });
        });
    }

    public function testDuskSelectorRoot() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $this->assertEquals('test', $browser->attribute('@nav-element','custom'));
        });
    }

}

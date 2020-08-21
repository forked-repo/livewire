<?php

namespace Tests\Browser\DataBinding\InputSelect;

use Livewire\Livewire;
use Laravel\Dusk\Browser;
use Tests\Browser\TestCase;

class Test extends TestCase
{
    public function test()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                /**
                 * Standard select.
                 */
                ->assertDontSeeIn('@single.output', 'bar')
                ->select('@single.input', 'bar')
                ->waitForLivewire()
                ->assertSelected('@single.input', 'bar')
                ->assertSeeIn('@single.output', 'bar')

                /**
                 * Standard select with value attributes.
                 */
                ->assertDontSeeIn('@single-value.output', 'par')
                ->select('@single-value.input', 'par')
                ->waitForLivewire()
                ->assertSelected('@single-value.input', 'par')
                ->assertSeeIn('@single-value.output', 'par')

                /**
                 * Standard select with value attributes.
                 */
                ->assertSeeIn('@single-number.output', '3')
                ->assertSelected('@single-number.input', '3')
                ->select('@single-number.input', '4')
                ->waitForLivewire()
                ->assertSeeIn('@single-number.output', '4')
                ->assertSelected('@single-number.input', '4')

                /**
                 * Select with placeholder default.
                 */
                ->assertSelected('@placeholder.input', '')
                ->assertDontSeeIn('@placeholder.output', 'foo')
                ->select('@placeholder.input', 'foo')
                ->waitForLivewire()
                ->assertSelected('@placeholder.input', 'foo')
                ->assertSeeIn('@placeholder.output', 'foo')

                /**
                 * Select multiple.
                 */
                ->assertDontSeeIn('@multiple.output', 'bar')
                ->select('@multiple.input', 'bar')
                ->waitForLivewire()
                ->assertSelected('@multiple.input', 'bar')
                ->assertSeeIn('@multiple.output', 'bar')
                ->select('@multiple.input', 'baz')
                ->waitForLivewire()
                ->assertSelected('@multiple.input', 'baz')
                ->assertSeeIn('@multiple.output', 'bar')
                ->assertSeeIn('@multiple.output', 'baz');
        });
    }
}
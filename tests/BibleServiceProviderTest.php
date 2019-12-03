<?php

namespace Djunehor\Logos\Test;

use Djunehor\Logos\Bible;
use Djunehor\Logos\BibleServiceProvider;
use Mockery as m;

class BibleServiceProviderTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $mockApp;

    /**
     * @var BibleServiceProvider
     */
    protected $provider;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockApp = m::mock('\Illuminate\Contracts\Foundation\Application');
        $this->provider = new BibleServiceProvider($this->mockApp);
    }

    /**
     * Test that it registers the correct service name with Identity.
     */
    public function testRegister()
    {
        $this->mockApp->shouldReceive('bind')
            ->once()
            ->andReturnUsing(function ($name, $closure) {
                $this->assertEquals('laravel-bible', $name);
                $this->assertInstanceOf(Bible::class, $closure());
            });

        $this->provider->register();
    }

    /**
     * Test that it provides the correct service name.
     */
    public function testProvides()
    {
        $expected = ['laravel-bible'];
        $actual = $this->provider->provides();

        $this->assertEquals($expected, $actual);
    }
}

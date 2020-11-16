<?php

declare(strict_types=1);

namespace AppTests;

use App\Address;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Address
 */
class AddressTest extends TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(
            Address::class,
            Address::create('AT', '1070', 'Wien')
        );
    }
}
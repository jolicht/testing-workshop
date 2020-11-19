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
    private Address $address;
    
    protected function setUp(): void
    {
        $this->address = Address::create('AT', '1020', 'Wien');
    }

    /**
     * @test
     */
    public function it_creates_address()
    {
        $this->assertInstanceOf(
            Address::class,
            Address::create('AT', '1070', 'Wien')
        );
    }

    /**
     * @test
     */
    public function it_gets_country_code()
    {
        $this->assertSame('AT', $this->address->getCountryCode());
    }
    
    /**
     * @test
     */
    public function it_gets_zip_code()
    {
        $this->assertSame('1020', $this->address->getZipCode());
    }
    
    /**
     * @test
     */
    public function it_gets_city()
    {
        $this->assertSame('Wien', $this->address->getCity());
    }
}
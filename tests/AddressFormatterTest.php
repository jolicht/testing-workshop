<?php

declare(strict_types=1);

namespace AppTests;

use App\Address;
use App\AddressFormatter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\AddressFormatter
 */
final class AddressFormatterTest extends TestCase
{
    private AddressFormatter $addressFormatter;

    protected function setUp(): void
    {
        $this->addressFormatter = new AddressFormatter();
    }

    /**
     * @test
     * @dataProvider address_data_provider
     */
    public function it_formats_address(string $expected, ?string $countryCode, ?string $zipCode, ?string $city)
    {
        $this->assertSame($expected, $this->addressFormatter->__invoke(Address::create($countryCode, $zipCode, $city)));
    }

    public function address_data_provider()
    {
        return [
            ['AT - 1020, Wien (Adresse ist komplett)', 'AT', '1020', 'Wien'],
            ['1020, Wien', null, '1020', 'Wien'],
            ['AT - Wien', 'AT', null, 'Wien'],
            ['AT - 1020', 'AT', '1020', null],
            ['AT', 'AT', null, null],
            ['1020', null, '1020', null],
            ['Wien', null, null, 'Wien'],
            ['', null, null, null],
        ];
    }


}
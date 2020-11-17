<?php
declare(strict_types=1);

namespace AppTests\Api;

use App\Api\ApiManager;
use App\Api\Exception\AuthenticationException;
use App\Api\Exception\InvalidFormatException;
use App\Api\Exception\NotFoundException;
use App\Api\Exception\ServerException;
use App\Api\Exception\ValidationException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;

/**
 * @covers \App\Api\ApiManager
 *
 * - valid token is only valid_bearer_token
 * - id 401 is used to simulate a missing authorization header
 * - id 500 is used to simulate a server error on api side
 * - id 600 is used to simulate a network error (timeout, dns etc...)
 * - id 700 is used to return xml instead of json
 * - id 800 is used to return broken json
 * - id 1000 is already created an has an email of test@test.at
 * - all not listed special cases should behave exactly as a the original api
 *
 * - for a full test all special erros like network and server errors normally should be tested against the createUser call as well but due time constraints of the workshop only get calls will be tested
 */
class ApiManagerTest extends TestCase
{
    private const TOKEN = 'valid_bearer_token';
    private ClientInterface $client;

    public function setUp(): void
    {
        //@todo - create and initialize $client here
    }

    public function testAuthenticationMissing(): void
    {
        $api = new ApiManager($this->client, '');

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Token missing');

        //to test this we assume that user id 401 fakes the api to retun a 401
        $api->getUser(401);
    }

    public function testGetInvalidToken(): void
    {
        $api = new ApiManager($this->client, 'invalid');

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Token invalid');

        $api->getUser(1);
    }

    public function testCreateUserInvalidToken(): void
    {
        $api = new ApiManager($this->client, 'invalid');

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Token invalid');

        $api->createUser('test@test.at');
    }

    public function testServerError(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);
        $this->expectException(ServerException::class);

        //simulate error 500
        $api->getUser(500);
    }

    public function testNetworkError(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);
        $this->expectException(NetworkExceptionInterface::class);

        //simulate a psr network exception
        $api->getUser(600);
    }

    public function testGetUserNotFound(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);
        $this->expectException(NotFoundException::class);

        $api->getUser(404);
    }

    public function testNotJson(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);
        $this->expectException(InvalidFormatException::class);

        $api->getUser(700);
    }

    public function testBrokenJson(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);
        $this->expectException(\JsonException::class);

        $api->getUser(800);
    }

    public function testGetValid(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);

        $user = $api->getUser(1000);
        $this->assertEquals(1000, $user['id']);
        $this->assertEquals('test@test.at', $user['email']);
    }

    public function testCreateInvalidEmail(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);

        $this->expectException(ValidationException::class);
        $api->createUser('test');
    }

    public function testCreateGmail(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);

        $this->expectException(ValidationException::class);
        $api->createUser('test@gmail.com');
    }

    public function testCreateAndGet(): void
    {
        $api = new ApiManager($this->client, self::TOKEN);

        $id = $api->createUser('test@justimmo.at');
        $user = $api->getUser($id);

        $this->assertEquals($id, $user['id']);
        $this->assertEquals('test@justimmo.at', $user['email']);
    }
}

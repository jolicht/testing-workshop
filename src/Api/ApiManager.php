<?php
declare(strict_types=1);

namespace App\Api;

use App\Api\Exception\AuthenticationException;
use App\Api\Exception\InvalidFormatException;
use App\Api\Exception\NotFoundException;
use App\Api\Exception\ServerException;
use App\Api\Exception\ValidationException;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Stream;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function is_numeric;
use function json_decode;
use function json_encode;

/**
 * Quick and dirty for testing exercise workshop
 */
final class ApiManager
{
    private ClientInterface $client;
    private string          $accessToken;

    public function __construct(ClientInterface $client, string $accessToken)
    {
        $this->client      = $client;
        $this->accessToken = $accessToken;
    }


    public function getUser(int $userId): array
    {
        $request = new Request('GET', '/user/' . $userId);
        $request = $this->authenticate($request);

        $response = $this->client->sendRequest($request);

        $this->validateResponse($response);

        return json_decode($response->getBody()->__toString(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function createUser(string $email): int
    {
        $request = new Request('POST', '/user');
        $request = $this->authenticate($request);
        $request = $request->withBody(Stream::create(json_encode(['email' => $email])));

        $response = $this->client->sendRequest($request);

        if ($response->getStatusCode() === 400) {
            throw new ValidationException();
        }
        $this->validateResponse($response);

        $body = json_decode($response->getBody()->__toString(), true, 512, JSON_THROW_ON_ERROR);
        if (!is_numeric($body['id'])) {
            throw new \RuntimeException('Invalid return');
        }

        return (int) $body['id'];
    }

    private function validateResponse(ResponseInterface $response): void
    {
        if ($response->getStatusCode() === 401) {
            throw AuthenticationException::missing();
        }

        if ($response->getStatusCode() === 403) {
            throw AuthenticationException::invalid();
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() >= 500) {
            throw new ServerException();
        }

        if ($response->getHeaderLine('Content-Type') !== 'application/json') {
            throw new InvalidFormatException();
        }

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException('Invalid status code');
        }
    }

    private function authenticate(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Authorization', 'Bearer ' . $this->accessToken);
    }
}

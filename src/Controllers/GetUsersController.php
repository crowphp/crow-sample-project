<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Benchmark\Application\GetUsersUseCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetUsersController
{
    public function __construct(private GetUsersUseCase $useCase)
    {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {

        $response->getBody()->write(
            json_encode(
                $this->useCase->execute()->toArray()
            )
        );


        return $response->withHeader(
            "content-type",
            "application/json"
        );
    }
}
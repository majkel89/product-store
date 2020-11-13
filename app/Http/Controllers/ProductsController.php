<?php

namespace App\Http\Controllers;

use App\Application\Product\Commands\CreateProductCommand;
use App\Application\Product\Queries\GetProductQuery;
use App\Core\Product\Exceptions\ProductAlreadyExistsException;
use App\Core\Product\Exceptions\ProductNotFoundException;
use App\Core\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Ramsey\Uuid\Guid\Guid;

final class ProductsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getProduct(string $id): string
    {
        $query = new GetProductQuery($id);

        try {
            $result = $this->dispatch($query);
        } catch (ProductNotFoundException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (ValidationException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $result;
    }

    public function createProduct(Request $request): Response
    {
        $productId = Guid::uuid4()->toString();

        $command = new CreateProductCommand($productId, $request->post('name'), $request->post('price'));

        try {

            $this->dispatch($command);

        } catch (ProductAlreadyExistsException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_CONFLICT);
        } catch (ValidationException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        $response = new Response(null, Response::HTTP_ACCEPTED);
        $response->withHeaders(['location' => "/api/products/$productId"]);
        return $response;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    /**
     * Method to compose Query Parameters from request query
     * so it allows pagination, ordering, search the entity by params
     *
     * @param Request $request The Request Object
     *
     * @return array
     * @throws \JsonException
     */
    protected function composeQueryParameters(Request $request): array
    {
        // Define the order
        $order = $request->get('order', null);
        if (is_string($order)) {
            try {
                $order = json_decode($order, true);
            } catch (Exception $e) {
                $order = null;
            }
        }

        // Define start & length
        $start = (int)$request->get('page', 1);
        $length = (int)$request->get('size', 10);
        $start = ($start - 1) * $length;


        // Define the search
        $search = $request->get('search', null);
        if (is_string($search)) {
            try {
                $search = json_decode($search, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {
                $search = null;
            }
        }

        // Return the parameters
        return [
            'start'                 => $start,
            'length'                => $length,
            'search'                => $search ?? [],
            'order'                 => $order ?? []
        ];
    }
}

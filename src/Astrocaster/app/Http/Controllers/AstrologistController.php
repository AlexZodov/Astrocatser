<?php

namespace App\Http\Controllers;

use App\Astrologist;
use App\Mapper\Data;
use App\Mapper\ResponseModelMapper;
use App\Resources\AstrologistResource;
use App\Resources\AstrologistsResource;
use App\Services\Entities\AstrologistService;
use App\Services\Entities\IBaseEntityService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AstrologistController extends BaseController
{
    //
    private IBaseEntityService $service; //service property

    public function __construct(AstrologistService $service)
    {
        //injecting the proper service
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * Here will be displayed the list of this controller entity - Astrologist
     *
     * @param \Illuminate\Http\Request
     * @param Astrologist
     * @return ResponseModelMapper
     * @throws \JsonException
     */
    public function index(Request $request)
    {
        $queryParameters = $this->composeQueryParameters($request);

        $result = $this->service->parametrizedResult(
            $queryParameters['search'],
            $queryParameters['order'],
            $queryParameters['start'],
            $queryParameters['length']);


        //wrapping the result into its Resource mapper and then into ResponseModelMapper
        return new ResponseModelMapper(['data'=>new Data(AstrologistsResource::make($result)->resolve())]);
    }

    /**
     * Display the specified resource.
     * Show one specific astrologist
     *
     * @param Astrologist $astrologist
     * @return ResponseModelMapper
     */
    public function show(Astrologist $astrologist)
    {
        //setting already fetched instance into repository, so Laravel didn`t do it without purpose
        $this->service->setInstance($astrologist);
        $result = $this->service->find();


        //wrapping the result into its Resource mapper and then into ResponseModelMapper
        return new ResponseModelMapper(['data'=>new Data(AstrologistResource::make($result)->resolve())]);
    }
}

<?php

namespace EcommerceMobly\Domains\Products\Http\Controllers;

use EcommerceMobly\Domains\Products\Contracts\FeatureServiceContract;
use EcommerceMobly\Support\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use EcommerceMobly\Domains\Products\Http\Resources\FeatureResource;

class FeatureController extends ApiController
{
    /**
     * @var FeatureServiceContract
     */
    private $service;

    /**
     * FeatureController constructor.
     * @param FeatureServiceContract $service
     */
    public function __construct(FeatureServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * List resources.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return FeatureResource::collection($this->service->paginate());
    }

    /**
     * Store resource.
     *
     * @param  Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required'
            ],[
                'name.required' => 'Nome obrigatório.'
            ]);

            $this->service->create($request->all());

            return $this->response()->withSuccess(
                'Característica do produto criada com sucesso!'
            );
        } catch (ValidationException $e) {
            return $this->response()->withUnprocessableEntity(
                $e->errors()
            );
        } catch (\Exception $e) {
            return $this->response()->withError(
                'Ocorreu um erro ao criar a característica.'
            );
        }
    }

    /**
     * Update resource.
     *
     * @param  $id
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id, Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required'
            ],[
                'name.required' => 'Nome obrigatório.'
            ]);

            $this->service->update($id, $request->all());

            return $this->response()->withSuccess(
                'Característica do produto atualizada com sucesso!'
            );
        } catch (ValidationException $e) {
            return $this->response()->withUnprocessableEntity(
                $e->errors()
            );
        } catch (\Exception $e) {
            return $this->response()->withError(
                'Ocorreu um erro ao atualizar a característica.'
            );
        }
    }

    /**
     * @param  string|int $id
     * @return FeatureResource|\Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        try {
            return new FeatureResource($this->service->find($id));
        } catch (\Exception $e) {
            return $this->response()->withNotFound(
                'Não foi possível encontrar a característica.'
            );
        }
    }

    /**
     * @param  string|int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return $this->response()->withSuccess(
                'Característica removida com sucesso!'
            );
        } catch (\Exception $e) {
            return $this->response()->withError(
                'Não foi possível removida a característica.'
            );
        }
    }
}
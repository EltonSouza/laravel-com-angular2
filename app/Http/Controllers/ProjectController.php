<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

//use CodeProject\Http\Requests;


class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @var ProjectService
     */
    private $service;

    /**
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return $this->repository->with(['owner','client'])->all();
        return $this->repository->with(['owner','client'])->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
        //return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$userId = \Authorizer::getResourceOwnerId();
        if($this->repository->isOwner($id, $userId) == false){
            return ['success'=>false];
        }*/
        if ($this->checkProjectPermissions($id) == false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->find($id);
        //return Client::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$client = Client::find($id); //consulta dos dados

        $client->update($request->all(),$id); //atualiza os dados

        return $client; //retornar os dados para serialização em JSON*/

        //return Client::find($id)->update($request->all());
        //return $this->repository->update($request->all(), $id);
        if ($this->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Client::find($id)->delete();

        if ($this->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }

        $this->repository->delete($id);
    }

    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId);

    }

    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId);

    }

    private function checkProjectPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }

        return false;
    }
}

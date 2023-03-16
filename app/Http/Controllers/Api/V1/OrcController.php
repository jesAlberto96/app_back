<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResponseController;
use App\Repositories\ApiOrc\ApiOrcRepository;
use App\Repositories\User\UsersRepository;
use App\Repositories\User\KeywordsRepository;
use App\Models\Candidato;

class OrcController extends Controller
{
    private $response;

    public function __construct(){
        $this->response = new ResponseController;
        $this->apiOrcRepository = new ApiOrcRepository;
        $this->usersRepository = new UsersRepository;
        $this->keywordsRepository = new KeywordsRepository;
    }
    
    public function getORCID($orcid)
    {
        $response = $this->apiOrcRepository->getByORCID($orcid);

        if (!$response){
            return $this->response->sendError($this->apiOrcRepository->errors, 404);
        }

        return $this->response->sendResponse(true, $response);
    }

    public function list()
    {
        return $this->usersRepository->getAll();
    }

    public function store($orcid, StoreUserRequest $request)
    {
        try {
            $user = $this->usersRepository->create([
                "orcid" => $orcid,
                "email" => $request->input('email'),
                "name" => $request->input('name'),
                "lastname" => $request->input('lastname'),
            ]);

            $this->saveKeywords($request, $user);

            return $this->response->sendResponse(true, $this->usersRepository->getByORCID($orcid), [], 201);
        } catch (Exception $ex) {
            return $this->response->sendError(["Ocurrio un error inesperado"], 500);
        }
    }

    private function saveKeywords($request, $user){
        foreach ($request->input('keywords') as $key => $value) {
            $this->keywordsRepository->create([
                "user_id" => $user->id,
                "putcode" => $value['put-code'],
                "content" => $value['content'],
            ]);
        }
    }

    public function detail($orcid)
    {
        return $this->response->sendResponse(true, $this->usersRepository->getByORCID($orcid));
    }

    public function delete($orcid)
    {
        $this->usersRepository->deleteByORCID($orcid);

        return $this->response->sendResponse(true, "Resource deleted");
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 31/12/2015
 * Time: 14:20
 */

namespace CodeProject\Services;


//use CodeProject\Repositories\ClientRepository;
use CodeProject\Repositories\ProjectNoteRepository;
//use CodeProject\Validators\ClientValidator;
use CodeProject\Validators\ProjectNoteValidator;
//use Illuminate\Contracts\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;


class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectNoteValidator
     */
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        // enviar um email
        // disparar notificacao
        // postar um tweet
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }


    }
}
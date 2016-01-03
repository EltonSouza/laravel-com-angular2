<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 31/12/2015
 * Time: 15:16
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required|date'

    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 31/12/2015
 * Time: 15:16
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'title' => 'required',
        'note' => 'required',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required|date'

    ];
}
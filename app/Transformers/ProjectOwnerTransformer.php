<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 05/01/2016
 * Time: 12:14
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectOwnerTransformer extends TransformerAbstract
{
    public function transform(User $owner)
    {
        return [
            'owner_id'  => $owner->id,
            'name'      => $owner->name,
            'email'     => $owner->email
        ];
    }

}
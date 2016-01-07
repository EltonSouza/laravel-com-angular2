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

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name'      => $member->name,
        ];
    }

}
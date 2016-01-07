<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 05/01/2016
 * Time: 12:14
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['members', 'owner'];

    public function transform(Project $project)
    {
        return [
            'project_id'    => $project->id,
            'client_id'     => $project->client_id,
            'owner_id'      => $project->owner_id,
            'name'          => $project->name,
            'description'   => $project->description,
            'progress'      => $project->progress,
            'status'        => $project->status,
            'due_date'      => $project->due_date,
            'client'        => $project->client,
            //'owner'         => $project->owner,
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeOwner(Project $project)
    {
        return $this->item($project->owner, new ProjectOwnerTransformer());
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 05/01/2016
 * Time: 12:30
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}
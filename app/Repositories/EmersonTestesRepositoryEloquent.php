<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmersonTestesRepository;
use App\Entities\EmersonTestes;
use App\Validators\EmersonTestesValidator;

/**
 * Class EmersonTestesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmersonTestesRepositoryEloquent extends BaseRepository implements EmersonTestesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmersonTestes::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EmersonTestesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

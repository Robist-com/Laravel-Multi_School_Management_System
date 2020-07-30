<?php

namespace App\Repositories;

use App\Models\Admissions;
use App\Repositories\BaseRepository;

/**
 * Class AdmissionsRepository
 * @package App\Repositories
 * @version July 19, 2020, 6:16 pm UTC
*/

class AdmissionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Admissions::class;
    }
}

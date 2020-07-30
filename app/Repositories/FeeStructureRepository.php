<?php

namespace App\Repositories;

use App\Models\FeeStructure;
use App\Repositories\BaseRepository;

/**
 * Class FeeStructureRepository
 * @package App\Repositories
 * @version December 15, 2019, 11:23 pm UTC
*/

class FeeStructureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'semester_id',
        'course_id',
        'level_id',
        'admissionFee',
        'semesterFee'
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
        return FeeStructure::class;
    }
}

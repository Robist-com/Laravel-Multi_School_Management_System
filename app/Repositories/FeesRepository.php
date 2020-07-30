<?php

namespace App\Repositories;

use App\Models\Fees;
use App\Repositories\BaseRepository;

/**
 * Class FeesRepository
 * @package App\Repositories
 * @version December 15, 2019, 1:48 pm UTC
*/

class FeesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_id',
        'level_id',
        'semester_id',
        'fee_structure_id',
        'amount'
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
        return Fees::class;
    }
}

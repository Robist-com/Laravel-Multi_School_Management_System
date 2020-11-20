<?php

namespace App\Repositories;

use App\Models\Time;
use App\Repositories\BaseRepository;

/**
 * Class TimeRepository
 * @package App\Repositories
 * @version September 22, 2019, 6:34 pm UTC
*/

class TimeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'time',
        'time_end',
        'shift_id',
        'school_id'
    ];
    protected $primaryKey = 'time_id';
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
        return Time::class;
    }
}

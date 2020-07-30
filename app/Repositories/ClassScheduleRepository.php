<?php

namespace App\Repositories;

use App\Models\ClassSchedule;
use App\Repositories\BaseRepository;

/**
 * Class ClassScheduleRepository
 * @package App\Repositories
 * @version November 11, 2019, 8:28 am UTC
*/

class ClassScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_id',
        'class_id',
        'level_id',
        'shift_id',
        'classroom_id',
        'batch_id',
        'day_id',
        'time_id',
        'semester_id',
        'start_date',
        'end_date',
        'status'
    ];
    protected $primaryKey = 'Scheduleid';
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
        return ClassSchedule::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\ClassRoom;
use App\Repositories\BaseRepository;

/**
 * Class ClassRoomRepository
 * @package App\Repositories
 * @version October 1, 2019, 12:29 pm UTC
*/

class ClassRoomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'classroom_name',
        'classroom_code',
        'classroom_description',
        'classroom_status'
    ];
protected $primaryKey = 'classroom_id';
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
        return ClassRoom::class;
    }
}

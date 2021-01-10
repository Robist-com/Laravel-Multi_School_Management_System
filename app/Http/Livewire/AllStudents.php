<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admission;
use Livewire\WithPagination;

class AllStudents extends Component
{
    use WithPagination;

    public $search;

    // public function mount()
    // {

    //     // $this->students = Admission::join('rolls', 'rolls.student_id', 'admissions.id')
    //     //                             ->join('schools', 'schools.id', 'admissions.school_id')
    //     //                             ->join('levels', 'levels.id', 'admissions.degree_id')
    //     //                             ->select('levels.level','rolls.username', 'admissions.first_name', 'admissions.last_name'
    //     //                             ,'admissions.image', 'schools.name')
    //     //                             ->orderBy('schools.name')
    //     //                             ->orderBy('levels.level')->paginate(10);
    // }

    // public function FunctionName(Type $var = null)
    // {
    //     Admission::where('title', 'like', '%'.$this->search.'%')->paginate(10);
    // }

         public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
       $students = Admission::join('rolls', 'rolls.student_id', 'admissions.id')
                                    ->join('schools', 'schools.id', 'admissions.school_id')
                                    ->join('levels', 'levels.id', 'admissions.degree_id')
                                    ->select('levels.level','rolls.username', 'admissions.first_name', 'admissions.last_name'
                                    ,'admissions.image', 'schools.name')
                                    ->orderBy('schools.name')
                                    ->orderBy('levels.level')
                                    ->where('rolls.username', 'like', '%'.$this->search.'%')->paginate(10);

        return view('livewire.all-students', ['students' => $students]);
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;
class Teacher_Export implements WithHeadings, FromCollection, ShouldAutoSize, WithEvents 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //here we will write our code okay.
        $teachers = DB::table('teachers')->select(
                        'first_name','last_name','gender','email','phone','status')->get();
    return $teachers;
    }

    // HERE IS THE EXEL HEADER PART 
    public function headings() : array
    {

        return [
            'First Name',
            'Last Name',
            'Gender',
            'Email',
            'Phone',
            'Status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                
            },
        ];
    }
    // now lets work on the route side okay
    // LET'S TRY AND EXPORT ONE EXCEL FILE  AND SEE OKAY
}

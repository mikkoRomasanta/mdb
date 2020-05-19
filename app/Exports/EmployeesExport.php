<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function headings(): array{
        $headers = ['ID', 'Emp ID', 'Global ID','First Name', 'Last Name', 'Email', 'Role', 'Status']; //set default headers
        
        $apps = $apps = App::pluckApps();
        foreach($apps as $app){
            array_push($headers,$app); //insert each app to headers
        }

        return $headers;
    }

    public function collection()
    {
        $data = ['id','emp_id','global_id','first_name','last_name','email','role','status']; //set default headers

        $apps = $apps = App::pluckApps();
        $appCount = $apps->count(); //count # of apps

        for($i=0;$i<$appCount;$i++){ //loop through all apps
            $app = strtolower($apps[$i]); //lowercase the appname
            array_push($data,$app); //insert app to data
        }

        $employees = Employee::select($data)->get();
        return $employees;
    }
}

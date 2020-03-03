<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $user)
    {
        //
    }

    public function view(Employee $user)
    {
        return $user->role === 'ADMIN'; //only ADMIN users can view
    }

    public function create(Employee $user)
    {
        return $user->role === 'ADMIN';
    }


    public function update(Employee $user, Employee $employee)
    {
        return $user->role === 'ADMIN';
    }


    public function delete(Employee $user, Employee $employee)
    {
        return $user->role === 'ADMIN';
    }


    public function restore(Employee $user, Employee $employee)
    {
        //
    }


    public function forceDelete(Employee $user, Employee $employee)
    {
        //
    }

    public function resetPass(Employee $user)
    {
        return $user->role === 'ADMIN';
    }
}

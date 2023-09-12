<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class AdminStudentService
{
    public function getStudents($search = '')
    {
        return (new UserRepository)->getFilteredStudents($search);
    }

    public function createStudent($data)
    {
        $student = (new UserRepository)->createNewUser($data);

        $student->assignRole('student');
    }
}

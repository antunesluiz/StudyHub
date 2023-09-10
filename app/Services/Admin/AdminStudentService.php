<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Repositories\UserRepository;

class AdminStudentService
{
    public function getStudents($search = '')
    {
        return (new UserRepository)->getFilteredStudents($search);
    }
}

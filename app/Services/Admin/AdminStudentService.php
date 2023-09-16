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
        $profile_photo_path = $data['photo']->store('profile_photo');
        $student = (new UserRepository)->createNewUser([...$data, 'profile_photo_path' => $profile_photo_path]);

        $student->assignRole('student');
    }
}

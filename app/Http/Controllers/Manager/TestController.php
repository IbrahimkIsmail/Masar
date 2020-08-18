<?php

namespace App\Http\Controllers\Manager;

use App\Model\ClassRoom;
use App\Model\Father;
use App\Model\Homework;
use App\Model\Kindergarten;
use App\Model\Manager;
use App\Model\Student;
use App\Model\Subject;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{

    function callFunctions()
    {
        $this->manager();
        $this->subject();
        $this->teacher();
        $this->classRoom();
        $this->students();
        $this->homeworks();
    }
    function manager()
    {
        Kindergarten::create([
            'ps_id' => '930673187',
            'name' => 'saif',
            'email' => 'saif@s.s',
            'logo' => 'asd',
            'description' => 'asdasd asdasd',
            'fax' => '930673155',
            'facebook_url' => 'www.www.www',
            'instagram_url' => 'www.www.www',
            'mobile_number' => 'www.www.www',
            'phone_number' => 'www.www.www',
            'full_address' => 'www.www.www',
            'manager_id' => 2,
        ]);
        Manager::create([
            'name' => 'manager1',
            'ps_id' => 930673188,
            'dob' => '11-11-2011',
            'image' => 'sef',
            'email' => 'asd@asd.asd',
            'mobile_number' => '0599442738',
            'password' => 'fuck',
            'full_address' => 'asd aaa',
            'api_token' => 'x',

        ]);
    }

    function teacher()
    {
$teacher = Teacher::create([
            'name' => ' Teacher 2',
            'ps_id' => 930673009,
            'manager_id' => 1,
            'kindergarten_id' => 1,
            'mobile_number' => '0599442739',
            'email' => 'zxc@zcx.zxc',
            'password' => 'Muhammed Teacher',
            'status' => 1,
        ]);
//        $teacher->subjects = $this->classRoom();
        Teacher::create([
            'name' => ' Teacher 3',
            'ps_id' => 930673119,
            'manager_id' => 1,
            'kindergarten_id' => 1,
            'mobile_number' => '0599442739',
            'email' => 'zxc@zcx.zxc',
            'password' => 'Muhammed Teacher',
            'status' => 1,
        ]);
        Teacher::create([
            'name' => ' Teacher 4 ',
            'ps_id' => 930673991,
            'manager_id' => 1,
            'kindergarten_id' => 1,
            'mobile_number' => '0599442739',
            'email' => 'zxc@zcx.zxc',
            'password' => 'Muhammed Teacher',
            'status' => 1,
        ]);
    }

    function classRoom()
    {
        ClassRoom::create([
            'name' => 'kg1',
            'level' => 1,
            'manager_id' => 1,
            'kindergarten_id' => 1,
            'status' => 1,
        ]);
        ClassRoom::create([
            'name' => 'kg2',
            'level' => 1,
            'manager_id' => 1,
            'kindergarten_id' => 1,
            'status' => 1,
        ]);
        ClassRoom::create([
            'name' => 'kg3',
            'level' => 1,
            'manager_id' => 1,
            'kindergarten_id' => 1,
            'status' => 1,
        ]);
    }

    function subject()
    {
        Subject::create([
            'title' => 'عربي',
            'description' => 'this desc',
        ]);
        Subject::create([
            'title' => 'حساب',
            'description' => 'this desc',
        ]);
        Subject::create([
            'title' => 'دين',
            'description' => 'this desc',
        ]);
        Subject::create([
            'title' => 'علوم',
            'description' => 'this desc',
        ]);
        Subject::create([
            'title' => 'انجليزي',
            'description' => 'this desc',
        ]);
        Subject::create([
            'title' => 'فرنسي',
            'description' => 'this desc',
        ]);
       Subject::create([
            'title' => 'فنون',
            'description' => 'this desc',
        ]);


    }

    function homeworks()
    {
        Homework::create([
            'page_number' => 1,
            'assignment_description' => 'wqe wqee das',
            'status' => 1,
            'class_room_id' => 1,
            'teacher_id' => 1,
            'kindergarten_id' => 1,
            'manager_id' => 1,
            'subject_id' => 1,
        ]);
        Homework::create([
            'page_number' => 2,
            'assignment_description' => 'wqe wqee das',
            'status' => 1,
            'class_room_id' => 2,
            'teacher_id' => 1,
            'kindergarten_id' => 1,
            'manager_id' => 1,
            'subject_id' => 1,
        ]);
        Homework::create([
            'page_number' => 1,
            'assignment_description' => 'wqe wqee das',
            'status' => 1,
            'class_room_id' => 2,
            'teacher_id' => 2,
            'kindergarten_id' => 1,
            'manager_id' => 1,
            'subject_id' => 2,
        ]);
    }

    function students(){
        Father::create([
            'kindergarten_id'=>1,
            'ps_id'=>'201212111',
            'full_name'=>'father 1',
            'password'=>'asdsad',
            'full_address'=>'asdsad',
            'dob'=>'11-11-2011',
            'mobile_number'=>'0599442739',
            'api_token'=>'x',
        ]);
        Student::create([
            'ps_id'=>'201323689',
            'name'=>'dasdasdasdsa',
            'dob'=>'1231321321',
            'father_id'=>1,
            'class_room_id'=>1,
            'kindergarten_id'=>1,
            'manager_id'=>1,
        ]);
    }
}

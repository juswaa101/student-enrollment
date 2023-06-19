<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;

class EnrollSubjectController extends Controller
{
    public function enrollSubject(Subject $subject)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->subjects()->attach($subject->id);

        return redirect()->route('pending.enrolled.subjects')
            ->with('success', 'Subject Enrollment');
    }

    public function cancelEnrollmentSubject(Subject $subject)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->subjects()->detach($subject->id);

        return redirect()->route('pending.enrolled.subjects')
            ->with('success', 'Subject Enrollment Cancelled');
    }
}

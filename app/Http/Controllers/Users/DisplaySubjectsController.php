<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Subject;

class DisplaySubjectsController extends Controller
{
    public function __invoke()
    {
        $subjects = Subject::withCount(['users' => function ($q) {
            $q->where('user_id', auth()->user()->id);
        }])
            ->with(['users' => function ($q) {
                $q->where('user_id', auth()->user()->id);
            }])
            ->when(request()->get('search'), function ($q) {
                $q->where('code', request()->get('search'));
            })
            ->latest()->paginate(10);

        return view('users.available-subjects', compact('subjects'));
    }
}

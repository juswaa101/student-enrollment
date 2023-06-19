<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class DisplayEnrolledSubjectsController extends Controller
{
    public function __invoke()
    {
        $user = User::firstWhere('id', auth()->user()->id);

        $user->setRelation(
            'subjects',
            $user->subjects()
                ->where(function ($q) {
                    $q->where('status', 1);
                })
                ->when(request()->get('search'), function ($q) {
                    $q->where('code', request()->get('search'));
                })
                ->latest()
                ->paginate(10)
        );

        $enrolledSubjectsCount = User::withCount([
            'subjects' => function ($q) {
                $q->where('user_id', auth()->user()->id)
                    ->where('status', 1)
                    ->latest();
            }
        ])
            ->firstWhere('id', auth()->user()->id);

        return view(
            'users.enrolled-subjects',
            compact('user', 'enrolledSubjectsCount')
        );
    }
}

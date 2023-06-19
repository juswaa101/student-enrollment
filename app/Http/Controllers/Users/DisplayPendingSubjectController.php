<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class DisplayPendingSubjectController extends Controller
{
    public function __invoke()
    {
        $user = User::firstWhere('id', auth()->user()->id);

        $user->setRelation(
            'subjects',
            $user->subjects()
                ->where(function($q) {
                    $q->where('status', 0);
                })
                ->when(request()->get('search'), function ($q) {
                    $q->where('code', request()->get('search'));
                })
                ->latest()
                ->paginate(10)
        );

        $pendingEnrolledSubjectsCount = User::withCount([
            'subjects' => function ($q) {
                $q->where('user_id', auth()->user()->id)
                    ->where('status', 0)
                    ->latest();
            }
        ])
            ->firstWhere('id', auth()->user()->id);

        return view(
            'users.pending-enrolled-subjects',
            compact('user', 'pendingEnrolledSubjectsCount')
        );
    }
}

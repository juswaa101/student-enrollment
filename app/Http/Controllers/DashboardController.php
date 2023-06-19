<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if (!Gate::allows('admin')) {
            $enrolledSubjectsCount = User::withCount([
                'subjects' => function ($q) {
                    $q->where('user_id', auth()->user()->id)
                        ->where('status', 1)
                        ->latest();
                }
            ])
                ->firstWhere('id', auth()->user()->id);

            $pendingEnrolledSubjectsCount = User::withCount([
                'subjects' => function ($q) {
                    $q->where('user_id', auth()->user()->id)
                        ->where('status', 0)
                        ->latest();
                }
            ])
                ->firstWhere('id', auth()->user()->id);

            $subjects = Subject::withCount(['users' => function ($q) {
                $q->where('user_id', auth()->user()->id);
            }])
                ->latest()->paginate(10);

            return view(
                'dashboard',
                compact(
                    'enrolledSubjectsCount',
                    'pendingEnrolledSubjectsCount',
                    'subjects'
                )
            );
        }

        $enrolledSubjectsCount = DB::select('select count(*) as enrolled_count from subject_user where status = 1');
        $pendingEnrolledSubjectsCount = DB::select('select count(*) as pending_count from subject_user where status = 0');
        $subjects = Subject::count();

        return view(
            'dashboard',
            compact('enrolledSubjectsCount', 'pendingEnrolledSubjectsCount', 'subjects')
        );
    }
}

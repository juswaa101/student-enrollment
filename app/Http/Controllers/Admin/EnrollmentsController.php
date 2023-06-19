<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = User::with(['subjects' => function ($q) {
            $q->when(request()->get('search'), function ($q) {
                $q->where('code', 'LIKE', '%' . request()->get('search') . '%');
            });
            $q->paginate(10);
        }])
            ->whereNot('id', auth()->user()->id)
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('admin.enrollments', compact('enrollments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Subject $subject, User $user)
    {
        $enrollment = DB::table('subject_user')
            ->where('user_id', $user->id)
            ->where('subject_id', $subject->id);

        $enrollment->update(['status' => !$enrollment->first()->status]);

        return redirect()->back()->with('success', 'Status Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject, User $user)
    {
        $user->subjects()->detach($subject->id);

        return redirect()->back()->with('success', 'User Enrollment Deleted!');
    }
}

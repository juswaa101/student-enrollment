<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::query()
            ->withCount('users')
            ->when(request()->get('search'), function ($q) {
                $q->where('code', request()->get('search'));
            })
            ->orderBy('title', 'asc')
            ->paginate(10);

        return view('admin.subjects', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.add-subject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        Subject::create($request->validated());
        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit-subject', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        return redirect()->back()->with('success', 'Subject updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject->users->count() > 0) {
            return redirect()->back()
                ->with('error', 'This subject has student that is enrolled!');
        }

        $subject->delete();

        return redirect()->back()
            ->with('success', 'Subject created successfully!');
    }
}

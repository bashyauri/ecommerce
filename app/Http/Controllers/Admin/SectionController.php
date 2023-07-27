<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    public function sections()
    {
        $sections = Section::get();

        return view('admin.sections.sections', ['sections' => $sections]);
    }
    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where(['id' => $data['sectionId']])->update(['status' => $status]);
            return response()->json(['status' => $status, 'sectionId' => $data['sectionId']]);
        }
    }
    public function addEditSection(Request $request, $sectionId = null)
    {
        Session::put('page', 'sections');
        if (is_null($sectionId)) {
            $title = "Add Section";
            $section = new Section;
            $message = "Section Added Successfully!";
        } else {
            $title = "Edit Section";
            $section = Section::find($sectionId);
            $message = "Section Updated Successfully!";
        }
        if ($request->isMethod('POST')) {
            $data = $request->all();
            dd($data);
        }
        return view('admin.sections.add_edit_section', ['title' => $title, 'section' => $section, 'message' => $message]);
    }
    public function deleteSection($id)
    {
        // Delete Section
        Section::where(['id' => $id])->delete();


        return redirect()->back()->with(['success_message' => 'Section deleted successfully!']);
    }
}

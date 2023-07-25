<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BankAccount;
use App\Models\BankLedger;
use App\Models\Country;
use App\Models\EntryTypes;
use App\Models\Year;
use App\Models\Airport;
use App\Models\District;
use App\Models\Thana;
use App\Models\Note;
use App\Models\Project;
use App\Models\User;
use App\Models\Issue;
use App\Models\Transaction;
use App\Models\Setting;
use App\Models\DocumentAttachment;
use Session;
use DB;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use PDF;

class ProjectController extends Controller {

    public function index(Request $request) {

        $targets = Project::orderBy('serial', 'asc');

        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('name', 'like', "%{$searchText}%")
                        ->orWhere('details', 'like', "%{$searchText}%");
            });
        }
        $targets = $targets->paginate(5);

//        echo "<pre>";
//        print_r($targets->toArray());
//        exit;

        $data['title'] = 'Project List';
        $data['meta_tag'] = 'Project List';
        $data['meta_description'] = 'Project List';
        return view('backEnd.project.index')->with(compact('data', 'targets'));
    }

    public function create(Request $request) {
        $siteName = Setting::get();

        $data['title'] = 'Project Entry';
        $data['meta_tag'] = 'Project Entry';
        $data['meta_description'] = 'Project Entry';

        return view('backEnd.project.create', compact('data'));
    }

    public function generateCusCode(Request $request) {
        $customerCode = $this->create($request);
        return response()->json(['data' => $customerCode]);
    }

    public function store(Request $request) {
//        echo "<pre>";
//        print_r($request->all());
//        exit;
        $rules = [
            'name' => 'required',
            'details' => 'required',
            'serial' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('project.create')->withInput()->withErrors($validator);
        }

        $target = new Project;
        $target->name = $request->name;
        $target->details = $request->details;
        $target->git_link = $request->git_link;
        $target->live_link = $request->live_link;
        $target->serial = $request->serial;
        $target->published_status = $request->published_status;
        if ($target->save()) {
            $this->uploadFile($target->id, $request);
            Session::flash('success', __('lang.PROJECT_ADDED_SUCCESSFULLY'));
            return redirect()->route('project.index');
        }
    }

    public function uploadFile($projectId, $request) {
//        echo "<pre>";
//        print_r($request->all());
//        exit;
        if ($files = $request->file('doc_name')) {
            foreach ($files as $key => $file) {
                $filePath = 'uploads/images/';
                $fileName = uniqid() . "." . date('Ymd') . "." . $file->getClientOriginalExtension();
                $dbName = $filePath . '' . $fileName;
                $file->move($filePath, $fileName);

                $target = new DocumentAttachment;
                $target->project_id = $projectId;
                $target->doc_name = $dbName;
                $target->title = $raquest->title[$key] ?? '';
                $target->serial = $request->img_serial[$key] ?? 0;
                $target->status = $request->status[$key] ?? 0;
                $target->save();
            }
        }
        return true;
    }

    public function view(Request $request) {
        $target = Project::with('attachments')->findOrFail($request->id);
        $data['title'] = 'View Project Details';
        $data['meta_tag'] = 'View Project Details';
        $data['meta_description'] = 'View Project Details';
        return view('backEnd.project.view')->with(compact('target', 'data'));
    }

    public function edit(Request $request) {

        $target = Project::with('attachments')->findOrFail($request->id);
        $data['title'] = 'Edit Project';
        $data['meta_tag'] = 'Edit Project';
        $data['meta_description'] = 'Edit Project';
        return view('backEnd.project.edit')->with(compact('target', 'data'));
    }

    public function update(Request $request) {
        $rules = [
            'name' => 'required',
            'details' => 'required',
            'serial' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('project.create')->withInput()->withErrors($validator);
        }

        $target = new Project;
        $target->name = $request->name;
        $target->details = $request->details;
        $target->git_link = $request->git_link;
        $target->live_link = $request->live_link;
        $target->serial = $request->serial;
        $target->published_status = $request->published_status;
        if ($target->save()) {
            $this->uploadImageForUpdate($target->id, $request);
            Session::flash('success', __('lang.PROJECT_UPDATED_SUCCESSFULLY'));
            return redirect()->route('project.index');
        }
    }

    public function uploadImageForUpdate($target, $request) {

        $preFileArr = [];
        if (!empty($target->attachments)) {
            foreach ($target->attachments as $index => $image) {
                $preFileArr[$index] = $image->doc_name;
            }
        }

        $reqPreImage = $request->preImage;

        $preFinalArr = array_intersect_key($preFileArr, $reqPreImage);

        $fileArr = [];
        if ($files = $request->file('doc_name')) {
            foreach ($files as $key => $file) {
                $filePath = 'uploads/attachments/';
                $fileName = uniqid() . "." . date('Ymd') . "." . $file->getClientOriginalExtension();
                $dbName = $filePath . '' . $fileName;
                $file->move($filePath, $fileName);
                $fileArr[$key] = $dbName;
            }
        }


        // if change existing file then it will replace previous file name into new one.
        $replaceExistingFile = array_replace_recursive($preFinalArr, $fileArr);

        $realFileArr = [];
        $j = 0;
        foreach ($replaceExistingFile as $key => $replaceFile) {
            $realFileArr[$j]['issue_type'] = 1;
            $realFileArr[$j]['application_id'] = $target->id ?? null;
            $realFileArr[$j]['doc_name'] = $replaceFile ?? 0;
            $realFileArr[$j]['title'] = $request->title[$key];
            $realFileArr[$j]['serial'] = $request->serial[$key] ?? 0;
            $realFileArr[$j]['status'] = $request->status[$key] ?? 0;
            $j++;
        }


        if (DocumentAttachment::where('application_id', $target->id)->delete()) {
            DocumentAttachment::insert($realFileArr);
            return true;
        }
    }

    public function destroy(Request $request) {
        $target = Project::findOrFail($request->id);
        if ($target->delete()) {
            $notes = Note::where('application_id', $request->id)->where('issue_id', '1')->delete();
            Session::flash('success', __('lang.VISA_DELETED_SUCCESSFULLY'));
            return redirect()->route('visaEntry.index');
        }
    }

    public function projectFilter(Request $request) {
        $url = 'filter=true' . '&search_value=' . $request->search_value;
        return redirect('admin/project?' . $url);
    }

}

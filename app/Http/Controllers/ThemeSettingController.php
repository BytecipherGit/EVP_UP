<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ThemeSettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $getThemeSetting = ThemeSetting::where('company_id', Auth::id())->select('id', 'company_id','key','title','value')->get();
            if (count($getThemeSetting) > 0) {
                $data = $getThemeSetting;

            } else {

                $getThemeSetting = ThemeSetting::where('company_id', 0)->select('id', 'company_id', 'key','title','value')->get();
                if (count($getThemeSetting) > 0) {
                    $data = $getThemeSetting;
                }
            }
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('value', function ($row) {
                if($row->key != 'logo'){

                    $btn = '<i class="colorBox" style="background: '. $row->value .'"></i>';
                } else {
                    $btn = '<img src="'.$row->value.'" style="width:80px; height:40px;">';
                }
                // $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn deleteProcess fa fa-trash" title="Delete"></a>';
                return $btn;
            })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn updateThemeSetting fa fa-edit" title="Edit"></a>';
                    // $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn deleteProcess fa fa-trash" title="Delete"></a>';
                    return $btn;
                })
                
                ->rawColumns(['action','value'])
                ->make(true);
        }
        return view('admin.theme_setting');
    }

    public function getThemeSettingForm($id = '')
    {
        $theme = (!empty($id)) ? ThemeSetting::find($id) : false;
        if(!empty($theme) && $theme->key == 'logo'){
            return view('admin.theme_setting_logo_form', compact('theme'));
        } else if (!empty($theme) && $theme->key == 'primary_color'){
            return view('admin.theme_setting_primary_color_form', compact('theme'));
        } else if (!empty($theme) && $theme->key == 'secondry_color'){
            return view('admin.theme_setting_secondry_color_form', compact('theme'));
        }else if (!empty($theme) && $theme->key == 'button_text_color'){
            return view('admin.theme_setting_button_text_color_form', compact('theme'));
        }else if (!empty($theme) && $theme->key == 'button_background_color'){
            return view('admin.theme_setting_button_background_color_form', compact('theme'));
        }else if (!empty($theme) && $theme->key == 'link_color'){
            return view('admin.theme_setting_link_color_form', compact('theme'));
        }
    }

    public function updateThemeSetting(request $request)
    {

        if (Auth::check()) {
            if($request->theme_id && ($request->theme_type == 'logo') && $request->hasFile('logo')){
                $logo = $request->file('logo');
                $logoFileName = time() . '_' . $logo->getClientOriginalName();
                $logo->storeAs('public/company_logo', $logoFileName);
                $uploadLogoFilePath = asset('storage/company_logo/' . $logoFileName);
                $insertNewCompanyRecords = [
                    'company_id' => Auth::id(),
                    'key' => 'logo',
                    'title' => 'Company Logo',
                    'value' => !empty($uploadLogoFilePath) ? $uploadLogoFilePath : null,
                ];
                $success = ThemeSetting::where('id',$request->theme_id)->update($insertNewCompanyRecords);
                if($success){
                    $request->session()->put('logo', !empty($uploadLogoFilePath) ? $uploadLogoFilePath : null);
                    return redirect('theme_setting');            
                }
            } else if ($request->theme_id && ($request->theme_type == 'primary_color') && $request->primary_color){
                $insertNewCompanyRecords = [
                    'company_id' => Auth::id(),
                    'key' => 'primary_color',
                    'title' => 'Primary Color',
                    'value' => !empty($request->primary_color) ? $request->primary_color : null,
                ];
                $success = ThemeSetting::where('id',$request->theme_id)->update($insertNewCompanyRecords);
                if($success){
                    $request->session()->put('primary_color', !empty($request->primary_color) ? $request->primary_color : null);
                    return redirect('theme_setting');            
                }
            } else if ($request->theme_id && ($request->theme_type == 'secondry_color') && $request->secondry_color){
                $insertNewCompanyRecords = [
                    'company_id' => Auth::id(),
                    'key' => 'secondry_color',
                    'title' => 'Secondary Color',
                    'value' => !empty($request->secondry_color) ? $request->secondry_color : null,
                ];
                $success = ThemeSetting::where('id',$request->theme_id)->update($insertNewCompanyRecords);
                if($success){
                    $request->session()->put('secondry_color', !empty($request->secondry_color) ? $request->secondry_color : null);
                    return redirect('theme_setting');            
                }
            } else if ($request->theme_id && ($request->theme_type == 'button_text_color') && $request->button_text_color){
                $insertNewCompanyRecords = [
                    'company_id' => Auth::id(),
                    'key' => 'button_text_color',
                    'title' => 'Button Text Color',
                    'value' => !empty($request->button_text_color) ? $request->button_text_color : null,
                ];
                $success = ThemeSetting::where('id',$request->theme_id)->update($insertNewCompanyRecords);
                if($success){
                    $request->session()->put('button_text_color', !empty($request->button_text_color) ? $request->button_text_color : null);
                    return redirect('theme_setting');            
                }
            } else if ($request->theme_id && ($request->theme_type == 'button_background_color') && $request->button_background_color){
                $insertNewCompanyRecords = [
                    'company_id' => Auth::id(),
                    'key' => 'button_background_color',
                    'title' => 'Button Background Color',
                    'value' => !empty($request->button_background_color) ? $request->button_background_color : null,
                ];
                $success = ThemeSetting::where('id',$request->theme_id)->update($insertNewCompanyRecords);
                if($success){
                    $request->session()->put('button_background_color', !empty($request->button_background_color) ? $request->button_background_color : null);
                    return redirect('theme_setting');            
                }
            } else if ($request->theme_id && ($request->theme_type == 'link_color') && $request->link_color){
                $insertNewCompanyRecords = [
                    'company_id' => Auth::id(),
                    'key' => 'link_color',
                    'title' => 'Link Color',
                    'value' => !empty($request->link_color) ? $request->link_color : null,
                ];
                $success = ThemeSetting::where('id',$request->theme_id)->update($insertNewCompanyRecords);
                if($success){
                    $request->session()->put('link_color', !empty($request->link_color) ? $request->link_color : null);
                    return redirect('theme_setting');            
                }
            } 

        }
        return redirect('theme_setting');

    }

}

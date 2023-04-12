<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Response;

class SearchController extends Controller
{

    public function index()
    {
        return view('admin.search-history');
    }

// global search function
    public function search(Request $request)
    {
        if (!empty($request->get('filterby')) && !empty($request->get('search'))) {
            switch ($request->get('filterby')) {
                case ('name'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                        <div class="search-hist-pro">
                                        <h2>' . $employee->value . '
                                            <span>React native developer at ByteCipher Private Limited.</span>
                                            <small>' . $employee->current_address . '</small>
                                            <small>4.5 <span>reviews</span></small>
                                            <span class="d-flex">
                                            </span>
                                        </h2>
                                        </div>
                                    </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                            <div class="search-hist-pro">
                            <h2>Not found </h2>
                                </div>
                        </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('email'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('email', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                            <div class="search-hist-pro">
                                            <h2>' . $employee->value . '
                                                <span>React native developer at ByteCipher Private Limited.</span>
                                                <small>' . $employee->current_address . '</small>
                                                <small>4.5 <span>reviews</span></small>
                                                <span class="d-flex">
                                                </span>
                                            </h2>
                                            </div>
                                        </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('mobile'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('phone', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                            <div class="search-hist-pro">
                                            <h2>' . $employee->value . '
                                                <span>React native developer at ByteCipher Private Limited.</span>
                                                <small>' . $employee->current_address . '</small>
                                                <small>4.5 <span>reviews</span></small>
                                                <span class="d-flex">
                                                </span>
                                            </h2>
                                            </div>
                                        </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('empcode'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('empCode', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                            <div class="search-hist-pro">
                                            <h2>' . $employee->value . '
                                                <span>React native developer at ByteCipher Private Limited.</span>
                                                <small>' . $employee->current_address . '</small>
                                                <small>4.5 <span>reviews</span></small>
                                                <span class="d-flex">
                                                </span>
                                            </h2>
                                            </div>
                                        </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('aadhar'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('document_type', 'Aadhar Card')
                        ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                            <div class="search-hist-pro">
                                            <h2>' . $employee->value . '
                                                <span>React native developer at ByteCipher Private Limited.</span>
                                                <small>' . $employee->current_address . '</small>
                                                <small>4.5 <span>reviews</span></small>
                                                <span class="d-flex">
                                                </span>
                                            </h2>
                                            </div>
                                        </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                case ('pan'):
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('document_type', 'Pan Card')
                        ->where('document_number', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                            <div class="search-hist-pro">
                                            <h2>' . $employee->value . '
                                                <span>React native developer at ByteCipher Private Limited.</span>
                                                <small>' . $employee->current_address . '</small>
                                                <small>4.5 <span>reviews</span></small>
                                                <span class="d-flex">
                                                </span>
                                            </h2>
                                            </div>
                                        </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
                default:
                    $employees = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"), "employee.*")
                        ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
                        ->get();
                    $html = '';
                    if (count($employees) > 0) {
                        foreach ($employees as $key => $employee) {
                            $html .= ' <div class="search-hist-page">
                                            <div class="search-hist-pro">
                                            <h2>' . $employee->value . '
                                                <span>React native developer at ByteCipher Private Limited.</span>
                                                <small>' . $employee->current_address . '</small>
                                                <small>4.5 <span>reviews</span></small>
                                                <span class="d-flex">
                                                </span>
                                            </h2>
                                            </div>
                                        </div>';
                        }
                    } else {
                        $html .= '<div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>Not found </h2>
                                    </div>
                            </div>';
                    }
                    return FacadesResponse::json(['success' => true, 'value' => $html]);
                    break;
            }
        } else {
            return FacadesResponse::json([]);
        }

        /*if ($request->get('search')) {
    // $output = "";
    $employees = Employee::select(FacadesDB::raw("CONCAT(first_name,' ', last_name) as value"), "id", "current_address")
    ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')->orWhere('phone', 'LIKE', '%' . $request->get('search') . '%')
    ->orWhere('document_number', 'LIKE', '%' . $request->get('search') . '%')->orWhere('empCode', 'LIKE', '%' . $request->get('search') . '%')
    ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%')
    ->get();
    $html = '';
    if (count($employees) > 0) {
    foreach ($employees as $key => $employee) {
    $html .= ' <div class="search-hist-page">
    <div class="search-hist-pro">
    <h2>' . $employee->value . '
    <span>React native developer at ByteCipher Private Limited.</span>
    <small>' . $employee->current_address . '</small>
    <small>4.5 <span>reviews</span></small>
    <span class="d-flex">
    </span>
    </h2>
    </div>
    </div>';
    }
    } else {
    $html .= '<div class="search-hist-page">
    <div class="search-hist-pro">
    <h2>Not found </h2>
    </div>
    </div>';
    }
    return Response::json(['success' => true, 'value' => $html]);
    }*/

    }
}

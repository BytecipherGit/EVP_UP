<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Response;

class SearchController extends Controller
{

    public function index()
    {
        return view('admin/search-history');
    }
    // public function search(){

    // }

    public function search(Request $request)
    {
        if ($request->get('search')) {
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
        }

    }
}

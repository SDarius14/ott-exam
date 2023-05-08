<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->dob = Carbon::createFromFormat('Y-m-d', $request->input('dob')); // convert the string to a DateTime object
        $employee->email = $request->input('email');
        $employee->contact_number = $request->input('contact_number');

        // calculate age from date of birth
        $age = $employee->dob->diffInYears(Carbon::now());
        $employee->age = $age;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $employee->profile_picture = $filePath;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function export() 
    {
        $employees = Employee::all();
    
        $csv_data = [];
    
        foreach ($employees as $employee) {
            $csv_data[] = [$employee->id, $employee->name, $employee->dob->format('M d, Y'), $employee->age, $employee->contact_number, $employee->email];
        }
    
        $filename = "employees.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename='.$filename,
        ];
    
        return response()->streamDownload(function() use ($csv_data) {
            $file = fopen('php://output', 'w');
            foreach ($csv_data as $data) {
                fputcsv($file, $data);
            }
            fclose($file);
        }, $filename, $headers);
    }
    


}



@extends('employees.dashboard')

@section('employee-content')
<div class="container flex justify-center">

    <div class=" flex flex-col justify-center" >
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3 text-white">Add Employee</a>
        <table class="table bg-white " id="employeeTable" >
            <thead>
                <tr>
                    <th style="padding: 10px;">Profile Picture</th>
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Name</th>
                    <th style="padding: 10px;">Date of Birth</th>
                    <th style="padding: 10px;">Age</th>
                    <th style="padding: 10px;">Contact Number</th>
                    <th style="padding: 10px;">Email</th>

                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td class="align-middle flex justify-center" >
                        @if($employee->profile_picture)
                            <img src="{{ asset('storage/'.$employee->profile_picture) }}" width="50">
                        @else
                            No image
                        @endif
                    </td>
                    <td class="text-center align-middle">{{ $employee->id }}</td>
                    <td class="text-center align-middle">{{ $employee->name }}</td>
                    <td class="text-center align-middle">{{ $employee->dob->format('M d, Y') }}</td>
                    <td class="text-center align-middle">{{ $employee->age }}</td>
                    <td class="text-center align-middle">{{ $employee->contact_number }}</td>
                    <td class="text-center align-middle">{{ $employee->email }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('employees.export') }}" class="btn btn-primary mb-3 text-white">Export</a>

            
    </div>
</div>

@endsection

@extends('employees.dashboard')

@section('employee-content')
<div class="container">
    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col w-2/4 justify-center mx-auto px-5 space-y-4">
                <h3 class="text-gray-900 dark:text-white text-center" >Create Employee</h3>
                <label for="name" class="text-gray-900 dark:text-white" >Name:</label>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Name" > 

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="name" class="text-gray-900 dark:text-white" >Date of Birth:</label>
                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required >

                @error('dob')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="name" class="text-gray-900 dark:text-white" >Email Address:</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address" >

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="name" class="text-gray-900 dark:text-white" >Contact Number:</label>
                <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" required placeholder="Enter Contact Number" >

                @error('contact_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="name" class="text-gray-900 dark:text-white" >Upload Profile Picture:</label>
                <input id="profile_picture" type="file" class="text-gray-900 dark:text-white form-control-file @error('profile_picture') is-invalid @enderror" name="profile_picture" accept="image/*">

                @error('profile_picture')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

        <button type="submit" class="text-white w-60 mx-auto bg-blue-900"> Add Employee </button>
        </div>
    </form>

</div>

    
@endsection
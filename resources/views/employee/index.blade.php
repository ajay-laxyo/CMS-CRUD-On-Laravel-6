@extends('employee.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Check all Employees</h2>
            </div>
            <div class="pull-right" align="right">
                <a class="btn btn-success" href="{{ route('employee.create') }}"> Create new employee record</a>
            </div>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Company</th>
            <th>Profile Picture</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->mobile }}</td>
            <td>{{ $employee->company }}</td>
            <td><img src="{{ url('storage/'.trim($employee->profile, 'public')) }}" height="60" width="60"></td>
            <td>
                <form action="{{ route('employee.destroy',$employee->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('employee.show',$employee->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('employee.edit',$employee->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $employees->links() !!}
      
@endsection
@extends('company.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Check all companies</h2>
            </div>
            <div class="pull-right" align="right">
                <a class="btn btn-success" href="{{ route('company.create') }}"> Create new company record</a>
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
            <th>Company Name</th>
            <th>Company Email</th>
            <th>Company logo</th>
            <th>website</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($companys as $company)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->email }}</td>
            <td><img src="{{ url('storage/'.trim($company->logo, 'public')) }}" height="60" width="60"></td>
            <td>{{ $company->website }}</td>
            <td>
                <form action="{{ route('company.destroy',$company->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('company.show',$company->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $companys->links() !!}
      
@endsection
@extends('layouts.crud')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('profile.create') }}" title="Create a project"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Email Verified at</th>
            <th>Password</th>
            <th>Date Created</th>
            <th>Updated Created</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($cruduser as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ date_format($user->created_at, 'jS M Y') }}</td>
                <td>{{ date_format($user->updated_at, 'jS M Y') }}</td>
                <td>
                    <form action="{{ route('profile.destroy', $user->id) }}" method="POST">

                        <a href="{{ route('profile.show', $user->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('profile.edit', $user->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $cruduser->links() !!}

@endsection

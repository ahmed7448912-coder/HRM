@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">

        <h3>Roles</h3>

        <a href="{{ route('roles.create') }}"
            class="btn btn-primary">

            Create Role

        </a>

    </div>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Name</th>
                <th>Permissions</th>
                <th width="200">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($roles as $role)

            <tr>

                <td>{{ $role->name }}</td>

                <td>

                    @foreach($role->permissions as $permission)

                    <span class="badge bg-success">
                        {{ $permission->name }}
                    </span>

                    @endforeach

                </td>

                <td>

                    <a href="{{ route('roles.edit', $role->id) }}"
                        class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form action="{{ route('roles.destroy', $role->id) }}"
                        method="POST"
                        style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection
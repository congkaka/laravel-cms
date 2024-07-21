@extends('themes.owlio.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>List users</h4>
{{--                    <p class="mb-0">Your business dashboard template</p>--}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                <tr>
                                    <th class="align-middle">Name</th>
                                    <th class="align-middle">User Name</th>
                                    <th class="align-middle pe-7">Phone</th>
                                    <th class="align-middle pe-7">Email</th>
                                    <th class="align-middle">Role</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                                </thead>
                                <tbody id="users">
                                @foreach($users as $user)
                                    <tr class="btn-reveal-trigger">
                                        <td class="py-2">{{ $user->name }}</td>
                                        <td class="py-2">{{ $user->username }}</td>
                                        <td class="py-2">{{ $user->phone }}</td>
                                        <td class="py-2">{{ $user->email }}</td>
                                        <td class="py-2">{{ $user->level }}</td>
                                        <td class="py-2">{{ $user->is_active == 1 ? 'published' : 'pending' }}</td>
                                        <td class="py-2">Delete</td>
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{ $users->appends($_GET)->links('admin.custom.pagination') }}
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush

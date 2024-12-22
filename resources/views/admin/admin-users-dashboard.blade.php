@extends('Components.Admin-Dashboard-Layout')

@section('title', 'Admin Reviews Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/admin-users-dashboard.css') }}">
@endsection

@section('content')
<section id="usersTable">
    <div class="mainContainer">
        <div class="productDisplay">
            <div class="delAddProduct">
                <div class="searchBar">
                    <form id="searchForm" method="GET">
                        <input type="text" id="search" name="search" placeholder="Search">
                        <button type="submit" class="searchBtn">Search</button>
                    </form>
                </div>
            </div>

            <div class="inventory">
                <table class="inventoryTable">
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    action
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
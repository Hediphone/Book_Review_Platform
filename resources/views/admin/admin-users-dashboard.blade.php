@extends('Components.Admin-Dashboard-Layout')

@section('title', 'Admin Users Dashboard')

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
                        <input type="text" id="search" name="search" placeholder="Search by name or email">
                        <button type="submit" class="searchBtn">Search</button>
                        <button type="button" class="clearBtn">Clear</button>
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
                            <th>Violations</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach ($users as $user)
                            <tr class="{{ $user->violations >= 3 ? 'highlight-row' : '' }}">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>{{ $user->violations ?? "-" }}</td>
                                <td>
                                    @if ($user->violations >= 3)
                                        <button id="confirmUserDelete" onclick="showConfirmUserDelete({{ $user->id }})">
                                            <img src="{{ asset('assets/svg/trash.svg') }}" class="trash">
                                        </button>

                                    @else
                                        -
                                    @endif
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

@include('modals.delete-user')

@section('scripts')
<script>
    $(document).ready(function () {
        // Handle the search form submission
        $('#searchForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            var query = $('#search').val(); // Get the search query

            // Send AJAX request
            $.ajax({
                url: '{{ route('admin.users.search') }}', // The URL for the search route
                type: 'GET',
                data: { search: query },
                success: function (response) {
                    // Update the table with the new search results
                    $('#usersTableBody').html(response); // Replace the table body with the new rows
                },
                error: function () {
                    alert('There was an error processing your request.');
                }
            });
        });
    });

    $('.clearBtn').on('click', function () {
        location.reload();
    });

    // Function to show the confirmation modal
    function showConfirmUserDelete(userId) {
        document.getElementById('confirmUserDeleteModal').style.display = 'flex';

        document.getElementById('deleteUserBtn').onclick = function () {
            const deleteUserForm = document.getElementById('deleteUserForm');
            deleteUserForm.action = '/admin/users/delete/' + userId; /
            alert(userId);
            deleteUserForm.submit();
        };

        document.getElementById('cancelUserDeleteBtn').onclick = function () {
            document.getElementById('confirmUserDeleteModal').style.display = 'none'; // Hide the modal
        };
    }

    function closeSuccessUserDeleteModal() {
        document.getElementById('successUserDeleteModal').style.display = 'none';
    }
</script>

@endsection
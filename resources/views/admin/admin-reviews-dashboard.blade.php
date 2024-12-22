@extends('Components.Admin-Dashboard-Layout')

@section('title', 'Admin Reviews Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/admin-reviews-dashboard.css') }}">
@endsection

@section('content')

<section id="reviewsTable">
    <div class="mainContainer">
        <div class="productDisplay">
            <div class="delAddProduct">
                <div class="searchBar">
                    <form id="searchForm" method="GET">
                        <input type="text" id="search" name="search" placeholder="Search">
                        <button type="submit" class="searchBtn">Search</button>
                    </form>
                </div>

                <button class="removeReview" id="removeReviewBtn">Delete
                    Review</button>
                <button class="addReview" id="addReviewBtn">Add Review</button>
            </div>

            <div class="inventory">
                <table class="inventoryTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Book Title</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td><input type="checkbox" name="selectedReviews[]"></td>
                                <td>{{ $review->reviewID }}</td>
                                <td>{{ $review->book->title }}</td>
                                <td>{{ $review->user->name }}</td>
                                <td>{{ number_format($review->rating, 1) }}</td>
                                <td>{{ $review->comment }}</td>
                                <td>{{ $review->created_at }}</td>
                                <td>{{ $review->updated_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i> <!-- Ellipsis Icon -->
                                        </button>
                                        <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item" href="#"
                                                    onclick="showEditReviewModal('{{ $review->reviewID }}')">Edit</a>
                                            </li>
                                        </ul> -->
                                    </div>
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
@if ($reviews->isEmpty())
    <tr>
        <td colspan="10" style="text-align: center; font-weight: bold;">
            @if (isset($query) && $query !== '')
                No matching results found for "<em>{{ $query }}</em>".
            @elseif (isset($rating) && $rating !== 'All')
                No reviews found for rating "{{ $rating }}".
            @else
                No reviews available.
            @endif
        </td>
    </tr>
@else
    @foreach ($reviews as $review)
        <tr>
            <td></td>
            <td><input type="checkbox" name="selectedReviews[]"></td>
            <td>{{ $review->reviewID }}</td>
            <td>{!! $review->book->highlighted_title !!}</td>
            <td>{!! $review->user->highlighted_name !!}</td>
            <td>{{ number_format($review->rating, 1) }}</td>
            <td>{!! $review->highlighted_comment !!}</td>
            <td>{!! $review->highlighted_created_at !!}</td>
            <td>{!! $review->highlighted_updated_at !!}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i> <!-- Ellipsis Icon -->
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
@endif
@if($books->isEmpty())
    <tr>
        <td colspan="11" class="text-center">No results found for "{{ $query }}"</td>
    </tr>
@else
    @foreach ($books as $book)
        <tr>
            <td><input type="checkbox" name="selectedBooks[]"></td>
            <td>{{ $book->bookID }}</td>
            <td><img src="{{ asset($book->cover) }}" alt="Book Cover" style="width: 50px; height: auto;"></td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->genre }}</td>
            <td>
                @if($book->reviews_avg_rating)
                    {{ number_format($book->reviews_avg_rating, 1) }}
                @else
                    N/A
                @endif
            </td>
            <td>{{ $book->description }}</td>
            <td>{{ $book->created_at }}</td>
            <td>{{ $book->updated_at }}</td>
            <td>
                @if($book->release_date)
                    {{ $book->release_date }}
                @else
                    N/A
                @endif
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i> <!-- Ellipsis Icon -->
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" onclick="showEditBookModal('{{ $book->bookID }}')">Edit</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
@endif

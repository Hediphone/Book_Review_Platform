@if ($noResults)
    <tr>
        <td colspan="6" style="text-align: center; font-weight: bold;">
            @if (isset($query) && $query !== '')
                No matching results found for "<em>{{ $query }}</em>".
            @else
                No users available.
            @endif
        </td>
    </tr>
@else
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{!! $user->highlighted_name !!}</td>
            <td>{!! $user->highlighted_email !!}</td>
            <td>{!! $user->highlighted_created_at !!}</td>
            <td>{!! $user->highlighted_updated_at !!}</td>
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
@endif
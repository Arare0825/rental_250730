@foreach($orders as $order)
<tr>
    <td>{{ $order->created_at }}</td>
    <td>{{ $order->room }}</td>
    <td>{{ $order->item_name_ja }}</td>
    <td>{{ $order->quantity }}</td>
    <td>
        <select class="status-select" data-id="{{ $order->id }}">
            @foreach($statusPatterns as $status)
                <option value="{{ $status->status }}"
                    {{ $order->status == $status->status ? 'selected' : '' }}>
                    {{ $status->status_name }}
                </option>
            @endforeach
        </select>
    </td>
</tr>
@endforeach

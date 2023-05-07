<table>
    <thead>
        <tr>
            <th>Order #</th>
            <th>Status</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

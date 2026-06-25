<!DOCTYPE html>
<html>
<head>
    <title>Visitor Register</title>
</head>
<body>

<h1>Visitor Register</h1>

<a href="/visitors/create">Add New Visitor</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>ID Number</th>
        <th>Host</th>
        <th>Department</th>
        <th>Status</th>
    </tr>

    @forelse($visitors as $visitor)
        <tr>
            <td>{{ $visitor->full_name }}</td>
            <td>{{ $visitor->id_number }}</td>
            <td>{{ $visitor->host_name }}</td>
            <td>{{ $visitor->department }}</td>
            <td>{{ $visitor->status }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No visitors found.</td>
        </tr>
    @endforelse

</table>

</body>
</html>

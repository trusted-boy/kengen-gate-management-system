<!DOCTYPE html>
<html>
<head>
    <title>Visitor Check In</title>
</head>
<body>

<h1>Visitor Check In</h1>

<form method="POST" action="{{ route('visitors.store') }}">
    @csrf

    <p>
        <input type="text" name="full_name" placeholder="Full Name" required>
    </p>

    <p>
        <input type="text" name="id_number" placeholder="ID Number" required>
    </p>

    <p>
        <input type="text" name="phone" placeholder="Phone Number">
    </p>

    <p>
        <input type="text" name="organization" placeholder="Organization">
    </p>

    <p>
        <input type="text" name="host_name" placeholder="Host Name" required>
    </p>

    <p>
        <input type="text" name="department" placeholder="Department" required>
    </p>

    <p>
        <textarea name="purpose" placeholder="Purpose of Visit"></textarea>
    </p>

    <button type="submit">Check In Visitor</button>

</form>

</body>
</html>

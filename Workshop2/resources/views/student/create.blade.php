<h1>Create Student</h1>
<form action="/students" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required><br>
    <label for="phone">Phone:</label>   
    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required><br>
    <label for="address">Address:</label>
    <textarea name="address" id="address" required>{{ old('address') }}</textarea><br>
    <label> Date of Birth:</label>
    <input type="date" name="dob" id="dob" value="{{ old('dob') }}" required><br>
    <button type="submit">Create</button>
</form>
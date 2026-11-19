<h1>Student List</h1>
<a href="{{ route('students.create') }}">Add New Student</a>

@if ($students->isEmpty())
    <p>No students found.</p>
@else
   <table>
    <th>
        <td>Id</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Address</td>
        <td>Age</td>
        <td>Actions</td>
    </th>
    @foreach ($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->age }}</td>
            <td>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
                
            </td>
        </tr>
   </table>
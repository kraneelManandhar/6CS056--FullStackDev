<!DOCTYPE html>
<html>
<head>
    <title>Create Course</title>
</head>
<body>
    <h1>Create Course</h1>

    @if($errors->any())
        <div>
            <h3>Please fix the following errors:</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>
        <br>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <br>

        <div>
            <label for="duration">Duration (weeks)</label>
            <input type="number" id="duration" name="duration" min="1" value="{{ old('duration') }}">
        </div>
        <br>

        <div>
            <label for="fee">Fee</label>
            <input type="number" id="fee" name="fee" min="0" step="0.01" value="{{ old('fee') }}">
        </div>
        <br>

        <div>
            <label for="difficulty">Difficulty</label>
            <select id="difficulty" name="difficulty">
                <option value="">-- Select --</option>
                @foreach(['Easy', 'Medium', 'Hard'] as $level)
                    <option value="{{ $level }}" {{ old('difficulty') === $level ? 'selected' : '' }}>
                        {{ $level }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>

        <div>
            <label for="is_active">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}>
                Currently provided (active)
            </label>
        </div>
        <br>

        <button type="submit">Create Course</button>
    </form>

    <br>
    <a href="{{ route('courses.index') }}">Back to Courses</a>
</body>
</html>

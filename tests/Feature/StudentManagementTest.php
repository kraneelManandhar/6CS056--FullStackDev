<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_web_student_resource_supports_crud_operations(): void
    {
        $studentData = [
            'name' => 'Alex Student',
            'email' => 'alex@example.com',
            'phone' => '555-0100',
            'address' => '1 Example Street',
            'date_of_birth' => '2000-05-10',
        ];

        $this->get(route('students.index'))->assertOk();
        $this->get(route('students.create'))->assertOk();

        $this->post(route('students.store'), $studentData)
            ->assertRedirect(route('students.show', 1));

        $student = Student::query()->firstOrFail();

        $this->get(route('students.show', $student))->assertOk();
        $this->get(route('students.edit', $student))->assertOk();

        $this->put(route('students.update', $student), [
            ...$studentData,
            'name' => 'Alex Updated',
        ])->assertRedirect(route('students.show', $student));

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Alex Updated',
        ]);

        $this->delete(route('students.destroy', $student))
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_api_student_resource_supports_crud_operations(): void
    {
        $studentData = [
            'name' => 'Alex Student',
            'email' => 'alex@example.com',
            'date_of_birth' => '2000-05-10',
        ];

        $this->getJson('/api/students')
            ->assertOk()
            ->assertJsonCount(0, 'data');

        $this->postJson('/api/students', $studentData)
            ->assertCreated()
            ->assertJsonPath('data.name', 'Alex Student')
            ->assertJsonPath('data.phone', null);

        $student = Student::query()->firstOrFail();

        $this->getJson("/api/students/{$student->id}")
            ->assertOk()
            ->assertJsonPath('data.email', 'alex@example.com');

        $this->patchJson("/api/students/{$student->id}", ['name' => 'Alex Updated'])
            ->assertOk()
            ->assertJsonPath('data.name', 'Alex Updated');

        $this->deleteJson("/api/students/{$student->id}")->assertNoContent();

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_api_student_creation_requires_a_database_valid_date_of_birth(): void
    {
        $this->postJson('/api/students', [
            'name' => 'Alex Student',
            'email' => 'alex@example.com',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors('date_of_birth');

        $this->assertDatabaseCount('students', 0);
    }
}

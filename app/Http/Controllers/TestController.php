<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestRecource;
use App\Models\Test;

/*
 * Controller is Controller, same as in spring/.NET
 */

class TestController extends Controller
{
    public function createTest(string $name): Test
    {
        return Test::create([
            'test_name' => $name,
        ]);
    }

    public function getTest(int $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TestRecource::collection(Test::where('id', $id)->get());
    }

    public function updateTest(int $id, string $name): Test
    {
        $test = Test::findOrFail($id);
        $test->test_name = $name;
        $test->save();
        return $test;
    }

    public function deleteTest(int $id): Test
    {
        $test = Test::findOrFail($id);
        $test->delete();
        return $test;
    }

    public function addComment(int $id, string $message): Test
    {
        $test = Test::findOrFail($id);

        $test->addComment([
            'message' => $message,
        ]);

        return $test;
    }

    public function testBody() {

    }

}

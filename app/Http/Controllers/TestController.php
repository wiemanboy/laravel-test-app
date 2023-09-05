<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestRecource;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/*
 * Controller is Controller, same as in spring/.NET
 */

class TestController extends Controller
{
    public function createTest(Request $request): Test
    {
        return Test::create([
            'test_name' => $request->input('name')
        ]);
    }

    public function getTest(int $id): TestRecource
    {
        $test = Test::findOrFail($id);

        return TestRecource::make($test);
    }

    public function updateTest(int $id, Request $request): Test
    {
        $test = Test::findOrFail($id);
        $test->update([
            'test_name' => $request->input('name'),
            'is_test' => $request->input('isTest')
        ]);
        $test->save();
        return $test;
    }

    public function deleteTest(int $id): Test
    {
        $test = Test::findOrFail($id);
        $test->delete();
        return $test;
    }

    public function addComment(int $id, Request $request): Test
    {
        $test = Test::findOrFail($id);

        $test->addComment([
            'message' => $request->input('message'),
        ]);

        return $test;
    }

    public function testBody(Request $request): string
    {
        return $request->input('data');
    }

}

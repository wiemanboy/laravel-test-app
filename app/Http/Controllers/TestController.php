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

    public function getTest(int $id): AnonymousResourceCollection
    {
        return TestRecource::collection(Test::where('id', $id)->get());
    }

    public function updateTest(int $id, Request $request): Test
    {
        $test = Test::findOrFail($id);
        $test->test_name = $request->input('name');
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

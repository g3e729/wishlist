<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test */
    public function create()
    {
    	$user = create(User::class, ['name' => 'Tester Name']);

        $this->assertTrue((User::find($user->id)->name ?? null) == 'Tester Name');
    }

    /** @test */
    public function update()
    {
    	$user = create(User::class);
    	$name = 'Test Name';
    	$user->update(compact('name'));

        $this->assertTrue((User::find($user->id)->name ?? null) == $name);
    }

    /** @test */
    public function destroy()
    {
    	$user = create(User::class);
    	$user->delete();

        $this->assertTrue(is_null(User::find($user->id)));
    }
}

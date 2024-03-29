<?php

namespace App\Http\Controllers\Vendor;

use App\Notifications\RestaurantStaffInvitation;
use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\StoreStaffMemberRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class StaffMemberController extends Controller
{
  public function index(): Response
  {
    return Inertia::render('Vendor/Staff/Show');
  }

  public function store(StoreStaffMemberRequest $request): RedirectResponse
  {
    $restaurant = $request->user()->restaurant;
    $attributes = $request->validated();

    $member = DB::transaction(function () use ($attributes, $restaurant) {
      $user = $restaurant->staff()->create([
        'name'     => $attributes['name'],
        'email'    => $attributes['email'],
        'password' => '',
      ]);

      $user->roles()->sync(Role::where('name', RoleName::STAFF->value)->first());

      return $user;
    });

    $member->notify(new RestaurantStaffInvitation($restaurant->name));

    return back();
  }
}

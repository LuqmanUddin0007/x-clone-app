<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Return the authenticated user's profile.
     */
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Update the authenticated user's profile.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'profile_picture'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $user = Auth::user();

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                $user->profile_picture = $request->file('profile_picture')
                    ->store('profile_pictures', 'public');
            }

            $user->save();

            return response()->json([
                'message' => 'Profile updated successfully.',
                'user'    => $user,
                'profile_picture_url' => $user->profile_picture
                    ? asset('storage/' . $user->profile_picture)
                    : null,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());

            return response()->json([
                'error' => 'An error occurred while updating the profile.'
            ], 500);
        }
    }

    /**
     * Return public profile info by user ID.
     */
    public function publicProfile($id)
    {
        try {
            $user = $this->userRepo->find($id);

            if (!$user) {
                return response()->json([
                    'error' => 'User not found.'
                ], 404);
            }

            return response()->json([
                'username'         => $user->username,
                'profile_picture'  => $user->profile_picture
                    ? asset('storage/' . $user->profile_picture)
                    : null,
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching public profile (ID {$id}): " . $e->getMessage());

            return response()->json([
                'error' => 'Failed to load profile.'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404, '|User Tidak Ditemukan');
        }

        return view('settings.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'picture' => 'nullable|image|max:2048',
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Jika ada password baru, hash dan update
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            $validatedData['password'] = $user->password; // Gunakan password lama
        }

        // Proses upload file gambar jika ada
        if ($request->hasFile('picture')) {
            // Hapus gambar lama jika ada
            if ($user->picture && $user->picture !== 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1738810304~exp=1738813904~hmac=36ba34024a046ef13e67ad809abfc3e6db1db8b10b018403ecafd9dee223b6f1&w=740') {
                $publicId = pathinfo($user->picture, PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            // Upload gambar baru ke Cloudinary
            $uploadedFileUrl = Cloudinary::upload($request->file('picture')->getRealPath(), [
                'folder' => 'profile_pictures', // Folder di Cloudinary
                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'fill'
                ]
            ])->getSecurePath();

            $validatedData['picture'] = $uploadedFileUrl;
        }

        // Update data user
        $user->update($validatedData);

        return redirect()->route('setting', $id)->with('success', 'Profile berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

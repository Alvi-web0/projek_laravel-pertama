<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        return view('member.index');
    }

    public function api()
    {
        $data = Member::select(
            'id',
            'nama',
            'email',
            'no_telp',
            'alamat',
            'foto'
        )->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:members,email',
            'no_telp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('members', 'public');
        }

        Member::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'foto' => $foto,
        ]);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $member = Member::findOrFail($id);

        return view('member.edit', compact('member'));
    }

    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'no_telp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ];

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($member->foto) {
                Storage::disk('public')->delete($member->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')
                ->store('members', 'public');
        }

        $member->update($data);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);

        // Hapus foto member dari storage
        if ($member->foto) {
            Storage::disk('public')->delete($member->foto);
        }

        // Hapus data member dari database
        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('success', 'Member berhasil dihapus!');
    }
}
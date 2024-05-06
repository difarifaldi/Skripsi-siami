<?php

namespace Modules\User\Http\Controllers;

use App\Models\JenjangProdi;
use App\Models\Jurusan;
use App\Models\Prodi;
use Modules\User\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Upload\Entities\Upload;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        return $dataTable->render('user::users.index');
    }


    public function create()
    {
        abort_if(Gate::denies('access_user_management'), 403);

        return view('user::users.create');
    }


    public function store(Request $request)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed'
        ]);

        $namaJurusan = $request->input('jurusan');
        $idJurusan = Jurusan::where('nama_jurusan', $namaJurusan)->value('id_jurusan');

        $namaJenjangProdi = $request->input('jenjangProdi');
        $idJenjangProdi = JenjangProdi::where('nama_jenjang_prodi', $namaJenjangProdi)->value('id_jenjang_prodi');

        $namaProdi = $request->input('prodi');
        $idProdi = Prodi::where('nama_prodi', $namaProdi)->value('id_prodi');

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
            'id_jurusan'     => $idJurusan,
            'id_jenjang_prodi'     => $idJenjangProdi,
            'id_prodi'     => $idProdi,
            'ruang_lingkup_audit' => $request->ruang_lingkup_audit,
        ]);

        $user->assignRole($request->role);

        if ($request->has('image')) {
            $tempFile = Upload::where('folder', $request->image)->first();

            if ($tempFile) {
                $user->addMedia(Storage::path('public/temp/' . $request->image . '/' . $tempFile->filename))->toMediaCollection('avatars');

                Storage::deleteDirectory('public/temp/' . $request->image);
                $tempFile->delete();
            }
        }

        toast("User Created & Assigned '$request->role' Role!", 'success');

        return redirect()->route('users.index');
    }


    public function edit(User $user)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        return view('user::users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $namaJurusan = $request->input('jurusan');
        $idJurusan = Jurusan::where('nama_jurusan', $namaJurusan)->value('id_jurusan');

        $namaJenjangProdi = $request->input('jenjangProdi');
        $idJenjangProdi = JenjangProdi::where('nama_jenjang_prodi', $namaJenjangProdi)->value('id_jenjang_prodi');

        $namaProdi = $request->input('prodi');
        $idProdi = Prodi::where('nama_prodi', $namaProdi)->value('id_prodi');

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'is_active' => $request->is_active,
            'id_jurusan'     => $idJurusan,
            'id_jenjang_prodi'     => $idJenjangProdi,
            'id_prodi'     => $idProdi,
            'ruang_lingkup_audit' => $request->ruang_lingkup_audit,
        ]);

        $user->syncRoles($request->role);

        if ($request->has('image')) {
            $tempFile = Upload::where('folder', $request->image)->first();

            if ($user->getFirstMedia('avatars')) {
                $user->getFirstMedia('avatars')->delete();
            }

            if ($tempFile) {
                $user->addMedia(Storage::path('public/temp/' . $request->image . '/' . $tempFile->filename))->toMediaCollection('avatars');

                Storage::deleteDirectory('public/temp/' . $request->image);
                $tempFile->delete();
            }
        }

        toast("User Updated & Assigned '$request->role' Role!", 'info');

        return redirect()->route('users.index');
    }


    public function destroy(User $user)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $user->delete();

        toast('User Deleted!', 'warning');

        return redirect()->route('users.index');
    }
}

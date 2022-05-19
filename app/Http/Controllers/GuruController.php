<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruModel;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->GuruModel = new GuruModel();
    }

    public function index()
    {
        $data = [
            'guru' => $this->GuruModel->allData(),
        ];
        return view('view_guru', $data);
    }

    public function detail($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            \abort(404);
        }
        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('view_detailguru', $data);
    }

    public function add()
    {
        return view('view_addguru');
    }

    public function insert()
    {
        Request()->validate([
            'nip' => 'required|unique:guru,nip|min:6|max:6',
            'nama_guru'=> 'required',
            'mapel' => 'required',
            'foto' => 'required|mimes:png,jpg, jpeg|max:1024',
        ], [
            'nip.required' => 'NIP harus diisi!',
            'nip.unique' => 'NIP sudah ada',
            'nip.min' => 'min 6 karakter',
            'nip.max' => 'max 6 karakter',
            'nama_guru.required' => 'Nama harus diisi',
            'mapel.required' => 'Mapel harus diisi',
            'foto.required' => 'harus diisi',
        ]);

        $file = Request()->foto;
        $fileName = Request()->nip.'.'.$file->extension();
        $file-> move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()-> mapel,
            'foto' => $fileName,
        ];

        $this->GuruModel->addData($data);
        return redirect()->route('guru')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function edit($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            \abort(404);
        }
        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('view_editguru', $data);
    }

    public function update($id_guru)
    {
        Request()->validate([
            'nip' => 'required|unique:guru,nip|min:6|max:6',
            'nama_guru'=> 'required',
            'mapel' => 'required',
            'foto' => 'required|mimes:png,jpg, jpeg|max:1024',
        ], [
            'nip.required' => 'NIP harus diisi!',
            'nip.unique' => 'NIP sudah ada',
            'nip.min' => 'min 6 karakter',
            'nip.max' => 'max 6 karakter',
            'nama_guru.required' => 'Nama harus diisi',
            'mapel.required' => 'Mapel harus diisi',
            'foto.required' => 'harus diisi',
        ]);

        $file = Request()->foto;
        $fileName = Request()->nip.'.'.$file->extension();
        $file-> move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()-> mapel,
            'foto' => $fileName,
        ];

        $this->GuruModel->editData($id_guru, $data);
        return redirect()->route('guru')->with('pesan', 'Data berhasil diperbarui');
    }

    public function delete($id_guru)
    {
        $guru = $this->GuruModel->detailData($id_guru);
        if($guru->foto <> "") {
            unlink(public_path('foto_guru').'/'. $guru->foto);
        }
        $this->GuruModel->deleteData($id_guru);
        return redirect()->route('guru')->with('pesan', 'Data telah di hapus!' );
    }
}

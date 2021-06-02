<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;


class MahasiswaController extends Controller
{
    public function insert()
    {
        $result = DB::insert('insert into mahasiswas (npm, nama_mahasiswa, tempat_lahir, tanggal_lahir,
        alamat, created_at) values (?, ?, ?, ?, ?, ?)',['1822240051','Andre','Palembang',
        '2000-07-20','Lorong Kulit', now()]);
        dump($result);
    }

    public function update()
    {
        $result = DB::update('update mahasiswas set nama_mahasiswa = "Messi", 
        updated_at = now() where npm = ?', ['1822240051']);
        dump($result);
    }

    public function delete()
    {
        $result = DB::delete('delete from mahasiswas where npm = ?', ['1822240051']);
        dump($result);
    }

    public function select()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::select('select * from mahasiswas');
        // dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }

    public function insertQb()
    {
        $result = DB::table('mahasiswas')->insert(
            [
                'npm' => '1822240021',
                'nama_mahasiswa' => 'Budiman',
                'tempat_lahir' =>'Palembang',
                'tanggal_lahir' =>'2000-04-11',
                'alamat' =>'Jl.Jendral Sudirman',
                'created_at' => now()
            ]
        );
        dump($result);
    }

    public function updateQb()
    {
        $result = DB::table('mahasiswas')
            ->where('npm','1822240021')
            ->update(
                [
                    'nama_mahasiswa' => 'eyang',
                    'updated_at' => now()
                ]
                );
            dump($result);
    }

    public function deleteQb()
    {
        $result = DB::table('mahasiswas')
            ->where('npm','=','1822240021')
            ->delete();
        dump($result);
    }

    public function selectQb()
    {
        $kampus ="Universitas Multi Data Palembang";
        $result = DB::table('mahasiswas')->get();
        //dump($result);
        return view('mahasiswa.index',['allmahasiswa'=> $result, 'kampus' => $kampus]);
    }

    public function insertElq()
    {
        $mahasiswa = new Mahasiswa; //instansiasi class Mahasiswa
        $mahasiswa->npm ='1822240022';
        $mahasiswa->nama_mahasiswa ='Ucup';
        $mahasiswa->tempat_lahir ='Makassar';
        $mahasiswa->tanggal_lahir = '2001-03-04';
        $mahasiswa->alamat ='Jl. Kentut';
        $mahasiswa->save();
        dump($mahasiswa);
    }

    public function updateElq()
    {
        $mahasiswa = Mahasiswa::where('npm','1822240022')->first(); //cari data tabel mahasiswas berdasarkan npm
        $mahasiswa->nama_mahasiswa='ronaldo';
        $mahasiswa->save(); //menyimpan data ke tabel mahasiswas
        dump($mahasiswa); //melihat isi $mahasiswa
    }

    public function deleteElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '1822240022')->first();//cari data tabel mahasiswas berdasarkan npm
        $mahasiswa->delete(); //hapus data npm 1822240052
        dump($mahasiswa); //melihat isi $mahasiswa
    }

    public function selectElq()
    {
        $kampus ="Universitas Multi Data Palembang";
        $mahasiswa = Mahasiswa::all();
        // dump ($allmahasiswa);
        return view('mahasiswa.index',['allmahasiswa'=>$mahasiswa,'kampus'=>$kampus]);
    }
}

<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    function index(){
        $siswa = Siswa::with('ekstra')->paginate(40);
        return view('kesiswaan.siswa', ['siswa'=>$siswa]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIS'=>'required',
            'kelas'=>'required',
            'nama_siswa'=>'required',
            'nomor_hp_siswa'=>'required',
            'alamat_siswa'=>'required',
        ],[
            'NIS.required'=>'Harap Isi NIS',
            'nama_siswa.required'=>'Harap Isi Nama',
            'kelas.required'=>'Harap Isi Kelas',
            'nomor_hp_siswa.required'=>'Harap Isi Nomor HP',
            'alamat_siswa.required'=>'Harap Isi Alamat',
        ]);

        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }
            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $email = $request->NIS.'@contoh.com';
            $pass = $request->NIS.'@SMKN1jenpo';

            if(User::where('username', $request->NIS)){
                User::where('username', $request->NIS)->delete();
            }

            $user = User::create([
                'name' => $request->nama_siswa,
                'email' => $email,
                'username' => $request->NIS,
                'password' => $pass,
                'role' => "Siswa",
            ]);

            if($user){
                if(User::where('username', $request->NIS)){
                    // Get Userid by those NIP
                    $userdata = User::where('username', $request->NIS)->first();

                    // Create a user
                    $data = Siswa::create([
                        'NIS' => $request->NIS,
                        'user_id' => $userdata->id,
                        'nama_siswa' => $request->nama_siswa,
                        'kelas' => $request->kelas,
                        'tahun_pelajaran' => '2023/2024',
                        'nomor_hp_siswa' => $request->nomor_hp_siswa,
                        'alamat_siswa' => $request->alamat_siswa,
                    ]);
                    
                    if($data){
                        toast('Data Berhasil Ditambahkan','success');
                        return redirect('/kesiswaan/siswa');
                    }
                } 
            }
        }
    }

    public function show(string $id)
    {
        $siswa = Siswa::with('ekstra')->where('id', $id)->first();
        $email = User::where('id', $siswa->user_id)->first()->email;
        return view('Kesiswaan.editsiswa', ['siswa'=>$siswa, 'email'=>$email]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'NIS'=>'required',
            'kelas'=>'required',
            'nama_siswa'=>'required',
            'nomor_hp_siswa'=>'required',
            'alamat_siswa'=>'required',
        ],[
            'NIS.required'=>'Harap Isi NIS',
            'nama_siswa.required'=>'Harap Isi Nama',
            'kelas.required'=>'Harap Isi Kelas',
            'nomor_hp_siswa.required'=>'Harap Isi Nomor HP',
            'alamat_siswa.required'=>'Harap Isi Alamat',
        ]);

        $updata = [
            'NIS'=>$request->NIS,
            'kelas'=>$request->kelas,
            'nama_siswa'=>$request->nama_siswa,
            'nomor_hp_siswa'=>$request->nomor_hp_siswa,
            'alamat_siswa'=>$request->alamat_siswa,
        ];

        $upuser = [
            'name'=>$request->nama_siswa,
            'username'=>$request->NIS,
            'email'=>$request->email,
        ];
        

        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }
            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $siswa = Siswa::find($id)->first();
            if($siswa){
                Siswa::find($id)->update($updata);
                User::where('id', $siswa->user_id)->update($upuser);
            }
            Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Data');
        }
        return redirect('/kesiswaan/siswa/'.$id);

    }

    public function destroy(string $id)
    {
        $data = Siswa::where('id', $id);
        $acc = User::where('id', $data->first()->user_id);
        if($data){
            $data->delete();
            $acc->delete();
            Alert::success('Berhasil Menghapus', 'Berhasil Menghapus Data');
            return redirect('/kesiswaan/siswa');
        }
    }
}

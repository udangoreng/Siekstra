<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Ekstra;
use App\Models\Pelatih;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PelatihController extends Controller
{
    public function index(request $request){
        $pelatih = Pelatih::with('ekstra')->latest()->paginate(10);
        if($request->cari){
            $pelatih = Pelatih::with('ekstra')
            ->where('nama_pelatih', 'LIKE', '%'.$request->cari.'%')
            ->orWhere('nip', $request->cari)
            ->paginate(10);
        }
        return view('Kesiswaan.pelatih', compact('pelatih'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIP'=>'required',
            'username'=>'required',
            'nama_pelatih'=>'required',
            'nomor_hp_pelatih'=>'required',
            'alamat_pelatih'=>'required',
        ],[
            'NIP.required'=>'Harap Isi NIP',
            'username.required'=>'Harap Isi username',
            'nama_pelatih.required'=>'Harap Isi Nama',
            'nomor_hp_pelatih.required'=>'Harap Isi Nomor HP',
            'alamat_pelatih.required'=>'Harap Isi Alamat',
        ]);

        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }
            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $data = User::where('username', $request->username)->get();
            if(!$data == '[]'){
                Alert::error('Terjadi Kesalahan', $data);
                return redirect()->back();
            }
            // Create user by NIP & Nip password@SMKN1jenpo
            $email = $request->NIP."@contoh.com";
            $pass = $request->username."@SMKN1jenpo";

            $user = User::create([
                'name' => $request->nama_pelatih,
                'email' => $email,
                'username' => $request->username,
                'password' => $pass,
                'role' => "Pelatih",
            ]);
            
            if($user){
                if(User::where('username', $request->username)){
                    // Get Userid by those NIP
                    $userdata = User::where('username', $request->username)->first();

                    // Create a user
                    $data = Pelatih::create([
                        'NIP' => $request->NIP,
                        'user_id' => $userdata->id,
                        'nama_pelatih' => $request->nama_pelatih,
                        'nomor_hp_pelatih' => $request->nomor_hp_pelatih,
                        'alamat_pelatih' => $request->alamat_pelatih,
                    ]);
                    
                    if($data){
                        toast('Data Berhasil Ditambahkan','success');
                        return redirect('/kesiswaan/pelatih');
                    }
                } 
            }
        }
    }

    public function show(string $id)
    {   
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }

        $pelatih = Pelatih::with('ekstra', 'user')->where('id', $id)->first();
        $ekstra = Ekstra::all();
        return view('Kesiswaan.editpelatih', compact('pelatih', 'ekstra', 'thn'));
    }

    public function update(Request $request, string $id)
    {
        $pelatih = Pelatih::find($id);
        $updetail = [
            'NIP'=>$request->NIP,
            'nama_pelatih'=>$request->nama_pelatih,
            'nomor_hp_pelatih'=>$request->nomor_hp_pelatih,
            'alamat_pelatih'=>$request->alamat_pelatih,
        ];

        $userdata = [
            'email'=>$request->email,
            'name'=>$request->nama_pelatih,
            'username'=>$request->NIP,
        ];

        $pelatih->update($updetail);
        User::where('id', $request->user_id)->update($userdata);
        return redirect('kesiswaan/pelatih/'.$id);
       
    }

    public function assign(Request $request, string $id){
        // Check if user with those excact data isnt there
        $data = DB::table('ekstra_diikuti')
                ->where('user_id', $request->id)->where('ekstra_id', $request->ekstra_id)->first();

        if(!$data){
            DB::table('ekstra_diikuti')->insert([
                'user_id' => $request->id, 
                'tahun_ajaran' => $request->tahun_ajaran,
                'ekstra_id' => $request->ekstra_id,
            ]);

            toast('Data Berhasil Ditambahkan','success');
            return redirect('/kesiswaan/pelatih/'.$id);
        }

        Alert::warning('Perhatian', 'Ekstrakurikuler Telah Ditambahkan');
        return redirect('/kesiswaan/pelatih/'.$id);
    }

    public function cancel(Request $request, string $id){
        $data = DB::table('ekstra_diikuti')->where('user_id', '=', $request->user_id)->where('ekstra_id', '=', $request->ekstra_id)->delete();
        return redirect('/kesiswaan/pelatih/'.$id);
        // delete where id = id, ekstra_id = id. Tahun ajaran = tahun ajaran
    }

    public function destroy(string $id)
    {
        $data = Pelatih::where('id', $id);
        $acc = User::where('id', $data->first()->user_id);
        if($data){
            $data->delete();
            $acc->delete();
            Alert::success('Berhasil Menghapus', 'Berhasil Menghapus Ekstrakurikuler');
            return redirect('/kesiswaan/pelatih');
        }
    }
}

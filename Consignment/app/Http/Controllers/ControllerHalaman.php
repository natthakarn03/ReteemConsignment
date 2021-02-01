<?php

namespace App\Http\Controllers;

use App\Courier;
use App\City;
use App\Province;
use App\admins;
use App\banks;
use App\jenisbarangs;
use App\merkbarangs;
use App\pengajuans;
use App\pengirimans;
use App\returs;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Rules\CekEmail;
use App\Rules\CekEmaillogin;
use App\Rules\checkAdmin;
use App\Rules\checkAdminEmail;
use App\Rules\checkAdminP;
use App\Rules\checkEmail;
use App\Rules\checkEmailAdmin;
use App\Rules\checkJenis;
use App\Rules\checkMerk;
use App\Rules\checkNamaBank;
use App\Rules\checkNominal;
use App\Rules\checkPhone;
use App\transaksis;
use App\userpembelis;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ControllerHalaman extends Controller
{
    function pindahHalaman()
    {
        //akan mengembalikan angka random dari 10 sampai 99 ke dalam
        //view view ketika halaman diload
        $angkaRandom = rand(10, 100);
        return view('components.body2', [
            "angka" => $angkaRandom
        ]);

        if (!Cookie::has("datauser")) {
            $user = [];
            Cookie::queue(Cookie::make("datauser", json_encode($user), 50000));
        }
    }


    public function page(Request $request)
    {
        if (Cookie::has('pageNow')) {
            $jsonPage = $request->cookie('pageNow');
            $pageIndex = json_decode($jsonPage);
        }
    }
    public function home()
    {
        // $daftarKatalog = DB::select('select * from pengajuans where STATUS_PENGAJUAN = "1"  ');
        $daftarKatalog = new pengajuans();
        $daftarKatalog = $daftarKatalog::where('STATUS_PENGAJUAN', '1')->get();
        // dd($daftarKatalog::where('status_pengajuan', '1'));
        return view('page.home', [
            "daftarKatalog" => $daftarKatalog
        ]);
    }

    public function register()
    {
        return view('page.register');
    }

    public function login(Request $request)
    {
        // dd($request->cookie('userNowT'));
        return view('page.login');
    }

    public function doRegister(Request $request)
    {
        $userpembelis = new userpembelis();
        $jumUser = $userpembelis::all()->count();

        $request->validate(
            [
                "USERPB_NAME" => ["required"],
                "USERPB_EMAIL" => ["required", "max:50", new checkEmail],
                "USERPB_PHONE_NUMBER" => ["required", "numeric", new checkPhone],
                "USERPB_ADDRESS" => ["required"],
                "USERPB_PASSWORD" => ["required", "confirmed"],
                "USERPB_PASSWORD_confirmation" => ["required"],
                "txtagree" => ["accepted"]
            ],
            [
                "required" => ":attribute harus di isi!!",
                "confirmed" => "Harus sama!!",
                "url" => "Url Harus Benar",
                "email" => "Email tidak valid",
                "numeric" => "Harus Angka",
                "accepted" => "Harus dicentang"
            ],
            [
                "USERPB_NAME" => "Nama Pengguna",
                "USERPB_EMAIL" => "Alamat Email",
                "USERPB_PHONE_NUMBER" => "Nomor Telephone",
                "USERPB_ADDRESS" => "Alamat",
                "USERPB_PASSWORD" => "Password",
                "USERPB_PASSWORD_confirmation" => "Confirm Password",
                "txtagree" => "Agree"
            ]
        );

        $userpembelis = new userpembelis();

        $userpembelis->USERPB_ID = $jumUser;
        $userpembelis->USERPB_NAME = $request->USERPB_NAME;
        $userpembelis->USERPB_EMAIL = $request->USERPB_EMAIL;
        $userpembelis->USERPB_PHONE_NUMBER = $request->USERPB_PHONE_NUMBER;
        $userpembelis->USERPB_ADDRESS = $request->USERPB_ADDRESS;
        $userpembelis->USERPB_PASSWORD = md5($request->USERPB_PASSWORD);

        $userpembelis->save();

        // DB::table('userpembelis')->insert(
        //     [
        //         "USERPB_ID" => $jumUser,
        //         "USERPB_NAME" => $request->USERPB_NAME,
        //         "USERPB_EMAIL" => $request->USERPB_EMAIL,
        //         "USERPB_PHONE_NUMBER" => $request->USERPB_PHONE_NUMBER,
        //         "USERPB_ADDRESS" => $request->USERPB_ADDRESS,
        //         "USERPB_PASSWORD" => $request->USERPB_PASSWORD,
        //     ]
        // );

        return redirect('/register')->with('alert','Success');
    }

    public function pengajuan(Request $request)
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            $user = $request->cookie('userNowT');
            $userE = $request->cookie('userNowE');

            // dd($request->cookie('userNowT'));

            if ($user == "user") {
                $daftarJenis = new jenisbarangs();
                $daftarMerk = new merkbarangs();
                $daftarBank = new banks();
                $dataPengajuan = pengajuans::onlyTrashed()->get();
                $dataUser = userpembelis::where('USERPB_EMAIL', $userE)->get();
                // dd($dataUser[0]->NIK);

                // dd($dataPengajuan);
                // dd($userE);
                // dd($daftarJenis);

                return view('page.pengajuan', [
                    "daftarJenis" => $daftarJenis::all(),
                    "daftarMerk" => $daftarMerk::all(),
                    "daftarBank" => $daftarBank::all(),
                    "dataPengajuan"=>$dataPengajuan,
                    "userEmail"=>$userE,
                    "dataUser"=>$dataUser[0]
                ]);
            } else {
                return redirect('/login');
            }
        }
    }
    public function doApply(Request $request)
    {
        if (Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            $userE = $request->cookie('userNowE');
        }
        $now = DB::selectOne("SELECT NOW() AS now from dual");
        // dd();

        // $dataUser = userpembelis::where('USERPB_EMAIL',$userE)->get();
        // dd($dataUser[0]);
        $request->validate(
            [
                "NAMA_BARANG" => ["required"],
                "FUNGSIONALITAS" => ["required"],
                "DESKRIPSI_BARANG" => ["required"],
                "HARGA_MIN" => ["required", "numeric"],
                "HARGA_MAX" => ["required", "numeric"],
                "FOTO_KIRI" => ["required"],
                "FOTO_KANAN" => ["required"],
                "FOTO_ATAS" => ["required"],
                "FOTO_BAWAH" => ["required"],
                "FOTO_DEPAN" => ["required"],
                "FOTO_BELAKANG" => ["required"],
                "no_rek"=>["required",'numeric'],
                "berat"=>["required"]
            ],
            [
                "required" => ":attribute harus di isi!!",
                "confirmed" => "Harus sama!!",
                "url" => "Url Harus Benar",
                "numeric" => "Harus Angka",
            ],
            [
                "NAMA_BARANG" => "Nama Barang",
                "FUNGSIONALITAS" => "Fungsionalitas",
                "DESKRIPSI_BARANG" => "Deskripsi Barang",
                "HARGA_MIN" => "Harga Minimal",
                "HARGA_MAX" => "Harga Maksimal",
                "FOTO_KIRI" => "Url Foto Kiri",
                "FOTO_KANAN" => "Url Foto Kanan",
                "FOTO_ATAS" => "Url Foto Atas",
                "FOTO_BAWAH" => "Url Foto Bawah",
                "FOTO_DEPAN" => "Url Foto Depan",
                "FOTO_BELAKANG" => "Url Foto Belakang",
                "no_rek" => "Nomor rekening",
                "berat" => "berat",
            ]
        );
        $pengajuans = new pengajuans();
        $pengajuans->ADMINP_ID = "0";
        $pengajuans->weight = $request->berat;
        $pengajuans->MERK_ID = $request->merkBarang;
        $pengajuans->USERPB_ID = $dataUserNow[0]->USERPB_ID;
        $pengajuans->email_penjual = $userE;
        $pengajuans->TRANSAKSI_ID = "0";
        $pengajuans->JENIS_ID = $request->jenisBarang;
        $pengajuans->NAMA_BARANG = $request->NAMA_BARANG;
        $pengajuans->TGL_PENGAJUAN = $now->now;
        $pengajuans->WARNA_BARANGP = "";
        $pengajuans->FUNGSIONALITAS = $request->FUNGSIONALITAS;
        $pengajuans->DESKRIPSI_BARANG = $request->DESKRIPSI_BARANG;
        $pengajuans->STATUS_PENGAJUAN = "0";
        $pengajuans->STATUS_BARANG = "0";
        $pengajuans->FOTO_KIRI = $request->FOTO_KIRI;
        $pengajuans->FOTO_KANAN = $request->FOTO_KANAN;
        $pengajuans->FOTO_ATAS = $request->FOTO_ATAS;
        $pengajuans->FOTO_BAWAH = $request->FOTO_BAWAH;
        $pengajuans->FOTO_DEPAN = $request->FOTO_DEPAN;
        $pengajuans->FOTO_BELAKANG = $request->FOTO_BELAKANG;
        $pengajuans->HARGA_MIN = $request->HARGA_MIN;
        $pengajuans->HARGA_MAX = $request->HARGA_MAX;
        $pengajuans->HARGA_APPROVE = 0;
        $pengajuans->HARGA_JASA = 0;
        $pengajuans->USERPB_IDENTITY = "";
        $pengajuans->bank_id = $request->jenisBank;
        $pengajuans->USERPB_NOREK = $request->no_rek;
        $pengajuans->alasan = null;
        $pengajuans->save();
        //ini pasti berubah otomatis
        return redirect("/pengajuan");
    }
    public function doLogout(Request $request)
    {
        Cookie::queue(Cookie::forget("userNowT"));
        Cookie::queue(Cookie::forget("userNowE"));
        return redirect("/login");
    }
    public function doLogin(Request $request)
    {
        $request->validate(
            [
                "USERPB_EMAIL" => ["required"],
                "USERPB_PASSWORD" => ["required"],
            ],
            [
                "required" => ":attribute harus di isi!!",
            ],
            [
                "USERPB_EMAIL" => "Alamat Email",
                "USERPB_PASSWORD" => "Password",
            ]
        );
        $userpembelis = new userpembelis();
        $admins = new admins();


        $cekAdmin = $admins::where("email", $request->USERPB_EMAIL)
                    ->where("PASSWORD_ADMINP", $request->USERPB_PASSWORD)
                    ->count();
        $request->USERPB_PASSWORD = md5($request->USERPB_PASSWORD);
        // $request->USERPB_PASSWORD = $request->USERPB_PASSWORD;
        $cekUser = $userpembelis::where("USERPB_EMAIL", $request->USERPB_EMAIL)
            ->where("USERPB_PASSWORD", $request->USERPB_PASSWORD)
            ->count();
        if ($cekUser == 1) {
            $dataUserNow = DB::table('userpembelis')->get();
            $dataUserNow = json_decode($dataUserNow);
            //dd($dataUserNow[0]->USERPB_EMAIL);
            Cookie::forget("userNow");
            Cookie::queue("userNow", json_encode($dataUserNow), 60);
            Cookie::forget("userNowT");
            Cookie::queue("userNowT", "user", 60);
            Cookie::forget("userNowE");
            Cookie::queue("userNowE", $request->USERPB_EMAIL, 60);
            return redirect('/pengajuan');
        } else if ($cekAdmin == 1) {
            $admine = $admins::where("email", $request->USERPB_EMAIL)->get();
            // dd($admine[0]->PASSWORD_ADMINP);
            Cookie::forget("userNowT");
            Cookie::queue("userNowT", $admine[0]->PASSWORD_ADMINP . "", 60);
            return redirect('/admin');
        }
        return redirect('/login');
    }

    public function admin(Request $request)
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            $user = $request->cookie('userNowT');
            // dd($request->cookie('userNowT'));
            if ($user == "user") {
                return redirect('/login');
            } else {
                return view('page.admin', [
                    "items" => pengajuans::all()
                ]);
            }
        }
    }
    public function doDelete($id)
    {
        // dd($id);
        $pengajuans = pengajuans::where('PENGAJUAN_ID', $id)->first();
        //sample $id => PNG#
        //example $id => PNG0
        $pengajuans->delete();
        return redirect('/admin');
    }
    public function toDetail($id)
    {
        $pengajuans = pengajuans::withTrashed()->where('PENGAJUAN_ID', $id)->first();
        // dd($pengajuans);
        // dd($pengajuans);
        return view('page.detailpengajuan',[
            'pengajuans'=>$pengajuans,
            'id'=>$id
        ]);
    }
    public function doApprove(Request $req)
    {
        $id = $req->id;
        $hargaApprove = (int)$req->hargaApprove;
        $min =(int) $req->HARGA_MIN;
        $max =  (int)$req->HARGA_MAKS;
        // dd($max);
        if($hargaApprove < $min){
            return redirect('/toDetail/'.$id)->with('alert','Nominal terlalu kecil');
        }else if($hargaApprove > $max){
            return redirect('/toDetail/'.$id)->with('alert','Nominal terlalu besar');
        }else{
            $req->validate([
                'hargaApprove'=>['required','numeric']
            ],[
                'required'=>":attribute harus di isi!",
                'numeric'=>":attribute harus di angka!",
            ]
            );
            if (Cookie::has('userNowT') == false) {
                return redirect('/login');
            } else {
                $user = $req->cookie('userNowT');
                $id_admin = substr($user, 5, 1);
            }
            $pengajuans = pengajuans::where('PENGAJUAN_ID', $id)->first();
            $pengajuans->status_pengajuan = 1;
            $pengajuans->harga_approve = $req->hargaApprove;
            $pengajuans->ADMINP_ID = $id_admin;
            $pengajuans->save();

            return redirect('/admin');
        }

    }
    public function daftaradmin(Request $req)
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            // dd($req->cookie('userNowT'));
            $dataAdmin = admins::withTrashed()->get();
            return view('page.tambahadmin',[
                "dataAdmin"=>$dataAdmin
            ]);
        }
    }
    public function addAdmin(Request $request)
    {
        $request->validate([
            "adminName"=>["required",new checkAdmin()],
            "adminPass"=>["required"],
            "email"=>["required",new checkEmailAdmin()],
        ],[
            "required"=>":attribute Harus di isi!!!",
        ],[
            "adminName"=>"nama admin",
            "adminPass"=>"Password",
            "email"=>"E-mail"
        ]);
        $count = admins::withTrashed()->count();
        $adminNew = new admins();
        $adminNew->ADMINP_ID = $count;
        $adminNew->email = $request->email;
        $adminNew->NAMA_ADMINP = $request->adminName;
        $adminNew->PASSWORD_ADMINP = $request->adminPass;
        $adminNew->save();
        return redirect("/daftaradmin");
    }
    public function deleteAdmin(Request $request)
    {
        $id = $request->butID;
        $admin = admins::withTrashed()->find($id);
        if($admin->trashed()){
            $admin->restore();
        }else{
            $admin->delete();
        }
        return redirect("daftaradmin");
    }
    public function daftarbank()
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            // dd($req->cookie('userNowT'));
            $dataBank = banks::withTrashed()->get();
            return view('page.tambahbank',[
                "dataBank"=>$dataBank
            ]);
        }
    }
    public function addBank(Request $request)
    {
        $request->validate([
            "namaBank"=>["required",new checkNamaBank()],
            "nomorRekening"=>["required"],
            "namaPemilik"=>["required"],
        ],[
            "required"=>":attribute Harus di isi!!!",
        ],[
            "namaBank"=>"nama bank",
        ]);
        $bankNew = new banks();
        $bankNew->nama_bank = $request->namaBank;
        $bankNew->rekening = $request->nomorRekening;
        $bankNew->pemilik = $request->namaPemilik;
        $bankNew->save();
        return redirect("/daftarbank");
    }
    public function deleteBank(Request $request)
    {
        $id = $request->butID;
        $bank = banks::withTrashed()->find($id);
        if($bank->trashed()){
            $bank->restore();
        }else{
            $bank->delete();
        }
        return redirect("daftarbank");
    }

    public function daftarjenis()
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            $dataJenis = jenisbarangs::all();
            return view('page.daftarjenis',[
                "dataJenis"=>$dataJenis
            ]);
        }
    }
    public function addJenis(Request $request)
    {
        $request->validate([
            "namaJ"=>["required",new checkJenis()],
        ],[
            "required"=>":attribute Harus di isi!!!",
        ],[
            "namaJ"=>"nama Jenis",
        ]);
        $count = jenisbarangs::all()->count();
        $jenisNew = new jenisbarangs();
        $jenisNew->JENIS_ID = $count+1;
        $jenisNew->NAMA_JENIS = $request->namaJ;
        $jenisNew->save();
        return redirect("/daftarjenis");
    }

    public function katalog()
    {
        // $daftarKatalog = DB::select('select * from pengajuans where STATUS_PENGAJUAN = "1"  ');
        $daftarKatalog = new pengajuans();
        $daftarKatalog = $daftarKatalog::where('STATUS_PENGAJUAN', '1')->where('STATUS_BARANG',"0")->get();
        // dd($daftarKatalog::where('status_pengajuan', '1'));
        // dd($daftarKatalog[0]->PENGAJUAN_ID);
        return view('page.katalog', [
            "daftarKatalog" => $daftarKatalog
        ]);
    }

    public function detailsbarang($id, Request $request)
    {
        $detailBarang = pengajuans::where('PENGAJUAN_ID',$id)->get();
        // dd($detailBarang[0]);
        $barang = $detailBarang[0];
        return view('page.detailsbarang',[
            'barang'=>$barang
        ]);
    }

    public function checkout($id, Request $request)
    {
        if (Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            if(!Cookie::has("userNowE")){
                return redirect('/login');
            }else{
                $userE = $request->cookie('userNowE');
            }
        }else{
            return redirect('/login')->with('alert-Warning','Harap login dulu');
        }

        $detailBarang = pengajuans::where('PENGAJUAN_ID',$id)->get();
        $userData = userpembelis::where('USERPB_EMAIL',$userE)->get();
        // dd($userData[0]);
        $barang = $detailBarang[0];
        // dd($barang->HARGA_APPROVE);
        // $harga = $barang->HARGA_APPROVE;
        // $harga = number_format($harga);
        // dd($harga);
        // dd($barang);
        // return view('welcome', );
        $couriers = Courier::pluck('title','code');
        // dd($couriers);
        return view('page.checkout',compact('couriers'),[
            'barang'=>$barang,
            'userData'=>$userData[0],
        ]);
    }
    public function bayar(Request $request)
    {
        $id = $request->id;
        if(Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            if(!Cookie::has("userNowE")){
                return redirect('/login');
            }else{
                $userE = $request->cookie('userNowE');
            }
        }else{
            return redirect('/login')->with('alert-Warning','Harap login dulu');
        }
        $dataBank = banks::all();
        $detailBarang = pengajuans::where('PENGAJUAN_ID',$id)->get();
        $userData = userpembelis::where('USERPB_EMAIL',$userE)->get();
        $userPemEmail = $detailBarang[0]->email_penjual;
        $berat = $detailBarang[0]->weight;
        $userPenjual = userpembelis::where('USERPB_EMAIL',$userPemEmail)->get();
        $cityOrigin = $userPenjual[0]->city;
        // dd($request->courier);
        // dd($userPenjual[0]->city);
        // dd($userData[0]->city);
        $cost = RajaOngkir::ongkosKirim([
            'origin'=> $cityOrigin,
            'destination'=> $userData[0]->city,
            'weight'=> $berat,
            'courier'=> $request->courier,
        ])->get();
        $courier_id = $courier_id = Courier::where('code',$request->courier)->get();
        // dd($courier_id[0]->id);
        $asal = City::where('city_id',$cityOrigin)->get();
        // $asalProvinsi = Province
        // dd($asal[0]->title);
        $ke = City::where('city_id',$userData[0]->city)->get();
        // dd($ke[0]->title);
        $costCourier = $cost[0]['costs'][0]['cost'][0]['value'];
        $barang = $detailBarang[0];
        return view('page.bayar',[
            'barang'=>$barang,
            'userData'=>$userData[0],
            'dataBank'=>$dataBank,
            'costCourier'=>$costCourier,
            'courier_id'=>$courier_id[0]->id,
            'asal'=>$asal[0]->title,
            'ke'=>$ke[0]->title,
        ]);
    }

    public function membayar(Request $request)
    {
        if(Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            if(!Cookie::has("userNowE")){
                return redirect('/login');
            }else{
                $userE = $request->cookie('userNowE');
            }
        }else{
            return redirect('/login')->with('alert-Warning','Harap login dulu');
        }

        $rekening = $request->bank;
        $image = $request->BUKTI_TRANSFER;
        $id = $request->id;
        // dd($image);
        if($image == null){
            // dd('ada kesalahan');
            return redirect('/katalog')->with('gagal','a');
        }else{
            // dd($request->costKurir);
            pengajuans::where('PENGAJUAN_ID',$id)->update(['STATUS_BARANG'=>1]);
            $transaksi = new transaksis;
            $transaksi->PENGAJUAN_ID = $id;
            $transaksi->bukti_transfer = $image;
            $transaksi->status = 0;
            $transaksi->email_pembeli = $userE;
            $transaksi->rekening_tujuan = $rekening;
            $transaksi->harga_kurir = $request->costKurir;
            $transaksi->harga_total = $request->costTotal;
            $transaksi->courier_id = $request->courier_id;
            $transaksi->save();
            return redirect('/katalog')->with('berhasil','a');
        }

    }
    public function detailpengajuan()
    {
        return view('page.detailpengajuan');
    }

    public function daftarmerk()
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            $dataMerk = merkbarangs::all();
            return view('page.daftarmerk',[
                "dataMerk"=>$dataMerk
            ]);
        }
    }
    public function addMerk(Request $request)
    {
        $request->validate([
            "namaMerk"=>["required",new checkMerk()],
        ],[
            "required"=>":attribute Harus di isi!!!",
        ],[
            "namaMerk"=>"nama Merk",
        ]);
        $count = merkbarangs::all()->count();
        $merkNew = new merkbarangs();
        $merkNew->MERK_ID = $count+1;
        $merkNew->NAMA_MERK2 = $request->namaMerk;
        $merkNew->save();
        return redirect("/daftarmerk");
    }
    public function daftarretur()
    {
        $dataRetur = returs::where('status',0 )->get();
        $dataUser = userpembelis::all();
        $dataTransaksi = transaksis::all();
        return view('page.daftarretur',[
            'dataRetur'=>$dataRetur,
            'dataUser'=>$dataUser,
            'dataTransaksi'=>$dataTransaksi
        ]);
    }
    public function retur(Request $request)
    {
        if(Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            if(!Cookie::has("userNowE")){
                return redirect('/login');
            }else{
                $userE = $request->cookie('userNowE');
            }
        }else{
            return redirect('/login')->with('alert-Warning','Harap login dulu');
        }
        if(Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            if(!Cookie::has("userNowE")){
                return redirect('/login');
            }else{
                $userE = $request->cookie('userNowE');
            }
        }else{
            return redirect('/login')->with('alert-Warning','Harap login dulu');
        }
        $dataTransaksi = transaksis::where('email_pembeli',$userE)->get();
        $userNow = userpembelis::where('USERPB_EMAIL',$userE)->get();
        // dd($userNow[0]->USERPB_ID);
        $retur = returs::where('USERPB_ID',$userNow[0]->USERPB_ID)->get();
        $barang = pengajuans::all();
        // if (60 - ((new \Carbon\Carbon($dataTransaksi[0]['updated_at'], 'UTC'))->diffInDays()) < 0) {
        //     // dd($dataTransaksi[0]['updated_at']);
        // }
        // dd($dataTransaksi[0]['updated_at']);
        // dd(60 - ((new \Carbon\Carbon($dataTransaksi[0]['updated_at'], 'UTC'))->diffInDays()));
        return view('page.retur',[
            'dataTransaksi'=>$dataTransaksi,
            'userNow'=>$userNow[0],
            'barang'=>$barang,
            'dataRetur'=>$retur
        ]);
    }
    public function returResi($id)
    {
        // dd($id);
        $dataRetur = returs::where('retur_id',$id)->get();
        // dd($dataRetur[0]);
        $transaksi = transaksis::where('transaksi_id',$dataRetur[0]->transaksi_id)->get();
        // dd($transaksi);
        $couriers = Courier::pluck('title','code');
        return view('page.returResi',compact('couriers'),[
            'transaksi'=>$transaksi,
            'retur_id'=>$id
        ]);
    }
    public function doRetur(Request $request)
    {
        if(Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            if(!Cookie::has("userNowE")){
                return redirect('/login');
            }else{
                $userE = $request->cookie('userNowE');
            }
        }else{
            return redirect('/login')->with('alert-Warning','Harap login dulu');
        }
        $request->validate([
            'DESKRIPSI_BARANG'=>['required'],
            'LINK_VIDEO'=>['required','url']
        ],[
            'required'=>':attribute harus di isi',
            'url'=>':attribute harus dalam bentuk link'
        ],[
            'DESKRIPSI_BARANG'=>"deskripsi barang",
            'LINK_VIDEO'=>"Link video"
        ]);
        $retur = new returs;
        $retur->deskripsi = $request->DESKRIPSI_BARANG;
        $retur->link_video = $request->LINK_VIDEO;
        $retur->transaksi_id = $request->transaksi_id;
        $retur->status = 0;
        $userNow = userpembelis::where('USERPB_EMAIL',$userE)->get();
        $retur->USERPB_ID = $userNow[0]->USERPB_ID;
        $retur->save();
        // dd($userNow[0]->USERPB_ID);
        return redirect()->back()->with('alert',"Keluhan telah diajukan");
    }
    public function doDeleteRetur(Request $request)
    {
        // // dd($id);
        // $pengajuans = pengajuans::where('PENGAJUAN_ID', $id)->first();
        // //sample $id => PNG#
        // //example $id => PNG0
        // $pengajuans->delete();
        // return redirect('/admin');

        if($request->butDel == null){
            $retur = returs::where('retur_id',$request->butAcc)->update(['status' => 1]);
            return redirect()->back()->with('alert','Pengajuan retur Diterima');
            // dd($request->butAcc . ' + ' . $request->butDel);
        }
        else{
            $retur = returs::where('retur_id',$request->butDel)->first();
            $retur->delete();
            return redirect()->back()->with('alert','Pengajuan retur ditolak');
        }

    }

    public function barangreject(Request $request)
    {
        if (Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            $userE = $request->cookie('userNowE');
        }

        $items = pengajuans::withTrashed()->get();
        // dd($items);
        $array=null;
        for ($i=0; $i < count($items); $i++) {
            if($items[$i]->email_penjual == $userE && $items[$i]->trashed()){
                $array[] = $items[$i];
            }
        }
        // dd($array);
        return view('page.barangreject',[
            "items" => $array,
        ]);
    }
    public function profile(Request $request)
    {
        if (Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            $userE = $request->cookie('userNowE');
        }else{
            return redirect('/login')->with('alert-Warning','a');
        }
        $dataUser = userpembelis::where('USERPB_EMAIL',$userE)->get();
        // dd($dataUser);
        $couriers = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');

        return view('page.profile',compact('couriers','provinces'),[
            'dataUser'=>$dataUser,
        ]);
    }
    public function changeProfile(Request $request)
    {
        $email = $request->EMAIL_USERe;
        // dd($email);
        $hasil = userpembelis::where('USERPB_EMAIL', $email)->count();
        // dd($hasil);


        $request->validate([
            "NIK_USER"=> ["required"],
            "NOMOR_TELFON"=> ["required"],
            "FOTO_KTP" => ["required","url"],
            "ALAMAT_USER"=>["required"],
            "province_origin"=>["required"],
            "city_origin"=>["required"],
        ],[
            'required'=>':attribute harus ada',
            'url'=>':attribute harus berupa url'
        ]);
        $provinces = $request->province_origin;
        $city = $request->city_origin;
        // dd($city);
        $ktp = $request->FOTO_KTP;
        $nik = $request->NIK_USER;
        $NOMOR_TELFON = $request->NOMOR_TELFON;
        $ALAMAT_USER = $request->ALAMAT_USER;
        // dd($nik);
        // dd($email);
        // dd( userpembelis::where('USERPB_EMAIL', $email)->get());
        userpembelis::where('USERPB_EMAIL', $email)
          ->update(['FOTO_KTP' => $ktp,
                    'NIK'=>$nik,
                    'USERPB_PHONE_NUMBER'=>$NOMOR_TELFON,
                    'USERPB_ADDRESS'=>$ALAMAT_USER,
                    "province"=>$provinces,
                    "city"=>$city]);
        return redirect()->back();
    }

    public function detailbarangreject($id)
    {
        $pengajuans = pengajuans::withTrashed()->where('PENGAJUAN_ID', $id)->first();
        // dd($pengajuans);
        // dd($pengajuans);
        return view('page.detailbarangreject',[
            'pengajuans'=>$pengajuans,
            'id'=>$id
        ]);
    }
    public function doSubmit(Request $request)
    {
        $id = $request->ID_BARANG;
        $NAMA_BARANG = $request->NAMA_BARANG;
        $DESKRIPSI_BARANG = $request->DESKRIPSI_BARANG;
        $HARGA_MIN = $request->HARGA_MIN;
        $HARGA_MAX = $request->HARGA_MAKS;
        // dd($id);
        // dd(pengajuans::withTrashed()->where('PENGAJUAN_ID', (int)$id)->get());
        pengajuans::withTrashed()->where('PENGAJUAN_ID', (int)$id)
          ->update(['NAMA_BARANG' => $NAMA_BARANG,
                    'DESKRIPSI_BARANG'=>$DESKRIPSI_BARANG,
                    'HARGA_MIN' => $HARGA_MIN,
                    'HARGA_MAX'=>$HARGA_MAX]);
        pengajuans::withTrashed()->where('PENGAJUAN_ID', $id)->restore();
        return redirect('/barangreject');
    }

    public function statusbarang(Request $request)
    {
        if (Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            $userE = $request->cookie('userNowE');
        }else{
            return redirect('/login')->with('alert-Warning','a');
        }
        $daftarTransaksi = transaksis::where('email_pembeli',$userE)->get();
        $daftarPengajuan = pengajuans::all();
        return view('page.statusbarang',[
            'daftarTransaksi'=>$daftarTransaksi,
            'daftarPengajuan'=>$daftarPengajuan
        ]);
    }

    public function barangSaya(Request $request)
    {
        if (Cookie::has("userNow")) {
            $jsonUserNow = $request->cookie("userNow");
            $dataUserNow = json_decode($jsonUserNow);
            $userNow = $dataUserNow[0]->USERPB_ID;
            $userE = $request->cookie('userNowE');
        }else{
            return redirect('/login')->with('alert-Warning','a');
        }
        //status barang == 2 maka barang diretur
        $daftarKatalog = pengajuans::where('email_penjual', $userE)->get();
        // dd($daftarKatalog);
        return view('page.barangSaya',[
            "daftarKatalog"=>$daftarKatalog,
        ]);
    }
    public function detailbarangku($id)
    {
        $transaksi = transaksis::where('PENGAJUAN_ID',$id)->get();
        // dd(count($transaksi));
        // dd($transaksi[0]->courier_id);
        if(count($transaksi)>0){
            $courier = Courier::where('id',$transaksi[0]->courier_id)->get();
            // dd($courier[0]->title);
            // dd($transaksi[0]);
            if($transaksi[0]->status == 6){
                $retur = returs::where('transaksi_id',$transaksi[0]->transaksi_id)->get();
                $courier_retur = Courier::where('id',$retur[0]->courier_id)->get();
                // dd($retur[0]->resi);
                // dd($transaksi);
                return view('page.detailBarangSaya',[
                    'transaksi'=>$transaksi,
                    'id'=>$id,
                    'nama_courier'=>$courier_retur[0]->title,
                    'resi'=>$retur[0]->resi
                ]);
            }else{
                // dd($transaksi);
                return view('page.detailBarangSaya',[
                    'transaksi'=>$transaksi,
                    'id'=>$id,
                    'nama_courier'=>$courier[0]->title
                ]);
            }
        }else{

            return view('page.detailBarangSaya',[
                'transaksi'=>$transaksi,
            ]);
        }


    }
    public function batalTransaksi(Request $request)
    {
        // $pengajuans = pengajuans::where('PENGAJUAN_ID', $id)->first();
        // $pengajuans->delete();
        returs::where('transaksi_id',$request->transaksi)->update([
            'status'=>3
        ]);
        $transaksi = transaksis::where('transaksi_id',$request->transaksi)->get();
        pengajuans::where('PENGAJUAN_ID',$transaksi[0]->PENGAJUAN_ID)->update(['STATUS_BARANG'=>3]);
        // dd($transaksi[0]->PENGAJUAN_ID);
        $transaksi = transaksis::where('transaksi_id',$request->transaksi)->first();
        $transaksi->delete();
        // dd($request->transaksi);
        return redirect('/barangSaya');
    }
    public function back()
    {
        return redirect('/barangSaya');
    }
    public function daftarTransaksi()
    {
        $daftarTransaksi = transaksis::where('status','0')->get();
        // dd($daftarTransaksi);
        return view('page.daftarTransaksi',[
            "daftarTransaksi"=>$daftarTransaksi
        ]);
    }
    public function daftarPengirimanDana()
    {
        $daftarTransaksi = transaksis::all();
        // dd($daftarTransaksi);
        return view('page.daftarPengirimanDana',[
            "daftarTransaksi"=>$daftarTransaksi
        ]);
    }
    public function bayarPenjual($id)
    {
        $transaksi = transaksis::where('transaksi_id',$id)->get();
        $pengajuan = pengajuans::where('PENGAJUAN_ID',$transaksi[0]->PENGAJUAN_ID)->get();
        $bank = banks::where('bank_id',$pengajuan[0]->bank_id)->get();
        $user = userpembelis::where('USERPB_EMAIL',$pengajuan[0]->email_penjual)->get();
        // USERPB_NAME
        // dd($user[0]->USERPB_NAME);
        // dd($transaksi[0]);
        // dd($bank[0]->nama_bank);
        $no_rek = $pengajuan[0]->USERPB_NOREK;
        $jumlah = $transaksi[0]->harga_total;
        $bank = $bank[0]->nama_bank;
        $namaUser = $user[0]->USERPB_NAME;
        // dd($namaUser);
        return view('page.bayarPenjual',[
            'id'=>$id,
            'transaksi'=>$transaksi,
            'harga'=>$jumlah,
            'no_rek'=>$no_rek,
            'namaUser'=>$namaUser
            ]
        );
    }
    public function doPay(Request $request)
    {
        $request->validate([
            'Foto_Transaksi'=>['required']
        ]);
        $id = $request->id;
        // dd($request->id);
        transaksis::where('transaksi_id',$id)->update(
            [
                'status'=>7,
                'bukti_transaksi'=>$request->Foto_Transaksi,
                'harga_jasa'=>$request->harga_jasa,
                ]
            );
        return redirect('/daftarPengirimanDana');
    }
    public function detailTransaksi($id)
    {
        $trans = transaksis::where('transaksi_id',$id)->get();
        $id_pengajuan = transaksis::where('transaksi_id',$id)->get();
        $harga = $id_pengajuan[0]->harga_total;
        $id_pengajuan = $id_pengajuan[0]->PENGAJUAN_ID;
        $pengajuan = pengajuans::where('PENGAJUAN_ID',$id_pengajuan)->get();
        // $harga = $pengajuan[0]->HARGA_APPROVE;
        return view('page.transaksiDetail',[
            'transaksi'=>$trans,
            'harga'=>$harga,
            'id'=>$id
        ]);
    }
    public function doSell(Request $request)
    {
        $but = $request->btnAction;
        $id = $request->id;
        // dd($id);

        $id_pengajuan = transaksis::where('transaksi_id',$id)->get();
        $courier_id = $id_pengajuan[0]->courier_id;
        // dd($id_pengajuan[0]->courier_id);
        $id_pengajuan = $id_pengajuan[0]->PENGAJUAN_ID;
        // dd($id_pengajuan);
        if($but == "approve"){
            $pengiriman = new pengirimans();
            $pengiriman->status = 0;
            $pengiriman->transaksi_id = $id;
            $pengiriman->courier_id = $courier_id;
            $pengiriman->save();
            //belum diperiksa = 0; approve belum ada resi = 1 ; tertolak = 2 ; sudah ada resi = 3 ;
            $trans = transaksis::where('transaksi_id',$id)->update([
                'status'=>1
            ]);
        }else{
            $request->validate([
                'alasan'=>['required']
            ],[
                'required'=>":attribute wajib di isi"
            ],[
                'alasan'=>"Alasan"
            ]);
            $trans = transaksis::where('transaksi_id',$id)->update([
                'status'=>2,
                'alasan'=>$request->alasan,
            ]);
            $pengajuan = pengajuans::where('PENGAJUAN_ID',$id_pengajuan)->update([
                'STATUS_BARANG'=>0,
            ]);
        }
        return redirect('/daftarTransaksi');
    }
    public function checkPengiriman(Request $request)
    {
        $id = $request->butSub;
        // dd($id);
        $pengiriman = pengirimans::where('transaksi_id',$id)->get();
        // dd($id);
        // dd($pengiriman[0]->resi);
        $courier = Courier::where('id',$pengiriman[0]->courier_id)->get();
        $courier = $courier[0]->title;
        // dd($courier);
        if(count($pengiriman)<1 == true){
            // dd('true');
        };
        return view('page.checkPengiriman',["pengiriman"=>$pengiriman,"courier"=>$courier,"resi"=>$pengiriman[0]->resi]);
    }
    public function index()
    {
        $couriers = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');
        return view('welcome', compact('couriers','provinces'));
    }
    public function getCities($id)
    {
        $city = City::where('province_id',$id)->pluck('title','city_id');
        // dd($city);
        return json_encode($city);
    }
    public function submit(Request $request)
    {
        dd();
        $cost = RajaOngkir::ongkosKirim([
            'origin'=> $request->city_origin,
            'destination'=> $request->city_destination,
            'weight'=> $request->weight,
            'courier'=> $request->courier,
        ])->get();
        dd($cost[0]['costs'][0]['cost'][0]['value']);
    }
    public function sendResi(Request $request)
    {
        // dd($request->transaksie);
        $request->validate([
            'resi'=>["required"]
        ],[
            'required'=>"resi harus di isi"
        ]);
        $now = DB::selectOne("SELECT NOW() AS now from dual");
        // dd($now->now);
        $transaksi = transaksis::where('transaksi_id',$request->transaksie)->get();
        // dd($transaksi[0]->courier_id);
        $pengiriman = pengirimans::where('transaksi_id',$request->transaksie)->get();
        pengirimans::where('transaksi_id',$request->transaksie)->update(['resi'=>$request->resi,'status'=>1,'tanggal_pengiriman'=>$now->now,'courier_id'=>$transaksi[0]->courier_id]);
        transaksis::where('transaksi_id',$request->transaksie)->update(['status'=>4]);
        // dd($pengiriman[0]);
        return redirect('/barangSaya');
    }
    public function sendResiRetur(Request $request)
    {
        // dd($request->transaksie);
        $request->validate([
            'resi'=>["required"]
        ],[
            'required'=>"resi harus di isi"
        ]);
        // dd($request->courier);
        // dd($request->retur_id);
        // dd($now->now);
        // dd($transaksi[0]->courier_id);
        // dd($pengiriman[0]);
        $retur_id = $request->retur_id;
        $courier_id = Courier::where("code",$request->courier)->get();
        $courier_id = $courier_id[0]->id;
        $resi = $request->resi;
        $now = DB::selectOne("SELECT NOW() AS now from dual");
        $retur = returs::where('retur_id',$retur_id)->get();
        $transaksi = transaksis::where('transaksi_id',$retur[0]->transaksi_id)->get();
        pengajuans::where('PENGAJUAN_ID',$transaksi[0]->PENGAJUAN_ID)->update(['STATUS_BARANG'=>2]);
        returs::where('retur_id',$retur_id)->update(['status'=>2,'resi'=>$resi,'courier_id'=>$courier_id]);
        return redirect('/retur');
    }

    public function konfirmasi(Request $request)
    {
        transaksis::where('transaksi_id',$request->transaksi)->update(['status'=>5]);
        return redirect('/barangSaya');
    }

    public function approved(Request $request)
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            $user = $request->cookie('userNowT');
            // dd($request->cookie('userNowT'));
            if ($user == "user") {
                return redirect('/login');
            } else {
                return view('page.approved', [
                    "items" => pengajuans::all()
                ]);
            }
        }
    }

    public function notapproved(Request $request)
    {
        if (Cookie::has('userNowT') == false) {
            return redirect('/login');
        } else {
            $user = $request->cookie('userNowT');
            // dd($request->cookie('userNowT'));
            if ($user == "user") {
                return redirect('/login');
            } else {
                return view('page.notapproved', [
                    "items" => pengajuans::all()
                ]);
            }
        }
    }
}

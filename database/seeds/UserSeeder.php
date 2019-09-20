<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Lokasi;
use App\Kategori;
use App\Gedung;
use App\Area;
use App\Satuan;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuan = new Satuan();
        $satuan->nama = 'PCS';
        $satuan->save();

        $satuan1 = new Satuan();
        $satuan1->nama = 'Pack';
        $satuan1->save();

        $role = new role();
        $role->nama = 'Admin';
        $role->save();

        $role1 = new role();
        $role1->nama = 'Member';
        $role1->save();

        // $role2 = new role();
        // $role2->nama = 'Staff SO';
        // $role2->save();

        $user = new User();
        $user->name = 'Esa Rizki Hari Utama';
        $user->email = 'utama@raharja.info';
        $user->nik = '970902190725';
        $user->role_id = $role1->id;
        $user->password = bcrypt('02091997');
        $user->save();

        $user2 = new User();
        $user2->name = 'Member Larastock';
        $user2->email = 'member@larastock.com';
        $user2->nik = '450817000725';
        $user2->role_id = $role1->id;
        $user2->password = bcrypt('02091997');
        $user2->save();

        $user1 = new User();
        $user1->name = 'Admin Larastock';
        $user1->email = 'admin@larastock.com';
        $user1->nik = '990909190929';
        $user1->role_id = $role->id;
        $user1->password = bcrypt('17081945');
        $user1->save();

        $lokasi = new Lokasi();
        $lokasi->nama = 'Gudang Hadiah';
        $lokasi->save();

        $lokasi1 = new Lokasi();
        $lokasi1->nama = 'Gudang Sparepart';
        $lokasi1->save();

        $lokasi2 = new Lokasi();
        $lokasi2->nama = 'Gudang IT';
        $lokasi2->save();

        $lokasi3 = new Lokasi();
        $lokasi3->nama = 'IT 1A';
        $lokasi3->lokasi_id = $lokasi2->id;
        $lokasi3->save();

        $lokasi4 = new Lokasi();
        $lokasi4->nama = 'IT 1B';
        $lokasi4->lokasi_id = $lokasi2->id;
        $lokasi4->save();  

        $lokasi5 = new Lokasi();
        $lokasi5->nama = 'HA 1A';
        $lokasi5->lokasi_id = $lokasi->id;
        $lokasi5->save();

        $lokasi6 = new Lokasi();
        $lokasi6->nama = 'HA 1B';
        $lokasi6->lokasi_id = $lokasi->id;
        $lokasi6->save();

        $lokasi7 = new Lokasi();
        $lokasi7->nama = 'SP 1A';
        $lokasi7->lokasi_id = $lokasi1->id;
        $lokasi7->save();

        $lokasi8 = new Lokasi();
        $lokasi8->nama = 'SP 1B';
        $lokasi8->lokasi_id = $lokasi1->id;
        $lokasi8->save();              

        $kategori = new Kategori();
        $kategori->nama = 'Keyboard';
        $kategori->save();

        $kategori1 = new Kategori();
        $kategori1->nama = 'Mouse';
        $kategori1->save();

        $area = new Area();
        $area->nama = 'Jatabek, Jabar 1 & Jabar 2';
        $area->save();

        $area1 = new Area();
        $area1->nama = 'Luar Kota';
        $area1->save();

        $area2 = new Area();
        $area2->nama = 'Luar Pulau';
        $area2->save();

        $gedung = new Gedung();
        $gedung->area_id = $area->id;
        $gedung->nama = 'SG Rangkas';
        $gedung->alamat = 'JL Multatuli, No. 71, Muara Ciujung Bar., Kec. Rangkasbitung, Kabupaten Lebak, Banten 42312';
        $gedung->save();
    }
}

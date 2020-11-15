<?php

use Illuminate\Database\Seeder;

class OrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_detail')->delete();
        DB::table('order_detail')->insert(
           [
				['id' => 1, 'name' => 'Áo khoác','code'=>'AK001', 'price' => 100000, 'quantity'=> 1, 'image'=>'ao-khoac.jpg', 'orders_id'=> 1 ],
				['id' => 2, 'name' => 'Áo nữ phối viễn','code'=>'AN001',  'price' => 150000, 'quantity'=> 2,  'image'=>'ao-nu-phoi-vien.jpg','orders_id'=> 1 ],
				['id' => 3, 'name' => 'Áo nữ sơ mi cổ đúc','code'=>'AN002', 'price' => 350000, 'quantity'=> 3, 'image'=>'ao-nu-so-mi-co-co-duc.jpg','orders_id'=> 2 ],
				['id' => 4, 'name' => 'Quần kaki đỏ mận','code'=>'KAKI', 'price' => 350000, 'quantity'=> 4,  'image'=>'quan-kaki-do-man-qk162-8273.jpg','orders_id'=> 3 ],
				['id' => 5, 'name' => 'Áo nữ sơ mi chấm bi','code'=>'AN003', 'price' => 350000, 'quantity'=> 5, 'image'=>'ao-nu-so-mi-cham-bi.jpg','orders_id'=> 3 ],
           ]
       );
    }
}

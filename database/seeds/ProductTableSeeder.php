<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        DB::table('products')->insert(
        	[
        		['id' => 1, 'name' => 'Áo khoác','code'=>'AK001', 'slug'=>'ao-khoac', 'price' => 100000, 'featured' => 1, 'state' => 1, 'info'=>'Áo khoác nam', 'describer'=> 'Áo khoác thu đông nam', 'image'=>'ao-khoac.jpg', 'categories_id'=> 2 ],
        		['id' => 2, 'name' => 'Áo nữ phối viễn','code'=>'AN001', 'slug'=>'ao-nu-phoi-vien', 'price' => 150000, 'featured' => 1, 'state' => 1, 'info'=>'Áo nữ phối viền', 'describer'=> 'Áo nữ phối viền', 'image'=>'ao-nu-phoi-vien.jpg','categories_id'=> 5 ],
        		['id' => 3, 'name' => 'Áo nữ sơ mi cổ đúc','code'=>'AN002', 'slug'=>'ao-nu-so-mi-co-duc', 'price' => 350000, 'featured' => 1, 'state' => 1, 'info'=>'Áo nữ sơ mi có cổ đúc', 'describer'=> 'Áo nữ sơ mi có cổ đúc', 'image'=>'ao-nu-so-mi-co-co-duc.jpg','categories_id'=> 5 ],
        		['id' => 4, 'name' => 'Quần kaki đỏ mận','code'=>'KAKI', 'slug'=>'quan-kaki-do-man', 'price' => 350000, 'featured' => 1, 'state' => 1, 'info'=>'Quần kaki đỏ mận', 'describer'=> 'Quần kaki đỏ mận', 'image'=>'quan-kaki-do-man-qk162-8273.jpg','categories_id'=> 3 ],
        		['id' => 5, 'name' => 'Áo nữ sơ mi chấm bi','code'=>'AN003', 'slug'=>'ao-nu-so-mi-cham-bi', 'price' => 350000, 'featured' => 1, 'state' => 1, 'info'=>'Áo nữ sơ mi chấm bi', 'describer'=> 'Áo nữ sơ mi chấm bi', 'image'=>'ao-nu-so-mi-cham-bi.jpg','categories_id'=> 3 ],
	        ]
	    );
    }
}

<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$arrayCategories =  array(
    		array('parent_id' => '0', 'depth' => '1'),
    		array('parent_id' => '0', 'depth' => '2'),
    		array('parent_id' => '0', 'depth' => '3'),
    	);

    	$arrCategoryTranslation = array(
    		array('name' => 'PHP', 'description' => 'Học lập trình php', 'slug' => 'lap-trình-php', 'meta_title' => 'PHP, JS, Database, Website', 'meta_description' => 'Học lập trình php và những ngôn ngữ Javascrip', 'meta_data' => '1', 'locale'=> 'vi', 'category_id' => '1'),
    		array('name' => 'Javascrip', 'description' => 'Học lập trình Javascrip', 'slug' => 'lap-trình-javascrip', 'meta_title' => 'PHP, JS, Database, Website', 'meta_description' => 'Học lập trình php và những ngôn ngữ Javascrip', 'meta_data' => '1', 'locale'=> 'vi', 'category_id' => '2'),
    		array('name' => 'Database', 'description' => 'Học lập trình Database', 'slug' => 'database-sql', 'meta_title' => 'PHP, JS, Database, Website', 'meta_description' => 'Học database và những ngôn ngữ Javascrip| Database', 'meta_data' => '1', 'locale'=> 'vi', 'category_id' => '3'),
    	);

        DB::table('categories')->insert($arrayCategories);
        DB::table('categories_translation')->insert($arrCategoryTranslation);
    }
}

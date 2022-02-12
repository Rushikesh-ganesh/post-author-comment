<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PostSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post')->truncate();
        DB::table('post')->insert([
            [
                'id'=>1,
                'author_id' => '1',
                'post_title'=>'Child Internet Safety',
                'post_description'=>'KEEPING CHILDREN SAFE ON THE INTERNET It should come as a surprise to no one that the Internet can be a dangerous place. Sure, the Internet allows you to access information at your leisure and connect with people in faraway places easily; however, you never know who may try to ',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'id'=>2,
                'author_id' => '2',
                'post_title'=>'Mental Health Tips: Back to School',
                'post_description'=>'Wisdom is not a product of schooling but of the lifelong attempt to acquire it.” ― Albert Einstein In-Person Classes Good morning and happy first day of classes! Getting back into a school routine can be very challenging after experiencing an online platform during the pandemic',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'id'=>3,
                'author_id' => '3',
                'post_title'=>'Dog Tips: Toxic Foods to Avoid',
                'post_description'=>'As a dog owner, its extremely important to know what types of food are toxic for your furry friend. Moreover, many people may be tempted to give their dog all of their food scraps, but this is not a good habit to get into',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'id'=>4,
                'author_id' => '4',
                'post_title'=>'Success Stories Within The IDD Community: Josh Blue',
                'post_description'=>'Josh Blue is an American comedian. He lives with cerebral palsy, but instead of letting that hinder him, he uses his disability as fuel for his comedy work. Early Life: Josh Blue was born on November 27, 1978, in Cameroon, which is a country in Central Africa',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'id'=>5,
                'author_id' => '5',
                'post_title'=>'Success Stories Within The IDD Community: Isabella Springmuhl Tejada',
                'post_description'=>'Isabella Springmuhl Tejada is a Guatemalan fashion designer. Living with Down Syndrome has presented her with many obstacles and challenges. But with strength and perseverance, she has overcome them all and built a successful career for herself! She is one of the most well-known fashion designers in Guatemala',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],            
        ]);
    }
}

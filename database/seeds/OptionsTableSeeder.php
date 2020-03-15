<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();
        DB::table('options')->insert(
            [
                [
                    'name' => '文章每页显示数量',
                    'title' => 'page_size',
                    'form_type' => 1,
                    'placeholder' => '文章每页显示数据',
                    'create_time' => $time,
                    'value' => 20,
                ],
                [
                    'name' => '列表页文章缩略图',
                    'title' => 'list_show_article_thumb',
                    'form_type' => 5,
                    'create_time' => $time,
                    'value' => 1,
                    'placeholder' => '',
                ],
                [
                    'name' => '开启图床',
                    'title' => 'open_figure_bed',
                    'form_type' => 5,
                    'create_time' => $time,
                    'value' => 1,
                    'placeholder' => '',
                ],
                [
                    'name' => '备案号',
                    'title' => 'beian_record',
                    'form_type' => 1,
                    'placeholder' => '网站备案号1',
                    'create_time' => $time,
                    'value' => '',
                ],
                [
                    'name' => '显示备案号',
                    'title' => 'beian_record_show',
                    'form_type' => 5,
                    'create_time' => $time,
                    'value' => '',
                    'placeholder' => '',
                ],
                [
                    'name' => '统计代码',
                    'title' => 'site_stat_code',
                    'form_type' => 3,
                    'create_time' => $time,
                    'value' => '',
                    'placeholder' => '',
                ],
            ]
        );
    }
}

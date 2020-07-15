<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['プライベート', '仕事', '旅行'];
        $articles = ['テスト1', 'テスト2', 'テスト3'];

        foreach (array_map(NULL, $titles, $articles) as [$title, $article]) {
            DB::table('articles')->insert([
                'title' => $title,
                'article' => $article,
                'user_id' => 1,
                'created_at' => \Carbon::now(),
                'updated_at' => \Carbon::now(),
            ]);
        }
    }
}

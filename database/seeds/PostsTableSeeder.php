<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = App\User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('password')
        ]);

        $author2 = App\User::create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'password' => Hash::make('password')
        ]);

        $category1 = Category::create([
            'name' => 'News',
        ]);
        $category2 = Category::create([
            'name' => 'Marketing',
        ]);
        $category3 = Category::create([
            'name' => 'Design',
        ]);

        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'category_id' => $category1->id,
            'image' => 'posts/6.jpg',
            'user_id' =>$author1->id
        ]);
        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'category_id' => $category2->id,
            'image' => 'posts/7.jpg'
        ]);
        $post3 = $author1->posts()->create([
            'title' => 'Best practice for minimalist design with example',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'category_id' => $category3->id,
            'image' => 'posts/8.jpg'
        ]);
        $post4 = $author2->posts()->create([
            'title' => 'Congratulations and thanks to Maryam for joining our team',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'category_id' => $category2->id,
            'image' => 'posts/9.jpg'
        ]);
        $tag1 = Tag::create([
            'name' => 'job'
        ]);
        $tag2 = Tag::create([
            'name' => 'customers'
        ]);
        $tag3 = Tag::create([
            'name' => 'record'
        ]);
        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag3->id]);
    }
}

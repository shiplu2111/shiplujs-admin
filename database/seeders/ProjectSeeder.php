<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\Category;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
        Project::create([
            'title' => 'We Create digital Product For Business',
            'slug' => Str::slug('We Create digital Product For Business'),
            'short_description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque seeney laudantium totam rem aperiam eaque ipsa quae abillo inventore veritatis',
            'description' => 'Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aufugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam estqui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid consequature',
            'related_service' => [
                ['id' => '2fd2c110-cd0d-4119-af05-21c06844f14b', 'service' => 'Branding & Design'],
                ['id' => '3fd41468-edff-4843-82ae-eea5616f0878', 'service' => 'Web Development'],
                ['id' => '4c52e4f7-767f-4498-b0d9-7dee7296002a', 'service' => 'Mobile Apps Design'],
                ['id' => '6f530c96-ee56-44b1-bad3-49247f480fa0', 'service' => 'Graphics Design'],
                ['id' => 'f9e532e8-f3a9-4b58-9d67-43535dfd544a', 'service' => 'Digital Marketing'],
                ['id' => '4287c2ba-ea54-4bd7-b849-f8fe1bf05b8d', 'service' => 'Product Design'],
            ],
            'category_id' => Category::latest()->value('id'),
            'client' => 'X_Design Studio',
            'location' => 'Melbourne, Australia',
            'published_at' => 'September 25, 2023',
            'image' => null, // Add path if image available
            'project_image_1' => null,
            'project_image_2' => null,
            'project_image_3' => null,
            'project_summery' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
            'tags' => ['Design', 'Figma', 'Apps'],
            'status' => true,
        ]);
    }
}

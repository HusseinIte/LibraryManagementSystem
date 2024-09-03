<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            "title" => "Clean Code: A Handbook of Agile Software Craftsmanship",
            "author" => "Robert C. Martin",
            "description" => "A guide for software developers on how to write clean, readable, and maintainable code. The book provides best practices, principles, and case studies to help developers produce code that is both effective and easy to understand.",
            "published_at" => "2008-08-11",
            "category_id" => 1
        ]);

        Book::create([
            "title" => "The Pragmatic Programmer: Your Journey to Mastery",
            "author" => "Andrew Hunt and David Thomas",
            "description" => "A classic book on software development that covers a wide range of topics, including code organization, debugging, and problem-solving. It offers practical advice and tips for becoming a more effective and adaptable programmer.",
            "published_at" => "1999-10-30",
            "category_id" => 1
        ]);
        Book::create([
            "title" => "Sapiens: A Brief History of Humankind",
            "author" => "Yuval Noah Harari",
            "description" => "A sweeping narrative that explores the history of humankind, from the emergence of Homo sapiens in the Stone Age to the present, analyzing how biology and history have defined us. The book covers the cognitive, agricultural, and scientific revolutions that shaped the modern world.",
            "published_at" => "2011-09-04",
            "category_id" => 2
        ]);
        Book::create([
            "title" => "Guns, Germs, and Steel: The Fates of Human Societies",
            "author" => "Jared Diamond",
            "description" => "A groundbreaking work that examines the factors that led to the differing development of human societies around the world. Diamond argues that geography, biology, and environmental factors played crucial roles in shaping the fates of civilizations.",
            "published_at" => "1997-03-01",
            "category_id" => 2
        ]);
        Book::create([
            "title" => "Prisoners of Geography: Ten Maps That Tell You Everything You Need to Know About Global Politics",
            "author" => "Tim Marshall",
            "description" => "A fascinating exploration of how geography shapes the political landscape of the world. The book uses ten maps to explain the geopolitical strategies of world powers and how natural barriers, resources, and climate influence global conflicts and international relations.",
            "published_at" => "2015-07-28",
            "category_id" => 3
        ]);
        Book::create([

            "title" => "The Power of Geography: Ten Maps That Reveal the Future of Our World",
            "author" => "Tim Marshall",
            "description" => "A sequel to 'Prisoners of Geography,' this book continues to explore how geographical factors affect global politics. It examines the geopolitics of ten regions that will shape the future, from Australia and the Sahel to Space and Saudi Arabia.",
            "published_at" => "2021-04-22",
            "category_id" => 3
        ]);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModuleText;

class ModuleTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             $data = [
    'about_title' => 'Professional Problem Solutions For Digital Products',
    'about_sub_title' => 'We provide innovative and tailored digital solutions to meet your business challenges effectively.',

    'service_title' => 'My Special Service For your Business Development',
    'service_sub_title' => 'Discover strategic services designed to accelerate growth and strengthen your brand.',

    'skill_title' => 'Let’s Explore Popular Skills & Experience',
    'skill_sub_title' => 'A comprehensive showcase of my expertise in modern tools, technologies, and methodologies.',

    'portfolio_title' => 'Explore My Popular Projects',
    'portfolio_sub_title' => 'Browse through some of the high-impact projects I’ve successfully delivered for clients.',

    'testimonial_title' => 'I’ve 1253+ Clients Feedback',
    'testimonial_sub_title' => 'Hear what clients are saying about the quality and impact of my work.',

    'price_title' => 'Amazing Pricing For your Projects',
    'price_sub_title' => 'Flexible and competitive pricing plans tailored to fit your project requirements.',

    'blog_title' => 'Latest News & Blog',
    'blog_sub_title' => 'Stay updated with insights, trends, and tips from the digital development world.',

    'contact_title' => 'Let’s Talk For your Next Projects',
    'contact_sub_title' => 'Have a project in mind? Let’s discuss how we can bring your ideas to life.',

    'client_title' => 'I’ve 1253+ Global Clients & lot’s of Project Complete',
    'client_sub_title' => 'Proudly serving a diverse global clientele across various industries.',

    'faq_title' => 'Professional Solutions For Your Digital Product Design and Development',
    'faq_sub_title' => 'Find answers to common questions about my services, process, and expertise.',

    'education_title' => 'Education',
    'education_sub_title' => 'A look into my academic background and professional qualifications.',

    'experience_title' => 'Experience',
    'experience_sub_title' => 'An overview of my journey and achievements across various roles and industries.',

    'certificate_title' => 'Certificate',
    'certificate_sub_title' => 'Recognitions and certifications that validate my professional capabilities.',

    'training_title' => 'Training',
    'training_sub_title' => 'Continuous learning and training programs that enhanced my expertise.',

    'social_title' => 'Social Media',
    'social_sub_title' => 'Connect with me and stay updated on various platforms.',

    'casestudy_title' => 'Case Studies',
    'casestudy_sub_title' => 'A collection of real-world examples of my work.',
];



        ModuleText::create($data);
    }
}


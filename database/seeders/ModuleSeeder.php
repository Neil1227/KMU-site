<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'title' => 'Sibul TBI Module on Banana Chips Processing',
                'file' => 'Sibul TBI Module on Banana Chips Processing.pdf',
                'png' => 'Sibul TBI Module on Banana Chips Processing.png',
            ],
            [
                'title' => 'Sibul TBI Module on Business Model Canvas and Business Plan Preparation',
                'file' => 'Sibul TBI Module on Business Model Canvas and Business Plan Preparation.pdf',
                'png' => 'Sibul TBI Module on Business Model Canvas and Business Plan Preparation.png',
            ],
            [
                'title' => 'Sibul TBI Module on Catfish Farming in Traditional and Biofloc Technology',
                'file' => 'Sibul TBI Module on Catfish Farming in Traditional and Biofloc Technology.pdf',
                'png' => 'Sibul TBI Module on Catfish Farming in Traditional and Biofloc Technology.png',
            ],
            [
                'title' => 'Sibul TBI Module on Design Thinking',
                'file' => 'Sibul TBI Module on Design Thinking.pdf',
                'png' => 'Sibul TBI Module on Design Thinking.png',
            ],
            [
                'title' => 'Sibul TBI Module on Entrepreneurial Mindset',
                'file' => 'Sibul TBI Module on Entrepreneurial Mindset.pdf',
                'png' => 'Sibul TBI Module on Entrepreneurial Mindset.png',
            ],
            [
                'title' => 'Sibul TBI Module on Goat Farming Practices in the Philippines',
                'file' => 'Sibul TBI Module on Goat Farming Practices in the Philippines.pdf',
                'png' => 'Sibul TBI Module on Goat Farming Practices in the Philippines.png',
            ],
            [
                'title' => 'Sibul TBI Module on Hydroponics Farming',
                'file' => 'Sibul TBI Module on Hydroponics Farming.pdf',
                'png' => 'Sibul TBI Module on Hydroponics Farming.png',
            ],
            [
                'title' => 'Sibul TBI Module on Intellectual Property Rights',
                'file' => 'Sibul TBI Module on Intellectual Property Rights.pdf',
                'png' => 'Sibul TBI Module on Intellectual Property Rights.png',
            ],
            [
                'title' => 'Sibul TBI Module on Introduction to Digital Marketing',
                'file' => 'Sibul TBI Module on Introduction to Digital Marketing.pdf',
                'png' => 'Sibul TBI Module on Introduction to Digital Marketing.png',
            ],
            [
                'title' => 'Sibul TBI Module on Investment Readiness Level',
                'file' => 'Sibul TBI Module on IRL.pdf',
                'png' => 'Sibul TBI Module on IRL.png',
            ],
            [
                'title' => 'Sibul TBI Module on Legal Matters for Start Ups',
                'file' => 'Sibul TBI Module on Legal Matters for Start Ups.pdf',
                'png' => 'Sibul TBI Module on Legal Matters for Start Ups.png',
            ],
            [
                'title' => 'Sibul TBI Module on Obligations and Contracts',
                'file' => 'Sibul TBI Module on Obligations and Contracts.pdf',
                'png' => 'Sibul TBI Module on Obligations and Contracts.png',
            ],
            [
                'title' => 'Sibul TBI Module on Onion processing and other Onion Products',
                'file' => 'Sibul TBI Module on Onion processing and other Onion Products.pdf',
                'png' => 'Sibul TBI Module on Onion processing and other Onion Products.png',
            ],
            [
                'title' => 'Sibul TBI Module on Product Development',
                'file' => 'Sibul TBI Module on Product Development.pdf',
                'png' => 'Sibul TBI Module on Product Development.png',
            ],
            [
                'title' => 'Sibul TBI Module on Technology Readiness Level',
                'file' => 'Sibul TBI Module on TRL.pdf',
                'png' => 'Sibul TBI Module on TRL.png',
            ],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}

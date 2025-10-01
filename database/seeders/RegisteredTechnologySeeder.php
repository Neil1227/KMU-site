<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegisteredTechnology;

class RegisteredTechnologySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'technology' => 'Bamboo Shoots Kimchi',
                'technology_generator' => 'Gatan, Mary Grace B.',
                'description' => 'Bamboo kimchi is a dish of salted and fermented vegetables, specifically bamboo shoots. Different kinds of seasoning were used such as garlic, onion, ginger, bell pepper etc. Bamboo kimchi can be used as a side dish or appetizer and can also be used as an ingredient in a dish like kimchi rice.',
                'link' => 'https://docs.google.com/document/d/1UI_xbP4kCoLpnx4TSFs5akU7ivoI0M36wRTthsv_Rms/edit?tab=t.0',
            ],
            [
                'technology' => 'Bamboo Leaves Briquette',
                'technology_generator' => 'Lyndon Solis, Madelleine Solis',
                'description' => 'The Bamboo Leaves Briquette is an eco-friendly and sustainable biofuel made from dried and pulverized bamboo leaves combined with cassava starch as a natural binder. Shaped into compact blocks, these briquettes are designed to serve as an alternative to traditional wood charcoal and liquefied petroleum gas (LPG).',
                'link' => 'https://docs.google.com/document/d/1huTxntPWmSKttlQuZ1XmfIoCq1hGLmTwt63WmnUh__k/edit?tab=t.0',
            ],
            [
                'technology' => 'Blackchin Tilapia Longganisa',
                'technology_generator' => 'Rodrigo P. Baysa; Divine Reine S. Aquino; Walter L. Pacunana; Gerondina C. Mendoza; Dante M. Mendoza; Christian Jake D. Munoz',
                'description' => 'Blackchin Tilapia Longganisa is a healthier variant of the popular Filipino-style sausage, that is developed using finely ground Blackchin Tilapia fish meat, which is combined with natural spices and seasonings. Formulated as a substitute to the pork longganisa, this product delivers consumers with a nutritious, tastier and highly protein-enriched substitute that contains less fat but has the same flavor and chewiness of the popular Filipino food.',
                'link' => 'https://docs.google.com/document/d/14oLtXpJjKMpDO8mp1DHR8c2avwY2pSMD2jCwR1ckoms/edit?tab=t.0',
            ],
            [
                'technology' => 'Common Carp Pasta',
                'technology_generator' => 'Divine Reine S. Aquino; Walter L. Pacunana; Gerondina C. Mendoza; DanteM. Mendoza; Rodrigo P. Baysa; and Allysa Faye R. Soriano',
                'description' => 'Common Carp Pasta is a healthy and novel species of pasta formulated with protein concentrate of common carp coupled with wheat flour, eggs, and a bit of salt and water to form a dough that is cut out into small, thin noodles. The product can be used to replace traditional carb-loaded pasta that is low in protein. The use of fish protein enables Common Carp Pasta to present a more balanced nutrition to the consumer, whereby it contains many of the essential amino acids, minerals, and omega fatty acids. It does not have any unfamiliar flavour or texture compared to normal pasta and yields a higher protein content, which results in healthier well-being.',
                'link' => 'https://docs.google.com/document/d/1rv4c0IGirZYJB7XAmhZIO_8ktWiFZV4K/edit',
            ],
            [
                'technology' => 'French Style Eel Meat',
                'technology_generator' => 'Walter L. Pacunana; Divine Reine S. Aquino; Gerondina C. Mendoza; Jacob Anderson C. Sanchez; Elysa Madallada; Jesusa Flor Nasarro; Miriam Cunanan; and Ronnel Byan R. Javier',
                'description' => 'The French-Style Eel Meat is a value-added food product made from Asian swamp eel (Monopterus albus), an abundant yet often problematic species in Philippine rice fields and wetlands. The product is prepared by carefully cleaning, deboning, and brining the eel meat before being preserved in sterilized glass jars. It is then combined with high-quality ingredients such as olive oil, carrots, bell peppers, garlic, lemon peel, and spices to achieve a distinctive French-style flavor profile.',
                'link' => 'https://docs.google.com/document/d/1GEy3tYWpMjjE_ZiKiadgwVOulKqH986Oy82R-kOZfoc/edit?tab=t.0',
            ],
            [
                'technology' => 'Freshwater Clam Sauce',
                'technology_generator' => 'Gerondina C. Mendoza; Dante M. Mendoza; Walter L. Pacunana; Divine Reine S. Aquino; Rodrigo P. Baysa; and Charlotte M. Canlas',
                'description' => 'The product being manufactured is a Freshwater Clam Sauce condiment, which is the meat of the freshwater clam (Cristaria plicata) commonly called sulib in the locality. It is a product created to be used instead of classic oyster-based sauces that provide a rich, savory umami flavor that fits various Filipino foods. The first step involves cleaning and shucking the clams in order to remove the shells and leave the meat. The meat is subsequently cleaned and separated to eliminate its digestive component, and is then crushed and served in water to release its natural flavors.',
                'link' => 'https://docs.google.com/document/d/1Lx5gX8I9qsw2TQtdQisWaqzWNpuIJOWoYRIb1QdyVNE/edit?tab=t.0',
            ],
            [
                'technology' => 'Tibig (Ficus nota (Blanco) merr.) Leaf Extract-based Meat Tenderizer',
                'technology_generator' => 'Reniel R. Andallion',
                'description' => '100% all Natural, 1ml: 100g Meat, Sustainable Raw Materials, contains promising contents in treating and preventing cardiovascular diseases, diabetes, cancer, and even slowing down the aging process.',
                'link' => 'https://docs.google.com/document/d/1DyRRVjyhw7NgvjUAvHQx2gFMnkx2wGK0/edit',
            ],
            [
                'technology' => 'Milkfish Bone Loaf Bread',
                'technology_generator' => 'Gerondina C. Mendoza; Divine Reine S. Aquino; Walter L. Pacunana; Dante M. Mendoza; Rodrigo P. Baysa; and Obi Han S. David',
                'description' => 'The Milkfish Bones Loaf Bread is an innovative and nutrient-enriched bakery product developed by incorporating powdered milkfish bones into traditional loaf bread. Unlike conventional bread, this product utilizes a sustainable ingredient—milkfish bones—that are normally discarded as waste during fish processing. Through careful preparation, the bones are cleaned, softened, dried, pulverized, and finely ground into powder before being mixed with standard bread-making ingredients such as flour, yeast, eggs, sugar, salt, and water.',
                'link' => 'https://docs.google.com/document/d/1BGwed4tpth-RCOMGIboQ1_dndclcLwKvxAJ_XVvUthY/edit?tab=t.0',
            ],
            [
                'technology' => 'Ready-To-Cook Rabbit Meat Dish in Soy Sauce',
                'technology_generator' => 'Emily A. Soriano; Irene S. Adion; Marielle S. Dizon; Joanna S. Bantoc; Raymart S. Bondoc; and Walter L. Pacunana',
                'description' => 'The product is a rabbit meat sausage, a type of longganisa formulated exclusively from rabbit meat as its main protein source. Unlike conventional sausages that typically use pork, chicken, or beef, this product eliminates the need for extenders, binders, or other meat substitutes, highlighting the natural qualities of rabbit meat.',
                'link' => 'https://docs.google.com/document/d/1czy9oqwSf_yozHZM09tgFDeYBRi6DhTdAmPuRL1HD5w/edit?tab=t.0',
            ],
            [
                'technology' => 'Ready-To-Cook Marinated Rabbit Meat Slice',
                'technology_generator' => 'Emily A. Soriano; Irene S. Adion; Marielle S. Dizon; Joanna S. Bantoc; Raymart S. Bondoc; and Walter L. Pacunana',
                'description' => 'The product is a ready-to-cook marinated rabbit meat slice, locally conceptualized as an alternative version of the traditional Filipino tapa. It is prepared using deboned and filleted rabbit meat, which is marinated in a mixture of soy sauce, calamansi juice, minced garlic, star anise, pepper, and other selected spices. The process involves slicing the rabbit meat into thin fillets, immersing it in the marinade for at least 2–3 days under chilled conditions, and then vacuum-sealing it in food-grade packaging for extended shelf life.',
                'link' => 'https://docs.google.com/document/d/1RvMG5yzMHnfWALRQ5SFQwc4OwmU-W0HrKnfbyzkzzzg/edit?tab=t.0',
            ],
            [
                'technology' => 'Ready-To-Cook Sweet Cured Rabbit Meat',
                'technology_generator' => 'Emily A. Soriano; Irene S. Adion; Marielle S. Dizon; Joanna S. Bantoc; Raymart S. Bondoc; and Walter L. Pacunana',
                'description' => 'The Ready-to-cook Sweet-cured Rabbit Meat is a value-added food product developed as an alternative to the traditional pork-based tocino. It is made from deboned rabbit meat that is cured using a carefully formulated mixture of sugar, pineapple juice, soy sauce, rock salt, and a minimal amount of curing agent. Unlike conventional curing methods that rely heavily on synthetic preservatives, this product uses sugar and pineapple juice as natural preservatives, providing both safety and enhanced flavor.',
                'link' => 'https://docs.google.com/document/d/1fEe0zyQfHw8P-OIXVAVDAnK6v85TEsVMiKdi5i3R_0E/edit?tab=t.0',
            ],
            [
                'technology' => 'Stripped Snakehead Flakes in Oil',
                'technology_generator' => 'Walter L. Pacunana; Divine Reine S. Aquino; Gerondina C. Mendoza; Jacob Anderson C. Sanchez; Elysa Madallada; Jesusa Flor Nasarro; Miriam Cunanan; and Ronnel Byan R. Javier',
                'description' => 'The manufactured product is Stripped Snakehead Flakes in Oil, a brand of preserved fish product ready to eat that is made of the flesh of the stripped snakehead (Channa striata), which is locally known as the mudfish or dalag.',
                'link' => 'https://docs.google.com/document/d/1hK6pzYb7pd5_v9u2YBiM8_P2iPchh90lPyzeMyMrEbI/edit?tab=t.0',
            ],
            [
                'technology' => 'Sweet-Cured Softshell Turtle',
                'technology_generator' => 'Walter L. Pacunana; Divine Reine S. Aquino; Gerondina C. Mendoza; Jacob Anderson C. Sanchez; Elysa Madallada; Jesusa Flor Nasarro; Miriam Cunanan; and Ronnel Byan R. Javier',
                'description' => 'The product that would be produced is the Sweet-Cured Soft-Shell Turtle Meat, a value-added meat product made as an alternative to the traditional Filipino tocino. It is prepared out of the meat of the Chinese soft-shell turtle (Pelodiscus sinensis), which is also an invasive turtle commonly sighted within Pampanga and other areas within the Central Luzon region.',
                'link' => 'https://docs.google.com/document/d/12Yzz4v13if9aeV0GK2Yi-1o2bu3xWBwoq9nskvJNcPA/edit?tab=t.0',
            ],
            [
                'technology' => 'Water Hyacinth Briquette',
                'technology_generator' => 'Walter L. Pacunana; Divine Reine S. Aquino; Gerondina C. Mendoza; Jacob Anderson C. Sanchez; Elysa Madallada; Jesusa Flor Nasarro; Miriam Cunanan; and Ronnel Byan R. Javier',
                'description' => 'The Water Hyacinth Briquette is an eco-friendly, compressed block of biomass fuel produced from the stalks and leaves of dried and ground water hyacinth, bound together with cassava starch and water. Designed as an alternative to traditional charcoal and firewood, the briquette offers a renewable, low-cost, and sustainable energy source for household and small-scale commercial use.',
                'link' => 'https://docs.google.com/document/d/1AgS8YUu3apOlov88TYe5rUzJqnZo_-NyDIDB8Ho02CI/edit?tab=t.0',
            ],
            [
                'technology' => 'Water Lettuce Briquette',
                'technology_generator' => 'Walter L. Pacunana; Divine Reine S. Aquino; Gerondina C. Mendoza; Jacob Anderson C. Sanchez; Elysa Madallada; Jesusa Flor Nasarro; Miriam Cunanan; and Ronnel Byan R. Javier',
                'description' => 'The Water Lettuce Briquette is a compact, eco-friendly fuel source produced from dried and ground water lettuce (Pistia stratiotes) combined with cassava starch as a natural binder. The product is designed to serve as a renewable alternative to traditional charcoal and firewood, offering households and small-scale industries a cost-effective solution for cooking, heating, and other energy needs.',
                'link' => 'https://docs.google.com/document/d/1Kpy3Zae0mB2i50sO95IK601GyDD9x5ckTBgNH7gC0z4/edit?tab=t.0',
            ],
        ];

        foreach ($data as $item) {
            RegisteredTechnology::create($item);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Monster;

class MonsterSeeder extends Seeder
{
    public function run(): void
    {
        Monster::create([
            'title' => 'Rakshasa',
            'description' => 'Shape-shifting demons with animalistic features, known for their cunning and trickery.',
            'behavior' => 'The Rakshasa could disguise itself as a friend or ally, sowing discord and mistrust among the group. It enjoys toying with its prey before delivering a lethal blow.',
            'habitat' => null,
            'image' => null,  
        ]);

        Monster::create([
            'title' => 'Wendigo',
            'description' => 'A cannibalistic spirit, often depicted as a gaunt figure with elongated limbs and an insatiable hunger for human flesh.',
            'behavior' => 'The Wendigo stalks its prey through the wilderness, using its knowledge of the environment to ambush and devour characters. Its presence is often accompanied by an unnatural cold.',
            'habitat' => 'Wilderness', 
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Skinwalker',
            'description' => 'A malevolent witch capable of shape-shifting into animals, known for its dark magic and curses.',
            'behavior' => 'The Skinwalker can mimic the voices and appearances of loved ones, leading characters into deadly situations. It prefers psychological warfare, breaking down its victims mentally before attacking.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Ghoul',
            'description' => 'A demon-like creature that feeds on corpses, often found in graveyards or deserted places.',
            'behavior' => 'The Ghoul lurks near dead bodies, ambushing those who venture too close. It might attack en masse if disturbed, overwhelming its victims with sheer numbers.',
            'habitat' => 'Graveyards, deserted places',
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Lilith',
            'description' => 'A demoness associated with night terrors, who preys on newborn children and seduces men.',
            'behavior' => 'Lilith could appear in dreams, tormenting characters with horrific visions or stealing their life force. She might also manipulate the environment to create terrifying scenarios, driving characters to madness.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Banshee',
            'description' => 'A female spirit who wails to foretell the death of a family member. Often depicted with long, flowing hair and a white or grey cloak.',
            'behavior' => 'The Banshee could appear as an ominous figure at a distance, her cries growing louder as a character\'s death approaches. She might not attack directly but can weaken the player\'s resolve and alert them to the presence of other dangers.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Huldra',
            'description' => 'A seductive forest spirit with a hollow back, resembling a beautiful woman from the front but with a cow or fox tail.',
            'behavior' => 'The Huldra lures characters into the woods, leading them astray or into deadly traps. If a character follows her, they might become lost or meet a fatal end.',
            'habitat' => 'Forest',
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Empusa',
            'description' => 'A vampiric demon that can shape-shift, often appearing as a beautiful woman to seduce and feed on human flesh.',
            'behavior' => 'The Empusa preys on lone characters, draining their life force. She can disguise herself as a party member or someone the character trusts, only revealing her true form at the last moment.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Yurei',
            'description' => 'A vengeful spirit with long, disheveled hair, white funeral garments, and a haunting presence.',
            'behavior' => 'The Yurei haunts specific locations, such as bedrooms or bathrooms, appearing when characters are most vulnerable. It can manipulate objects, create cold spots, and induce hallucinations.',
            'habitat' => 'Specific locations (bedrooms, bathrooms)',
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Oni',
            'description' => 'A demonic ogre with horns, sharp claws, and immense strength, often depicted with red or blue skin.',
            'behavior' => 'The Oni is a brutal force of nature, attacking any character that enters its domain. It can be a relentless pursuer, smashing through obstacles and dealing heavy damage.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Dullahan',
            'description' => 'A headless rider, usually on a black horse, who is a harbinger of death.',
            'behavior' => 'The Dullahan appears suddenly, charging through areas and decapitating any character who crosses its path. It might be a rare, unstoppable force that characters must avoid at all costs.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Spring-heeled Jack',
            'description' => 'A mysterious figure capable of leaping great distances, often described as a demon-like creature with clawed hands and fiery eyes.',
            'behavior' => 'Spring-heeled Jack could ambush characters, using his leaping ability to strike from unexpected angles. He might play cat-and-mouse, attacking and then retreating before the characters can react.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'The Rake',
            'description' => 'A humanoid creature with long claws that stalks and attacks its victims in their sleep.',
            'behavior' => 'The Rake is a relentless stalker, appearing at night to terrorize characters. It might attack suddenly, using its claws to deal heavy damage or leaving deep wounds that fester and weaken the victim over time.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Mothman',
            'description' => 'A large, winged creature with glowing red eyes, often considered an omen of disaster.',
            'behavior' => 'Mothman could be a harbinger of doom, appearing before catastrophic events or leading characters to dangerous situations. It might not attack directly but could instill fear and paranoia, causing characters to make poor decisions.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Bloody Mary',
            'description' => 'A vengeful spirit summoned by chanting her name in front of a mirror, often associated with violent deaths.',
            'behavior' => 'Bloody Mary could haunt reflective surfaces, appearing suddenly to attack or terrify characters. She might also manipulate mirrors to create illusions or trap characters in an endless maze of reflections.',
            'habitat' => 'Reflective surfaces (mirrors)',
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Al Basti',
            'description' => 'A spirit that causes nightmares and sleep paralysis, often appearing as a dark, shadowy figure.',
            'behavior' => 'Al Basti attacks characters in their sleep, inducing night terrors and making them vulnerable to other threats. It thrives on fear, growing stronger as its victims become more terrified.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'La Llorona',
            'description' => 'The ghost of a woman who drowned her children and now wanders, wailing and searching for them.',
            'behavior' => 'La Llorona could be heard crying near bodies of water or in dark, secluded areas. Her presence might weaken characters\' resolve, making them more susceptible to other dangers. She might lure characters to their doom by imitating the voice of a loved one.',
            'habitat' => 'Near bodies of water, dark secluded areas',
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Ahuizotl',
            'description' => 'A water-dwelling creature with a hand at the end of its tail, known for dragging people underwater and eating their eyes and teeth.',
            'behavior' => 'The Ahuizotl lurks near water sources, attacking characters who come too close. It might try to drown its victims or drag them into the water, making it a deadly foe near lakes or rivers.',
            'habitat' => 'Water sources (lakes, rivers)',
            'image' => null,
        ]);

        Monster::create([
            'title' => 'Sihuanaba',
            'description' => 'A shape-shifting spirit that lures unfaithful men to their doom by appearing as a beautiful woman with a hideous face.',
            'behavior' => 'Sihuanaba could target specific characters, leading them into deadly traps by appearing as someone they desire. Once close enough, she reveals her true form, causing terror and possibly killing them outright.',
            'habitat' => null,
            'image' => null,
        ]);

        Monster::create([
            'title' => 'El Silbón',
            'description' => 'The spirit of a man who killed his father and now wanders the plains, carrying a sack of bones and whistling a haunting tune.',
            'behavior' => 'El Silbón\'s presence is heralded by his eerie whistle, which grows louder as he approaches. He could appear suddenly, dealing a fatal blow to anyone caught off guard. His arrival could also signal the appearance of other supernatural threats.',
            'habitat' => 'Plains',
            'image' => null,
        ]);
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Make;
use App\Models\CarModel;
use App\Models\Engine;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Roles
        $admin = Role::firstOrCreate(['name'=>'admin','guard_name'=>'web']);
        $manager = Role::firstOrCreate(['name'=>'manager','guard_name'=>'web']);
        $client = Role::firstOrCreate(['name'=>'client','guard_name'=>'web']);

        // Admin user
        $adminUser = User::firstOrCreate(['email'=>'admin@autopart.tn'],['first_name'=>'Admin','last_name'=>'AutoPart','password'=>Hash::make('password'),'is_active'=>true]);
        $adminUser->assignRole('admin');

        // Settings
        Setting::set('site_name','AutoPart');
        Setting::set('site_phone','+216 23 136 136');
        Setting::set('site_email','autopart.tunisia@gmail.com');
        Setting::set('site_address','Route ceinture Megrine Jawhra, Ben Arous, Tunisie');
        Setting::set('shipping_free_above','200');
        Setting::set('shipping_tunis','8');
        Setting::set('shipping_other','12');

        // Makes
        $makes = ['Renault','Peugeot','Citroën','Volkswagen','Toyota','Hyundai','Kia','Fiat','Ford','Opel','BMW','Mercedes-Benz','Audi','Dacia','Nissan'];
        foreach ($makes as $i=>$name) {
            Make::firstOrCreate(['slug'=>Str::slug($name)],['name'=>$name,'is_active'=>true,'sort_order'=>$i]);
        }

        // Renault avec modèles et moteurs
        $renault = Make::where('slug','renault')->first();
        if ($renault) {
            $clio = CarModel::firstOrCreate(['make_id'=>$renault->id,'slug'=>'clio'],['name'=>'Clio','is_active'=>true]);
            Engine::firstOrCreate(['car_model_id'=>$clio->id,'slug'=>'clio-12-16v-75'],['name'=>'1.2 16V 75ch','fuel_type'=>'essence','displacement'=>'1.2','power_hp'=>'75','engine_code'=>'D4F','year_from'=>2001,'year_to'=>2012,'is_active'=>true]);
            Engine::firstOrCreate(['car_model_id'=>$clio->id,'slug'=>'clio-15-dci-75'],['name'=>'1.5 dCi 75ch','fuel_type'=>'diesel','displacement'=>'1.5','power_hp'=>'75','engine_code'=>'K9K','year_from'=>2001,'year_to'=>2012,'is_active'=>true]);

            $megane = CarModel::firstOrCreate(['make_id'=>$renault->id,'slug'=>'megane'],['name'=>'Mégane','is_active'=>true]);
            Engine::firstOrCreate(['car_model_id'=>$megane->id,'slug'=>'megane-16-16v-115'],['name'=>'1.6 16V 115ch','fuel_type'=>'essence','displacement'=>'1.6','power_hp'=>'115','year_from'=>2002,'year_to'=>2008,'is_active'=>true]);
            Engine::firstOrCreate(['car_model_id'=>$megane->id,'slug'=>'megane-15-dci-85'],['name'=>'1.5 dCi 85ch','fuel_type'=>'diesel','displacement'=>'1.5','power_hp'=>'85','engine_code'=>'K9K','year_from'=>2003,'year_to'=>2008,'is_active'=>true]);
        }

        // Categories
        $cats = [
            ['name'=>'Filtres','children'=>['Filtre à huile','Filtre à air','Filtre à carburant','Filtre habitacle']],
            ['name'=>'Freinage','children'=>['Disque de frein','Plaquettes de frein','Tambour de frein','Étrier de frein','Maître-cylindre']],
            ['name'=>'Suspension','children'=>['Amortisseur','Ressort de suspension','Silent-bloc','Rotule de direction']],
            ['name'=>'Moteur','children'=>['Joint culasse','Pompe à eau','Pompe à huile','Carter d\'huile','Turbo']],
            ['name'=>'Embrayage','children'=>['Kit d\'embrayage','Disque d\'embrayage','Butée embrayage']],
            ['name'=>'Transmission','children'=>['Cardan','Soufflet de cardan','Tête cardan']],
            ['name'=>'Climatisation','children'=>['Compresseur climatisation','Filtre habitacle','Condenseur']],
            ['name'=>'Électrique','children'=>['Démarreur','Alternateur','Bougie d\'allumage','Bougie de préchauffage']],
            ['name'=>'Refroidissement','children'=>['Radiateur','Thermostat','Ventilateur','Durite radiateur']],
            ['name'=>'Direction','children'=>['Crémaillère de direction','Pompe direction assistée','Rotule de direction']],
            ['name'=>'Éclairage','children'=>['Phare avant','Feu arrière','Feu clignotant']],
            ['name'=>'Lubrifiants','children'=>['Huile moteur','Huile boîte','Antigel']],
        ];
        foreach ($cats as $i=>$catData) {
            $parent = Category::firstOrCreate(['slug'=>Str::slug($catData['name'])],['name'=>$catData['name'],'is_active'=>true,'sort_order'=>$i]);
            foreach ($catData['children'] as $j=>$childName) {
                Category::firstOrCreate(['slug'=>Str::slug($childName)],['name'=>$childName,'parent_id'=>$parent->id,'is_active'=>true,'sort_order'=>$j]);
            }
        }

        // Sample products
        $sampleProducts = [
            ['name'=>'Filtre à huile Renault Clio','cat'=>'filtre-a-huile','price'=>8.500,'brand'=>'Bosch','ref'=>'BOF001','stock'=>50],
            ['name'=>'Filtre à air Renault Megane','cat'=>'filtre-a-air','price'=>12.000,'brand'=>'Mann','ref'=>'MAF001','stock'=>30],
            ['name'=>'Plaquettes de frein avant Renault','cat'=>'plaquettes-de-frein','price'=>35.000,'brand'=>'Brembo','ref'=>'BRE001','stock'=>20],
            ['name'=>'Disque de frein avant 280mm','cat'=>'disque-de-frein','price'=>45.000,'brand'=>'TRW','ref'=>'TRW001','stock'=>15],
            ['name'=>'Amortisseur avant Peugeot 206','cat'=>'amortisseur','price'=>65.000,'brand'=>'KYB','ref'=>'KYB001','stock'=>10],
            ['name'=>'Kit embrayage Renault Clio 1.5 dCi','cat'=>'kit-d-embrayage','price'=>180.000,'brand'=>'LUK','ref'=>'LUK001','stock'=>8],
            ['name'=>'Bougie allumage NGK','cat'=>'bougie-d-allumage','price'=>5.500,'brand'=>'NGK','ref'=>'NGK001','stock'=>100],
            ['name'=>'Courroie de distribution','cat'=>'filtre-a-huile','price'=>25.000,'brand'=>'Continental','ref'=>'CON001','stock'=>25,'featured'=>true],
        ];
        foreach ($sampleProducts as $p) {
            $cat = Category::where('slug',$p['cat'])->first();
            if ($cat) {
                Product::firstOrCreate(['slug'=>Str::slug($p['name'])],[
                    'name'=>$p['name'],'category_id'=>$cat->id,'price'=>$p['price'],
                    'brand'=>$p['brand'],'reference'=>$p['ref'],'stock'=>$p['stock'],
                    'is_active'=>true,'is_featured'=>$p['featured']??false,'is_new'=>true,
                    'description'=>'Pièce de qualité origine pour '.$p['name'].'. Compatible avec les véhicules listés.'
                ]);
            }
        }
        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin: admin@autopart.tn / password');
    }
}

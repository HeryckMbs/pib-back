<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Departamento;
use App\Models\Membro;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();



        // Membro::create([

        //     'nome' => 'Heryck Mota',
        //     'email' => 'eail@mail.com',
        //     'url_photo' => 'asdfasd',
        //     'dt_aniversario' => Carbon::now(),
        //     'user_id' => 3,
        // ]);


        $entities = [
            'igreja',
            'campanha',
            'campanha_culto',
            'evento',
            'evento_musicas',
            'evento_integrantes',
            'culto',
            'departamento',
            'departamento_integrantes',
            'departamento_avisos',
            'musicas',
            'pedidos_oracao',
            'pedidos_musica',
            'pastas',
            'cifras',
            'categorias',
            'membros',
        ];

        $permissions = [
            'can_create',
            'can_read',
            'can_update',
            'can_delete',
        ];

        foreach($entities as $entity){
            foreach($permissions as $permission){
                $permissionsCreated[$entity] = Permission::create(['name' => $entity . '_' . $permission]);
            }
        }

        $roles = [
            'root','ministro','presidente_departamento'
        ];

        foreach($roles as $role){
            $role = Role::create(['name' => $role]);
            $role->syncPermissions($permissionsCreated);
        }




    $user  =  \App\Models\User::create([
            'name' => 'heryck',
            'email' => 'heryckmota@gmail.com',
            'password' => bcrypt(123456)
        ]);

        Membro::create([
            'nome' => 'heryck',
            'url_photo' => null,
            'dt_aniversario' => Carbon::now(),
            'user_id' => $user->id
        ]);

        $user->assignRole('root');

        // Departamento::create([]);
    }
}

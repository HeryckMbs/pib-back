<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Departamento;
use App\Models\DepartamentoFuncao;
use App\Models\DepartamentoIntegrante;
use App\Models\Igreja;
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
        $json = [];

        for($a = 1; $a<=581;$a++ ){
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://cantorcristaobatista.com.br/CantorCristao/hino/show/$a");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = mb_convert_encoding( curl_exec($ch), 'UTF-8' );

            $regex = '/<div id="letra">(.+?)<\/div>/s';
            if (preg_match($regex, $response, $matches)) {
                $titles = '';
                if(preg_match( '/<div class="body">.*?<h1>(.*?)<\/h1>/s',$response, $title)){
                    $titles = trim(preg_replace('/\s+/', ' ', $title[1]));
                }

                $json[$a]= ['title' => str_replace($titles,'"',''), 'hino' => str_replace( $matches[1],'"','') ];
                dump("$titles $a/581");
            } else {
                echo "Div não encontrada ou conteúdo vazio.";
            }
            curl_close($ch);
        }

        $arquivo = 'cantor_cristao.json';
        $json = json_encode($json,JSON_UNESCAPED_UNICODE);
        $file = fopen(__DIR__ . '/' . $arquivo,'w');
        fwrite($file, $json);
        fclose($file);
        // $entities = [
        //     'igreja',
        //     'campanha',
        //     'campanha_culto',
        //     'evento',
        //     'evento_musicas',
        //     'evento_integrantes',
        //     'culto',
        //     'departamento',
        //     'departamento_integrantes',
        //     'departamento_avisos',
        //     'musicas',
        //     'pedidos_oracao',
        //     'pedidos_musica',
        //     'pastas',
        //     'cifras',
        //     'categorias',
        //     'membros',
        // ];

        // $permissions = [
        //     'can_create',
        //     'can_read',
        //     'can_update',
        //     'can_delete',
        // ];

        // foreach ($entities as $entity) {
        //     foreach ($permissions as $permission) {
        //         $permissionsCreated[$entity] = Permission::create(['name' => $entity . '_' . $permission]);
        //     }
        // }

        // $roles = [
        //     'root',
        //     'ministro',
        //     'presidente_departamento'
        // ];

        // foreach ($roles as $role) {
        //     $role = Role::create(['name' => $role]);
        //     $role->syncPermissions($permissionsCreated);
        // }





        // $user = \App\Models\User::create([
        //     'name' => 'heryck',
        //     'email' => 'heryckmota@gmail.com',
        //     'password' => bcrypt(123456)
        // ]);
        // $user->assignRole('root');
        // $igreja = Igreja::create([
        //     'nome' => $user->name,
        //     'telefone' => '80347023',
        // ]);
        // $membro = Membro::create([
        //     'nome' => 'heryck',
        //     'url_photo' => null,
        //     'dt_aniversario' => Carbon::now(),
        //     'user_id' => $user->id,
        //     'id_igreja' => $igreja->id
        // ]);

        // $igreja->id_pastor = $membro->id;
        // $igreja->save();


        // $Departamento = Departamento::create(['nome' => '', 'descricao' => '', 'objetivo' => '', 'id_lider' => $membro->id,'id_igreja' => $igreja->id]);
        // $departamentoFuncao = DepartamentoFuncao::create(['id_departamento' => $Departamento->id, 'nome' => 'Presidente', 'descricao' => 'Comandante']);
        // $DepartamentoIntegrantes = DepartamentoIntegrante::create(['id_departamento' => $Departamento->id, 'id_membro' => $membro->id, 'id_funcao' => $departamentoFuncao->id]);


    }
}

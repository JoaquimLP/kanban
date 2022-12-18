<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atendimento>
 */
class AtendimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arr = array( "a"=>"P", "b"=>"A", "c"=>"S", "d"=>"I" );
        $midia = array( "Site", "Loja", "Facebook", "OLX", "Webmotors" );
        $key = array_rand($arr);
        $keyMIdia = array_rand($midia);

        return [
            'user_id' => rand(1, 10),
            'nome' => fake()->name(),
            'celular'  => "419".rand(10000000, 99999999),
            'email' => fake()->unique()->safeEmail(),
            'observacao' => fake()->text(),
            'origem'  => $midia[$keyMIdia],
            'status_id' => $arr[$key],
        ];
    }
}

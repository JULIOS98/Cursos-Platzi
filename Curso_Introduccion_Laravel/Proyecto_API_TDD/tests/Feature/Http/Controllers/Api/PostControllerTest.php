<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        //$this->withoutExceptionHandling();

        //Probar que realmente lleguen los datos
        //Simulacion de una app en vue, react esta usando la ruta y tratando de guardar los datos
        
        $response = $this->json('POST','/api/posts',[
            'title' => 'El post de prueba',
        ]);

        //Comprobacion de retorno en estructura json
        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => 'El post de prueba'])//Afirmar que estamos teniendo correctamente lo que queremos guardar
            ->assertStatus(201); //Peticion de manera OK, creado un recurso
        
        //Comprobar si realmente esta en la bd o existe
        $this->assertDatabaseHas('posts', ['title' => 'El post de prueba']);

     
    }

    public function test_validate_title()
    {
        //Validando que no permita titulos
        //Intentar Guardando Post sin titulo
        $response = $this->json('POST','/api/posts',[
            'title' => '',
        ]);

        $response->assertStatus(422) //Solicitud bien hecha pero imposible completarla
            ->assertJsonValidationErrors('title'); 
    }
}

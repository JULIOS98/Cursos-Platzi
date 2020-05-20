<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;
use App\User;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        //$this->withoutExceptionHandling();

        //Creamos usuario 
        $user = factory(User::class)->create();

        //Probar que realmente lleguen los datos
        //Simulacion de una app en vue, react esta usando la ruta y tratando de guardar los datos
        
        $response = $this->actingAs($user, 'api')->json('POST','/api/posts',[
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

        //Creamos usuario 
        $user = factory(User::class)->create();

        //Validando que no permita titulos
        //Intentar Guardando Post sin titulo
        $response = $this->actingAs($user, 'api')->json('POST','/api/posts',[
            'title' => '',
        ]);

        $response->assertStatus(422) //Solicitud bien hecha pero imposible completarla
            ->assertJsonValidationErrors('title'); 
    }

    public function test_show()
    {
        //Creamos usuario 
        $user = factory(User::class)->create();
        //Crear un post atraves de un factory
        $post = factory(Post::class)->create();

        //Acesso
        $response = $this->actingAs($user,'api')->json('GET',"/api/posts/$post->id");
        

        //Comprobacion de retorno en estructura json
        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => $post->title])//Afirmar que estamos teniendo correctamente lo que queremos guardar
            ->assertStatus(200); //Peticion de manera OK

    }

    //Funcion para validar que el post exista
    public function test_404_show()
    {
        //Creamos usuario 
        $user = factory(User::class)->create();
        //Crear un post atraves de un factory
        $post = factory(Post::class)->create();

        //Acesso
        $response = $this->actingAs($user,'api')->json('GET',' /api/posts/1000');
        

        //Comprobacion de retorno en estructura json
        $response->assertStatus(404); //Peticion HTTP NOT FOUND
    }

    public function test_update()
    {
        //$this->withoutExceptionHandling();
        
        //Creamos usuario 
        $user = factory(User::class)->create();
        //Primero crear un post
        $post = factory(Post::class)->create();
       
        //Verificar si el post se puede actualizar
        $response = $this->actingAs($user,'api')->json('PUT',"/api/posts/$post->id",[
            'title' => 'nuevo',
        ]);

        //Comprobacion de retorno en estructura json
        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => 'nuevo'])//Afirmar que estamos teniendo correctamente lo que queremos guardar
            ->assertStatus(200); //Peticion de manera OK, creado un recurso
        
        //Comprobar si realmente esta en la bd o existe
        $this->assertDatabaseHas('posts', ['title' => 'nuevo']);
    }

    public function test_delete()
    {
        //$this->withoutExceptionHandling();
        
        //Creamos usuario 
        $user = factory(User::class)->create();
        //Primero crear un post
        $post = factory(Post::class)->create();
       
        //Verificar si el post se puede eliminar
        $response = $this->actingAs($user,'api')->json('DELETE',"/api/posts/$post->id");

        //Comprobacion de retorno en estructura json
        $response->assertSee(null)//Afirmar que estamos recibiendo null
            ->assertStatus(204); //HTTP SIN CONTENIDO
        
        //Comprobar si realmente no existe en la base de datos
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_index()
    {
        //Creamos usuario 
        $user = factory(User::class)->create();
        //Primero crearemos 5 posts
        factory(Post::class,5)->create();

        $response = $this->actingAs($user,'api')->json('GET', '/api/posts');

        //Verificar que realmente estoy obteniendo un json
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id','title','created_at', 'updated_at']
            ]
        ])->assertStatus(200); // HTTP verificando que estamos accediendo a index con Ok;

    }

    public function test_guest()
    {
        $this->json('GET',  '/api/posts')->assertStatus(401);
        $this->json('POST', '/api/posts')->assertStatus(401);
        $this->json('GET',  '/api/posts/1000')->assertStatus(401);
        $this->json('PUT',  '/api/posts/1000')->assertStatus(401);
        $this->json('DELETE','/api/posts/1000')->assertStatus(401);
    }
   
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests\Post as PostRequests;

use App\Http\Resources\Post as PostResources; //le colocamos un alias(as PostResources) para que no choque con el Post de arriba
use App\Http\Resources\PostCollection;

class PostController extends Controller
{ 
    protected $post; 

    public function __construct(Post $post){ //creamos constructor para invocar a la entidad
       $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            new PostCollection
            ($this->post->orderBy('id', 'desc')->get()
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequests $request)
    {
        $post =$this->post->create($request->all());// esto lo hacemos poque creamos el contructor
        // $this->post en la entidad, si no pusieramos el contructor lo invocaramos asi: post::create

        return response()->json(new PostResources($post), 201); // en este caso si colocamos el 201 porq o sino va a hacer referencia al 200
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //return new PostResources($post); //llamando al recuros(PostResource)
        
        //retornando un json
        return response()->json(new PostResources($post)); //llamando al recuros(PostResource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequests $request, Post $post)
    {
        $post->update($request->all()); //$post es el q recibimos de manera implicita (el id)

        return response()->json(new PostResources($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204); //en este caso no estamos retornando ningun dato, pero si
        //su status 204, que hace referencia a que la conexion fue exitosa, pero se elimino un recurso

        //si queremos retornarlo con un mensaje:

      // return response()->json(['message' => 'Eliminado correctamente'], 204);
      
      //en caso de que lo retornemos con un mensaje, el status seria 200, ya q en ese caso si lo
      //estariamos retrnando con algo, y no en null
    }
}

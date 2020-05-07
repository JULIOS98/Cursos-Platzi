@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Articulos
                    <a href="{{route('posts.create')}}" class="btn btn-sm btn-success float-right">Crear</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th colspan="2">&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{route('posts.edit',$post)}}">Editar</a>
                                </td>
                                <td>
                                    <form action="{{route('posts.destroy','$post')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-sm btn-danger" type="button" value="Eliminar" onclick="return confirm('Deseas Eliminar?')">
                                    
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
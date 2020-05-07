@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Articulo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('posts.update', $post)}}" method="post" enctype="multipart/form-data">
                       
                        <div class="form-group">
                            <label for="title">Title *</label>
                            <input class="form-control" type="text" name="title" placeholder="Ingresa el titulo" required value="{{ old('title',$post->title) }}">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen </label>
                            <input type="file" name="file">
                        </div>
                        <div class="form-group">
                            <label for="contenido">Contenido *</label>
                            <textarea class="form-control" name="body" rows="6" required> {{old('body', $post->body)}}  </textarea>
                        </div>
                        <div class="form-group">
                            <label for="title">Contenido Embebido</label>
                            <textarea class="form-control" name="iframe"> {{old('iframe', $post->iframe)}}  </textarea>
                        </div>
                        <div class="form-group">
                        @csrf
                        @method('PUT')
                            <input class="btn btn-block btn-warning" type="submit" value="Actualizar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

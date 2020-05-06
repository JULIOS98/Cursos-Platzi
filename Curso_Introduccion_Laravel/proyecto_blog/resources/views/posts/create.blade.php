@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Articulo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('posts.store')}}" method="post" exctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title *</label>
                            <input class="form-control" type="text" name="title" placeholder="Ingresa el titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen </label>
                            <input type="file" name="file">
                        </div>
                        <div class="form-group">
                            <label for="contenido">Contenido *</label>
                            <textarea class="form-control" name="body" rows="6" required> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="title">Contenido Embebido</label>
                            <textarea class="form-control" name="iframe"> </textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-block btn-success" type="submit" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')

    <!--Migas-->
    <h3>
        <a href="{{ route("admin") }}" title="Inicio">Inicio</a> <span>| Noticias</span>
    </h3>
    <!--Paginación-->
    <div class="row paginado">
        {{ $rowset->links() }}
    </div>
    <div class="row">
        <!--Nuevo-->
        <article class="col s12 l6">
            <div class="card horizontal admin">
                <div class="card-stacked">
                    <div class="card-content">
                        <i class="grey-text material-icons medium">image</i>
                        <h4 class="grey-text">
                            nueva Noticia
                        </h4><br><br>
                    </div>
                    <div class="card-action">
                        <a href="{{ url("admin/Noticias/crear") }}" title="Añadir nueva Noticia">
                            <i class="material-icons">add_circle</i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
        @foreach ($rowset as $row)
            <article class="col s12 l6">
                <div class="card horizontal  sticky-action admin">
                    <div class="card-stacked">
                        @if ($row->imagen)
                            <div class="card-image">
                                {{ Html::image('img/'.$row->imagen, $row->titulo) }}
                            </div>
                        @endif
                        <div class="card-content">
                            @if (!$row->imagen)
                                <i class="grey-text material-icons medium">image</i>
                            @endif
                            <h4>
                                {{ $row->titulo }}
                            </h4>
                            <strong>URL amigable:</strong> {{ $row->slug }}<br>
                            <strong>Fecha:</strong> {{ date("d/m/Y", strtotime($row->fecha)) }}
                        </div>
                        <div class="card-action">
                            <a href="{{ url("admin/Noticias/editar/".$row->id) }}" title="Editar">
                                <i class="material-icons">edit</i>
                            </a>
                            @php
                                $title = ($row->activo == 1) ? "Desactivar" : "Activar";
                                $color = ($row->activo == 1) ? "green-text" : "red-text";
                                $icono = ($row->activo == 1) ? "mood" : "mood_bad";
                            @endphp
                            <a href="{{ url("admin/Noticias/activar/".$row->id) }}" title="{{ $title }}">
                                <i class="{{ $color }} material-icons">{{ $icono }}</i>
                            </a>
                            @php
                                $title = ($row->home == 1) ? "Quitar de la home" : "Mostrar en la home";
                                $color = ($row->home == 1) ? "green-text" : "red-text";
                            @endphp
                            <a href="{{ url("admin/Noticias/home/".$row->id) }}" title="{{ $title }}">
                                <i class="{{ $color }} material-icons">home</i>
                            </a>
                            <a href="#" class="activator" title="Borrar">
                                <i class="material-icons">delete</i>
                            </a>
                        </div>
                    </div>
                    <!--Confirmación de borrar-->
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Borrar Noticia<i class="material-icons right">close</i></span>
                        <p>
                            ¿Está seguro de que quiere borrar la Noticia<strong>{{ $row->titulo }}</strong>?<br>
                            Esta acción no se puede deshacer.
                        </p>
                        <a href="{{ url("admin/Noticias/borrar/".$row->id) }}" title="Borrar">
                            <button class="btn waves-effect waves-light" type="button">Borrar
                                <i class="material-icons right">delete</i>
                            </button>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection

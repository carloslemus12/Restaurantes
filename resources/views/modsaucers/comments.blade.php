@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')


@section('title')
    Comentarios del platillo {{'PTL'.str_repeat("0", 3 - strlen("$platillo->id") ).$platillo->id }}
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <h4>Comentarios del platillo: {{$platillo->platillo}}</h4>
            @foreach($comentarios as $comentario)
            <div class="card bg-transparent" style="margin-top: 3%;">
                <div class="card-header">
                    <h4>Usuario: {{$comentario->username}}</h4>
                        <form method="POST" action="{{route('comments.delete', $comentario->id)}}">      
                             {!! csrf_field() !!}
                        <input type="hidden" name="moderador" id="moderador" value="{{Auth::user()->id}}">

                        <input type="hidden" name="platillo" id="platillo" value="{{$platillo->id}}">

                          <button type="submit" onclick="return confirm('¿Realmente desea eliminar este comentario?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-trash.svg')  }}" style="width:32px;"/></button>
                        </form>
                </div>
                <div class="card-body">                	
                	{{$comentario->comentario}}
                	<br>
                	<div style="text-align: right;">
                	<small style="text-align: right;">Recomendado desde: {{$comentario->created_at}}</small>
                	</div>
                </div>
            </div>     
            @endforeach       
        </div>
    </div>
</div>
@endsection
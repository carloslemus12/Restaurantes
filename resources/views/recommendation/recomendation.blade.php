@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')


@section('title')
    Recomendaciones
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            @foreach($recomendaciones as $recomendacion)
            <div class="card bg-transparent" style="margin-top: 3%;">
                <div class="card-header">
                    <h4>Usuario: {{$recomendacion->username}}</h4>
                        <form method="POST" action="{{route('recommendation.destroy', $recomendacion->id)}}">      
                             {!! csrf_field() !!}
                        <input type="hidden" name="moderador" id="moderador" value="{{Auth::user()->id}}">

                          <button type="submit" onclick="return confirm('¿Realmente desea eliminar esta recomendacion?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-trash.svg')  }}" style="width:32px;"/></button>
                        </form>
                </div>
                <div class="card-body">                	
                	{{$recomendacion->recomendacion}}
                	<br>
                	<div style="text-align: right;">
                	<small style="text-align: right;">Recomendado desde: {{$recomendacion->created_at}}</small>
                	</div>
                </div>
            </div>     
            @endforeach       
        </div>
    </div>
</div>
@endsection
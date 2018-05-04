<ul id="list-comments" class="list-group">
@foreach ($restaurante->recomendaciones as $recomendacion)
    @if ($recomendacion->usuario_id == auth()->user()->id)
    <li class="list-group-item d-flex justify-content-between">{{ $recomendacion->recomendacion }}<img recomendacion={{ $recomendacion->id }} id="btn_delete" src="{{ asset('img/quit.png') }}" /></li>
    @else
    <li class="list-group-item left-align">{{ $recomendacion->recomendacion }}</li>
    @endif
@endforeach
<script>
    $('#btn_delete').on('click', function(){
        var url = "{{ url('/cli/restaurant/recommendations/delete') }}/"+$(this).attr("recomendacion");
        
        $.post(url, { _token:"{{ csrf_token() }}" },function(){
            $( "#list-comments" ).load( "{{ route('cli.recommendationslight', $restaurante->id) }}");
        });
    });
</script>
</ul>

<div class="input-group mb-3">
    <input id="recomendacion" type="text" class="form-control" placeholder="Recomendacion" aria-label="Recomendacion" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button id="btn_recomendacion" class="btn btn-outline-dark" type="button"><img src="{{ asset('img/packing.png') }}" /></button>
    </div>
</div>

<script>
    $('#btn_recomendacion').on('click', function(){
        var recomendacion = $('#recomendacion').val();

        var url = "{{ route('cli.restaurantRecommendations', $restaurante->id) }}";
        
        $.post(url, { usuario: {{ auth()->user()->id }}, recomendacion:recomendacion, _token:"{{ csrf_token() }}" }, function(){
            $( "#list-comments" ).load( "{{ route('cli.recommendationslight', $restaurante->id) }}");
            $('#recomendacion').val("");
        });
    });
</script>
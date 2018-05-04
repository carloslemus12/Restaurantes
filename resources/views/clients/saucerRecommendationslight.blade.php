@foreach ($platillo->recomendaciones as $recomendacion)
    @if ($recomendacion->usuario_id == auth()->user()->id)
    <li class="list-group-item d-flex justify-content-between">{{ $recomendacion->recomendacion }}<img recomendacion={{ $recomendacion->id }} id="btn_delete" src="{{ asset('img/quit.png') }}" /></li>
    @else
    <li class="list-group-item left-align">{{ $recomendacion->recomendacion }}</li>
    @endif
@endforeach
<script>
    $('#btn_delete').on('click', function(){
        var url = "{{ url('/cli/saucer/recommendations/delete') }}/"+$(this).attr("recomendacion");
        
        $.post(url, { _token:"{{ csrf_token() }}" },function(){
            $( "#list-comments" ).load( "{{ route('cli.saucerRecommendationslight', $platillo->id) }}");
        });
    });
</script>
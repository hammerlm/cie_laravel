@extends('templateslvlone.templateslvltwo.backendmaster')
@section('scriptrefs_optional')
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css')}}" rel="stylesheet">
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js')}}"></script>
@stop
@section('rightcol_content_lvl2')
    {{Form::open(['url' => '/backend/news/' . $newsentry->id, 'method' => 'PUT'])}}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('title', 'Titel')}}
            {{Form::text('title',$newsentry->title,array('class' => 'form-control', 'placeholder'=>'Titel'))}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Inhalt')}}
            {{Form::textarea('body',$newsentry->body,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'msgbody'))}}
        </div>
        <div class="form-group">
            {{Form::label('categories', 'Kategorien')}}
            <table class="table table-striped table-hover">
                <tr>
                    <th>Name</th>
                    <th>Auswahl</th>
                </tr>
                @foreach ($categorylist as $categoryitem)
                    <tr>
                        <td>{{ $categoryitem->name }}</td>
                        <td align="center">{!! Form::checkbox("categorylist[]", $categoryitem->id, $newsentry->categories->contains($categoryitem)) !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="form-group">
            {{Form::submit('Speichern',array('class' => 'btn btn-primary btn-sm'))}}
        </div>
    </div>
    {{Form::close()}}
    <script>
        $(document).ready(function() {
            $('#msgbody').summernote({
                height:500,
            });
        });
    </script>
    <hr/>
    {!! Form::open(['url' => url('/backend/news/' . $newsentry->id), 'method' => 'DELETE']) !!}
    {!! Form::submit('Löschen', ["class" => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
@stop
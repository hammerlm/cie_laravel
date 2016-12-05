@extends('dummycontentviews.masterlayoutfiles.backendmaster')
@section('rightcol_content_lvl2')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Spielort</th>
                <th>Speichern</th>
                <th>Löschen</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                {{Form::open(['url' => 'foo/bar'])}}
                <td>{{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Titel', 'content'=>'Radenthein'))}}</td>
                <td>{{Form::submit('Speichern',array('class' => 'btn btn-primary btn-sm'))}}</td>
                {{Form::close()}}
                <td>
                    {{Form::open(['url' => 'foo/bar'])}}
                    {{Form::submit('Löschen',array('class' => 'btn btn-primary btn-sm'))}}
                    {{Form::close()}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    {{Form::open(['url' => 'foo/bar'])}}
    <div class="form-group">
        {{Form::label('location', 'Spielort')}}
        {{Form::text('location',null,array('class' => 'form-control', 'placeholder'=>'Titel'))}}
    </div>
    <div class="form-group">
        {{Form::submit('Spielort hinzufügen',array('class' => 'btn btn-primary btn-sm'))}}
    </div>
    {{Form::close()}}
@stop
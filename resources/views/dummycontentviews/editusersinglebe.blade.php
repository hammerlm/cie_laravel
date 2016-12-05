@extends('dummycontentviews.masterlayoutfiles.backendmaster')
@section('rightcol_content_lvl2')
    <div align="center" class="panel panel-info">
        <div class="panel-heading">
            <h4>Benutzer hammerlm (Michael Hammerl)</h4>
        </div>
        <div class="panel-body">
            <h3>Aktivität</h3>
            <p>Online</p>
            {{Form::open(['url' => 'foo/bar'])}}
            <h3>Playercardstatus</h3>
            {{ Form::checkbox('name', 'value', true) }}
            <h3>Zugeteilte Rollengruppe</h3>
            {{Form::select('size', array('L' => 'Large', 'S' => 'Small'), null, ['placeholder' => 'Pick a size...'])}}
            {{Form::close()}}
        </div>
    </div>
@stop
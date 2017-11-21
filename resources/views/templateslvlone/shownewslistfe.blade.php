@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    @if(count($newslist) > 0)
        @foreach($newslist as $newsentry)
            @if($newsentry->id == $lastnewsentryid)
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>{{$newsentry->title}}</h3>
                        </div>
                        <div class="panel-body">
                            Artikel vom {{ date('d.m.Y H:i', strtotime($newsentry->created_at)) }}, von <a href="/users/{{$newsentry->creator->id}}">{{$newsentry->creator->name}}</a>
                        </div>
                        <div class="panel-body">
                            {{ substr(strip_tags($newsentry->body), 0, 400) }}
                            ...
                            <br/>
                            <a href="/news/{{$newsentry->id}}">[mehr...]</a>
                        </div>
                        <div class="panel-footer">
                            @foreach($newsentry->categories as $category)
                                <span class="label label-default">{{$category->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3>{{$newsentry->title}}</h3>
                            </div>
                            <div class="panel-body">
                                Artikel vom {{ date('d.m.Y H:i', strtotime($newsentry->created_at)) }}, von <a href="/users/{{$newsentry->creator->id}}">{{$newsentry->creator->name}}</a>
                            </div>
                            <div class="panel-body">
                                {{ substr(strip_tags($newsentry->body), 0, 400) }}
                                ...
                                <br/>
                                <a href="/news/{{$newsentry->id}}">[mehr...]</a>
                            </div>
                            <div class="panel-footer">
                                @foreach($newsentry->categories as $category)
                                    <span class="label label-default">{{$category->name}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <hr/>
        {!! $newslist->render() !!}
    @else
        <div class="alert alert-info" role="alert">Derzeit sind leider noch keine Newsbeiträge vorhanden!</div>
    @endif
    @can('manage-news')
    <hr/>
        {!! Form::open(['url' => url('/backend/news/create'), 'method' => 'GET']) !!}
        {!! Form::submit('Neuen Newsbeitrag erstellen', ["class" => "btn btn-default btn-sm"]) !!}
        {!! Form::close() !!}
    @endcan
@stop
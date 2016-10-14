@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    @if(count($newslist) > 0)
        @foreach($newslist as $newsentry)
            @if($newsentry->id == $lastnewsentryid)
            <div class="row">
                <div class="col-lg-12">
                    <div class="jumbotron">
                        <h2>{{$newsentry->title}} <span class="label label-default">New</span></h2>
                        <p class="jumbop">
                            Artikel vom {{$newsentry->created_at}}, von <a href="/users/{{$newsentry->creator->id}}">{{$newsentry->creator->name}}</a>
                        </p>
                        <p class="jumbop">
                            {{ substr(strip_tags($newsentry->body), 0, 400) }}
                            ...
                        </p>
                        <hr/>
                        <p class="jumbop">
                            @foreach($newsentry->categories as $category)
                            <span class="label label-default">{{$category->name}}</span>
                            @endforeach
                        </p>
                        <hr/>
                        <p align="right"><a class="btn btn-primary btn-lg" href="/news/{{$newslist[0]->id}}" role="button">Mehr...</a></p>
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>{{$newsentry->title}}</h3>
                            </div>
                            <div class="panel-body">
                                Artikel vom {{$newsentry->created_at}}, von <a href="/users/{{$newsentry->creator->id}}">{{$newsentry->creator->name}}</a>
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
    <hr/>
    @can('manage-news')
        {!! Form::open(['url' => url('/backend/news/create'), 'method' => 'GET']) !!}
        {!! Form::submit('Neuen Newsbeitrag erstellen', ["class" => "btn btn-default"]) !!}
        {!! Form::close() !!}
    @endcan
@stop
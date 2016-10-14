@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    @if(count($newslist) > 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h2>{{$newslist[0]->title}} <span class="label label-default">New</span></h2>
                    <p class="jumbop">
                        Artikel vom {{$newslist[0]->created_at}}, von <a href="/users/{{$newslist[0]->creator->id}}">{{$newslist[0]->creator->name}}</a>
                    </p>
                    <p class="jumbop">
                        {{ substr(strip_tags($newslist[0]->body), 0, 400) }}
                        ...
                    </p>
                    <hr/>
                    <p class="jumbop">
                        @foreach($newslist[0]->categories as $category)
                        <span class="label label-default">{{$category->name}}</span>
                        @endforeach
                    </p>
                    <hr/>
                    <p align="right"><a class="btn btn-primary btn-lg" href="/news/{{$newslist[0]->id}}" role="button">Mehr...</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(count($newslist) > 1)
                    @for($i = 1; $i < count($newslist); $i++)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>{{$newslist[$i]->title}}</h3>
                            </div>
                            <div class="panel-body">
                                Artikel vom {{$newslist[$i]->created_at}}, von <a href="/users/{{$newslist[$i]->creator->id}}">{{$newslist[$i]->creator->name}}</a>
                            </div>
                            <div class="panel-body">
                                {{ substr(strip_tags($newslist[$i]->body), 0, 400) }}
                                ...
                                <br/>
                                <a href="/news/{{$newslist[$i]->id}}">[mehr...]</a>
                            </div>
                            <div class="panel-footer">
                                @foreach($newslist[$i]->categories as $category)
                                    <span class="label label-default">{{$category->name}}</span>
                                @endforeach
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
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
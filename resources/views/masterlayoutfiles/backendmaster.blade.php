@extends('masterlayoutfiles.master')
@section('leftcol_content')
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Profile</a></li>
        <li role="presentation"><a href="#">Messages</a></li>
    </ul>
    <!-- initialize the calendar on ready -->
    <script type="application/javascript">
        $(document).ready(function () {
            alert('bye');
        });
    </script>
@stop
@section('rightcol_content')
<p>This is my body content. (right - from the backend-master-layout.blade.php - file)</p>
@stop

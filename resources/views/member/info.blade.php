
<!-- 1、模板中输出PHP变量 -->
<p>{{ $name }}</p>
<!-- 2、模板中调用php代码 -->
<p>{{ time() }}</p>
<p>{{ date('Y-m-d H:i:s', time()) }}</p>

<p>{{ in_array($name, $arr) ? 'true' : 'false' }}</p>
<p>{{ isset($name) ? $name : 'default' }}</p>
<p>{{ $name or 'default' }}</p>

<!-- 3、原样输出 -->
<p>@{{ $name }}</p>

<!-- 4、非转义输出 -->
<p>{!! $name !!}</p>

{{-- 5、模板中注释 --}}

{{-- 6、引入子视图 include --}}
@include('member.child', ['msg' => '我是父信息'])

{{-- 7、流程控制 --}}
@if ($name = 'sean11')
    i'm sean
@elseif ($name = 'haha')
    i'm haha
@else
    who am i
@endif

@unless($name == 'sean')
    i'm sean!!
@endunless

@for($i=0; $i < 2; $i++)
    <p>{{$i}}</p>
@endfor


@foreach($students as $student)
    <p>{{ $student->name }}</p>
@endforeach


@forelse($students as $student)
    <p>{{ $student->name }}</p>
@empty
    <p>null</p>
@endforelse

{{-- 8、模板url --}}
<a href="{{ url('url') }}">url()</a>
<br/>
<a href="{{ action('MemberController@urlTest') }}">action()</a>
<a href="{{ router('url') }}">router()</a>

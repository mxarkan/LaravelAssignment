@extends("dashboard_layout")

@section("pageContent")

@if (Session("insertion_true"))
 <b>{{Session("insertion_true")}}</b>

@endif

<table width = "100%" border = "1px">
    <tr>
        <td>
                id
        </td>
        <td>
            user id 
        </td>
        <td>
            name
        </td>
        <td>
            operations
        </td>
    </tr>
 @foreach ($data as $item)
  <tr>
    <td>{{$item->id}}</td>
    <td>{{$item->user_id}}</td>
    <td>{{$item->name}}</td>
    <td>
        <form action="{{route("deleteCategory",$item->id)}}" method="post">
            @csrf 
            @method("DELETE")
            <input type="submit" value = "حذف">
        </form>
        <button value = "edit"><a href="{{route("editPageUi",$item->id)}}">تعديل</a></button>
        
    </td>
  </tr>
@endforeach
</table>
@endsection
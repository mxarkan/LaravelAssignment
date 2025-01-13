@extends("dashboard_layout")
@section("pageContent")
   <form action="{{route("updateCategory",$category->id)}}" method="post">
   @csrf
   @method("put")
     <input type="text" name = "categoryName" placeholder="اسم الفئة" value="{{$category->name}}">
   @error("categoryName")
    <b>{{$message}}</b>
   @enderror
     <input type="submit" name = "addCategory" value="إرسال">
   </form>
@endsection
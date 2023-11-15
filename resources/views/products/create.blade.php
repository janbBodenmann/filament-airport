<form method ="POST" action ="{{route('products.store')}}">
    <input type ="text" name="title"> <br>
    <input type ="text" name="price"> <br>
    <input type ="submit" value="Submit"> <br>
@csrf
</form>
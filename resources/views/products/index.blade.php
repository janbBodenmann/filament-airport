@foreach($products as $product)
{{$product->title}}: CHF {{$product->price}}<br>
@endforeach
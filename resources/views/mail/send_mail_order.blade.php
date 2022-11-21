<h1>Đã đặt hàng thành công </h1>
<h3>Xin chào <a href="">{{$order->name}}</a></h3>
<strong>Thông tin chi tiết đơn hàng</strong>
<div style="line-height: 1.4px">
 <p>Mã số đơn hàng: {{$order->id}}</p>
<p>Tên người đặt hàng: {{$order->name}}</p>
<p>Địa chỉ giao hàng: {{$order->address}}</p>
<p>Số điện thoại: {{$order->phone_number}}</p>
<p>Email: {{$order->email}}</p>
    @foreach (Session::get('cart')->products as $product )
    <p> <strong>Tên sản phẩm:</strong> {{$product['productInfo']->name}},
        <strong>số lượng:  {{ $product['qty'] }} </strong>,
        <strong>đơn giá: {{number_format($product['price'])}} &#8363;</strong></p>
    @endforeach
<p>Tổng tiền: {{ number_format(Session::get('cart')->totalPayment) }} &#8363;</p>
<p>Ghi chú: {{$order->note}}</p>
</div>
<p>Cảm ơn bạn đã sử dụng dịch vụ của TShop!</p>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>注文一覧</title>
  <link rel="stylesheet" href="{{asset('css/order.css')}}">
  <link rel="stylesheet" href="{{asset('css/item.css')}}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script src="{{asset('js/item.js')}}"></script> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).on('change', '.status-select', function () {
      const orderId = $(this).data('id');
      const newStatus = $(this).val();

      $.ajax({
        url: `/order/${orderId}`,
        method: 'PUT',
          data: { status: newStatus },
          dataType: 'json',
      })
      .done(function (res) {

        $('#success-modal').fadeIn();
    setTimeout(function () {
        $('#success-modal').fadeOut();
    }, 1000);

    // 一覧の再取得
    $.get('/orders/list', function (html) {
      console.log(html);
      $('#orders-table-body').empty().html(html);
    });      })
      .fail(function (err) {
          console.error('更新失敗:', err);
          alert('ステータスの更新に失敗しました');
      });
  });
</script>
  <div class="container">
  @include('components.sidebar')


  <main class="main">
    <h1>注文一覧</h1>

      <table>
        <thead>
          <tr>
            <th>日時</th>
            <th>部屋</th>
            <th>商品名</th>
            <th>数量</th>
            <th>ステータス</th>
          </tr>
        </thead>

        <tbody id="orders-table-body">
            @foreach($orders as $order)
          <tr>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->room }}</td>
            <td>{{ $order->item_name_ja }}</td>
            <td>{{ $order->quantity }}</td>
            <td>
            {{-- {{ $order->status_name }} --}}
                <select class="status-select" data-id="{{ $order->id }}">
                @foreach($statusPatterns as $status)
                    <option value="{{ $status->status }}"
                        {{ $order->status == $status->status ? 'selected' : '' }}>
                        {{ $status->status_name }}
                    </option>
                @endforeach
            </select>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="pagination">
        <span class="current">1</span>
        <span>2</span>
        <span>3</span>
        <span>…</span>
        <span>10</span>
        <span>▶</span>
      </div>
    </main>
  </div>

  <div id="success-modal" class="modal" style="display: none;">
  <div class="modal-content">
    <p>ステータスを更新しました</p>
  </div>
</div>
</body>
</html>

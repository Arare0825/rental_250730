<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ホテル管理</title>
  <link rel="stylesheet" href="hotel.css" />
  <link rel="stylesheet" href="{{asset('css/hotel.css')}}">
  <link rel="stylesheet" href="{{asset('css/item.css')}}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script src="{{asset('js/item.js')}}"></script> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<script>
  // CSRFトークンをヘッダーに追加
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  
  $(document).on('click', '.save-btn', function () {
    
    const data = {
      hid: $('#hid').val(),
      open_time: $('select[name="open_time"]').val(),
      close_time: $('select[name="close_time"]').val(),
      allday_active: $('input[name="allday_active"]').prop('checked') ? 1 : 0,
      explain_text_ja: $('#explain_ja').val(),
      explain_text_en: $('#explain_en').val(),
      order_text_ja: $('#order_ja').val(),
      order_text_en: $('#order_en').val(),
    };

    $.ajax({
      url: '/hotel/update',
      method: 'POST',
      data: data,
      dataType: 'json'
    })
    .done(function (res) {
      alert('保存しました！');
      location.reload();
    })
    .fail(function (err) {
      alert('保存に失敗しました');
      console.error(err);
    });
  });
</script>
<input type="hidden" id="hid" value="{{ $info->hid }}">
  <div class="container">
  @include('components.sidebar')

    <main class="main">
      <h1>ホテル管理</h1>

      <div class="time-row">
  <label>受付可能時間</label>

  <select name="open_time">
  @for ($h = 0; $h < 24; $h++)
    @foreach (['00', '15', '30', '45'] as $m)
      @php
          $time = sprintf('%02d:%s', $h, $m);
          $selected = ($time === $info->open_time) ? 'selected' : '';
      @endphp
      <option value="{{ $time }}" {{ $selected }}>{{ $time }}</option>
    @endforeach
  @endfor
</select>

<span>〜</span>

<select name="close_time">
  @for ($h = 0; $h < 24; $h++)
    @foreach (['00', '15', '30', '45'] as $m)
      @php
          $time = sprintf('%02d:%s', $h, $m);
          $selected = ($time === $info->close_time) ? 'selected' : '';
      @endphp
      <option value="{{ $time }}" {{ $selected }}>{{ $time }}</option>
    @endforeach
  @endfor
</select>

  <label class="end-check">
    <input type="checkbox" name="allday_active" value="1" /> 終日
  </label>
</div>
      <div class="field-group">
        <label>説明テキスト（JP）</label>
        <textarea id="explain_ja" placeholder="貸出備品オーダー画面に表示されます。">{{ $info->explain_text_ja}}</textarea>
      </div>

      <div class="field-group">
        <label>説明テキスト（EN）</label>
        <textarea id="explain_en" placeholder="貸出備品オーダー画面に表示されます。">{{ $info->explain_text_en}}</textarea>
      </div>

      <div class="field-group">
        <label>注文完了時テキスト（JP）</label>
        <textarea id="order_ja" placeholder="オーダー完了時に表示されます。">{{ $info->order_text_ja}}</textarea>
      </div>

      <div class="field-group">
        <label>注文完了時テキスト（EN）</label>
        <textarea id="order_en" placeholder="オーダー完了時に表示されます。">{{ $info->order_text_en}}</textarea>
      </div>

      <div class="btn-container">
        <button class="save-btn">保存</button>
      </div>
    </main>
  </div>
</body>
</html>

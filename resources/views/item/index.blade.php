  <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>備品管理</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link rel="stylesheet" href="{{asset('css/item.css')}}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery UI（並び替え機能用） -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="{{asset('js/item.js')}}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <script>

$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
    });

    // 編集ボタン
    $('.edit').on('click', function () {
        let data = {};
        data.hid = "test01";
        data.id = $(this).attr("id");

        $.ajax({
            url: `/item/${data.id}/show`,
            method: "POST",
            data: data,
            dataType: "json",
        })
        .done(function (res) {
            console.log(res);
            // openModal();
            // $('#item_ja').val(res.item_name_ja);
            // $('#item_en').val(res.item_name_en);
            // $('#stock').val(res.stock);
            // $('#id').val(res.id);
            // $('#visible').prop('checked', res.visible); 
            openModal(res);
        })
        .fail(function (err) {
            console.error(err);
            alert('通信に失敗しました');
        });
    });

    // 保存ボタン
    $(document).on('click', '#save', function () {
        let id = $('#id').val();

        let data = {
            id: id,
            item_name_ja: $('#item_ja').val(),
            item_name_en: $('#item_en').val(),
            stock: $('#stock').val(),
            visible: $('#visible').prop('checked') ? 1 : 0,
            hid: 'test01' ,
            sort: 20,
            i_name: $('#i_name').val(),
        };

        $.ajax({
            url: `/item`,
            method: "POST",
            data: data,
            dataType: "json"
        })
        .done(function (res) {
            console.log(res);
            alert(id ? '更新完了' : '登録完了');
            closeModal();

        })
        .fail(function (err) {
            console.error(err);
            alert('通信に失敗しました');
        });
    });
});


//削除ボタン
$(document).on('click', '.delete', function () {
    if (!confirm('本当に削除しますか？')) return;

    const id = $(this).attr('id');
    const $row = $(this).closest('tr');

    $.ajax({
        url: `/item/${id}`,
        method: "DELETE",
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        dataType: "json"
    })
    .done(function (res) {
        alert('削除しました');
        console.log(res);
        $row.remove(); // テーブルから該当行を削除
    })
    .fail(function (err) {
        console.error(err);
        alert('削除に失敗しました');
    });
});

  $(document).ready(function () {
    $('#i_name').on('change', function () {
      const selectedName = $(this).val();
      if (selectedName) {
        $('#icon-preview')
          .attr('src', '/img/' + selectedName)
          .show();
      } else {
        $('#icon-preview').hide();
      }
    });
  });

  $(function () {
  $('#sortable').sortable({
    update: function (event, ui) {
      let sortedData = [];

      $('#sortable tr').each(function (index) {
        sortedData.push({
          id: $(this).data('id'),
          sort: index + 1
        });

        // 表示順を即時変更（1列目がソート順の列）
        $(this).find('td').eq(0).text(index + 1);
      });

      $.ajax({
        url: '/item/sort-update',
        method: 'POST',
        data: {
          _token: $('meta[name="csrf-token"]').attr('content'),
          items: sortedData
        },
        success: function (res) {
          console.log('並び順更新成功', res);
        },
        error: function (err) {
          console.error('並び順更新失敗', err);
          alert('並び順の保存に失敗しました');
        }
      });
    }
  });
});
</script>


  <div class="container">
  @include('components.sidebar')

    <main class="main">
    <h1>備品管理</h1>

      <header class="header">
        <button class="new-register edit" style="background-color:#1e87f0;">+ 新規登録</button>
      </header>

      <table class="items-table">
        <thead>
          <tr>
            <th>表示順</th>
            <th>品名</th>
            <th>在庫数</th>
            <th>表示/非表示</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody id="sortable">
  @foreach($items as $item)
  <tr data-id="{{ $item->id }}">
    <td>{{ $item->sort }}</td>
    <td>{{ $item->item_name_ja }}</td>
    <td>{{ $item->stock }}</td>
    <td>
      <input type="checkbox" {{ $item->visible ? 'checked' : '' }} disabled>
    </td>
    <td>
      <button class="edit" id="{{ $item->id }}">編集</button>
      <button class="delete" id="{{ $item->id }}">削除</button>
    </td>
  </tr>
  @endforeach
</tbody>
      </table>
    </main>
  </div>



  
<!-- モーダル -->
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>

<!-- 画像選択リスト -->
<h2>アイコン</h2>

<label for="i_name">アイコン選択</label>
<select name="i_name" id="i_name">
  <option value="">選択してください</option>
  @foreach (File::files(public_path('img')) as $file)
    @php $filename = basename($file); @endphp
    <option value="{{ $filename }}">{{ $filename }}</option>
  @endforeach
</select>
<img id="icon-preview" src="" alt="アイコンプレビュー" style="width: 80px; height: 80px; display: none; border: 1px solid #ccc;">



    <input type="hidden" id="id" value="">

    <label>品名（JP）</label>
    <input id="item_ja" type="text" placeholder="品名（JP）">

    <label>品名（EN）</label>
    <input id="item_en" type="text" placeholder="品名（EN）">

    <label>在庫数</label>
    <input id="stock" type="number" value="30">

    <label class="checkbox">
      <input type="checkbox" id="visible" checked> 表示 / 非表示
    </label>

    <button class="save" id="save">保存</button>
  </div>
</div>
  <script>
  </script>
</body>
</html>

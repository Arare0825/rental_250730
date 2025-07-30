function openModal(existingData = {}) {
  const modal = document.getElementById('modal');
  modal.style.display = 'flex';

  // 初期化またはデータ反映
  document.getElementById('item_ja').value = existingData.item_name_ja || '';
  document.getElementById('item_en').value = existingData.item_name_en || '';
  document.getElementById('stock').value = existingData.stock ?? 30;
  document.getElementById('id').value = existingData.id || '';
  document.getElementById('visible').checked = existingData.visible ?? true;

  // selectの初期化と選択状態
  const iNameSelect = document.getElementById('i_name');
  iNameSelect.value = existingData.i_name || '';

  // プレビュー画像の切り替え
  const preview = document.getElementById('icon-preview');
  if (existingData.i_name) {
    preview.src = '/img/' + existingData.i_name;
    preview.style.display = 'inline-block';
  } else {
    preview.style.display = 'none';
  }
}  


  function closeModal() {
    document.getElementById('modal').style.display = 'none';
  }
  
  // モーダル外クリックで閉じる処理を追加
  window.addEventListener('click', function(event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
      closeModal();
    }
  });

{{-- resources/views/components/sidebar.blade.php --}}
<aside class="sidebar">
  <div class="logo">CrossValue</div>
  <nav>
    <ul>
      <li class="{{ request()->is('order') ? 'active' : '' }}">
        <a href="/order">注文一覧</a>
      </li>
      <li class="{{ request()->is('item') ? 'active' : '' }}">
        <a href="/item">備品管理</a>
      </li>
      <li class="{{ request()->is('hotel') ? 'active' : '' }}">
        <a href="/hotel">ホテル管理</a>
      </li>
    </ul>
  </nav>
</aside>
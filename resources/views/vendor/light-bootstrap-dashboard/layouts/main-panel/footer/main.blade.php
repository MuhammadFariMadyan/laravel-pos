<footer class="footer">
  <div class="container-fluid">
    <nav class="pull-left">
      @section('footer-menu')
      {{-- <ul>
        <li>
          <a href="#">
            Event
          </a>
        </li>
      </ul> --}}
      @show
    </nav>
    <p class="copyright pull-right">
      &copy; Toko Aisyah {{ date('Y') }}
    </p>
  </div>
</footer>

<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
    <div class="text-center"><a class="btn btn-outline-dark mt-auto"
            href="{{ route('products_listing') }}">View All</a></div>
</div>
<footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Core theme JS-->
        @foreach(glob(public_path('js/scripts/*.js')) as $file)
    <script src="{{ asset('js/scripts/' . basename($file)) }}"></script>
@endforeach

    </body>
</html>
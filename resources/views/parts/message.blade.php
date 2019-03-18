<script type="text/javascript" src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>
<!-- Snackbar For Message success -->
@if(Session::has('success'))
    <script>
        $(function () {
            swal.fire("Success!", "{{ Session::get('success') }}", "success");
        });
    </script>
@endif

<!-- Snackbar For Message Info -->
@if(Session::has('info'))
    <script>
        $(function () {
            swal.fire("Information", "{{ Session::get('info').Session::get('info') }}", "info");
        });
    </script>
@endif

<!-- Snackbar For Message Error -->
@if(Session::has('error'))
    <script>
        $(function () {
            swal.fire("Error!", "{{ Session::get('message').Session::get('error') }}", "error");
        });
    </script>
@endif


@if(Session::has("message") && Session::get("type") == "error")
    <script>
        $(function () {
            swal.fire("Error!", "{{ Session::get('message') }}", "error");
        });
    </script>
@endif

@if ($errors->any())
    <?php
    $html = '<ul class="list-unstyled">';
        foreach ($errors->all() as $error){
           $html .=' <li>'.$error.'</li>';
        }
    $html .= '</ul>';
    ?>
    <script>
        $(function () {
            swal.fire("Error!", "{!! $html !!}", "error");
        });
    </script>
@endif
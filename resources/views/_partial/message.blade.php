@if(Session::has('message'))

    <link rel="stylesheet" type="text/css" href="{{ asset('css/notification/overhang.min.css') }}" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/notification/overhang.min.js') }}"></script>

    <script>
        // Some error notification

        $("body").overhang({
            type: "{{ Session::get('type') }}",
            message: "{{ Session::get('message') }}!",
            duration: 5,

            closeConfirm: true,
        });

    </script>

@endif
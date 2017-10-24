
<script type="text/javascript" src="{{ asset('vendor/ueditor/ueditor.config.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/ueditor/ueditor.all.js') }}"></script>
<script>
    window.UEDITOR_CONFIG.serverUrl = '{{ config('ueditor.route.name') }}'
</script>
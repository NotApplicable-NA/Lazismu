<form id="redirect-form" method="POST" action="{{ $url }}">
    @csrf
</form>
<script>
    document.getElementById('redirect-form').submit();
</script>

<script>
function collectClientId() {
    if (typeof ga !== 'undefined') {
        ga(function(tracker) {
            var clientId = tracker.get('clientId');
            postClientId(clientId);
        });
    } else {
        gtag('get', "{{ config('google-analytics-4-measurement-protocol.tracking_id') }}", 'client_id', function (clientId) {
            postClientId(clientId);
        });
    }
}

function postClientId(clientId) {
    window.axios.post('/store-google-analytics-client-id', { id: clientId });
}

@if (!session('google-analytics-4-measurement-protocol.client_id', false))
    collectClientId();
@endif
</script>

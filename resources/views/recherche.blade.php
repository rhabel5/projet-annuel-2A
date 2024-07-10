@extends('layouts.app')
@section('content')

    <!-- Ajoutez votre contenu ici -->
    <input name="dates" type="text" class="p-2 border rounded-lg w-full max-w-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

@endsection

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script>
    console.log('jQuery chargé', typeof jQuery !== 'undefined');
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    $(function() {
        // Récupérer les intervalles de dates invalides (reservations) depuis le controlleur
        //var invalidDateRanges = @json($invalidDateRanges);
        //console.log(invalidDateRanges);
        console.log('lala');

        invalidDateRanges = invalidDateRanges.map(function(range) {
            return {
                start: moment(range.start, 'YYYY-MM-DD'),
                end: moment(range.end, 'YYYY-MM-DD')
            };
        });

        $('input[name="dates"]').daterangepicker({
            isInvalidDate: function(date) {
                // Vérifier si la date actuelle est dans l'un des intervalles de dates invalides
                return invalidDateRanges.some(function(range) {
                    return date.isBetween(range.start, range.end, 'day', '[]');
                });
            }
        });
    });
</script>
